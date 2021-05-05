<?php

/**
 * BaseModel.php
 * Base model class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace dao;

use dao\Dao;
use exceptions\http\Http404;
use models\BaseModel;


class BaseManager {

    private ?\PDO $_connection = null;
    private string $tableName;
    private string $modelName;

    public function __construct(string $tableName, string $modelName) {
        $this->_connection = Dao::connect();
        $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->tableName = $tableName;
        $this->modelName = $modelName;
    }

    public function connection() {
        return $this->_connection;
    }

    public function getBy($field, $value): ?BaseModel {
        // Check wether the field exists in UserModel
        // with property_exists, we need to check explicitly
        // if result is not false if the property can be null
        if (property_exists($this->modelName, $field) !== false) {
            throw new \Exception("Property `$field` does not exist in $this->modelName");
        }

        // Prepare the request
        $query = $this->connection()->prepare("SELECT * FROM `$this->tableName` WHERE $field = :value");
        $query->bindValue('value', $value);
        // PDO does not resolve namespaces or use statements,
        // so we must give it the full name of the class
        $query->setFetchMode(\PDO::FETCH_CLASS, 'models\\' . $this->modelName);
        $query->execute();

        // Return a UserModel or null if not found
        if ($query->rowCount() == 1)
            return $query->fetch();
        return null;
    }

    public function getById($id): ?BaseModel {
        $obj = $this->getBy('id', $id);
        if ($obj === null) {
            throw new Http404('Fichier introuvable');
        }
        return $obj;
    }

    public function all(string $orderBy = null, bool $desc = false): array {

        $order = '';
        if ($orderBy) {
            $order = "ORDER BY $orderBy";
            if ($desc) {
                $order .= ' DESC';
            }
        }

        $query = $this->connection()->query("SELECT * FROM `$this->tableName` $order");
        // PDO does not resolve namespaces or use statements,
        // so we must give it the full name of the class
        return $query->fetchAll(\PDO::FETCH_CLASS, 'models\\' . $this->modelName);
    }

    public function update(BaseModel $model, array $filter = []) {
        foreach ($model->getAllFields() as $name => $value) {
            if (!$filter || in_array($name, $filter)) {
                $queryTokens[] = "$name = :$name";
                $queryValues[$name] = $value;
            }
        }

        if (isset($queryTokens)) {
            $queryTokens = implode(', ', $queryTokens);
            $sql = "UPDATE `$this->tableName` SET $queryTokens WHERE id = {$model->getId()}";
            $query = $this->connection()->prepare($sql);
            $ok = $query->execute($queryValues);
        }

        return $ok;
    }

    public function add(BaseModel &$model) {

        foreach ($model->getAddFields() as $name => $value) {
            $fieldList[] = "$name";
            $paramList[] = ":$name";
            $queryValues[$name] = $value;
        }

        $fieldTokens = implode(', ', $fieldList);
        $paramTokens = implode(', ', $paramList);

        $sql = "INSERT INTO `$this->tableName` ($fieldTokens) VALUES ($paramTokens)";
        $query = $this->connection()->prepare($sql);
        $ok = $query->execute($queryValues);

        if ($ok) {
            $model = $this->getBy('id', $this->lastInsertId());
        }

        return $ok;
    }

    public function lastInsertId(): int {
        return $this->_connection->lastInsertId();
    }

    public function delete(BaseModel $model) {
        $request = $this->_connection->prepare("DELETE FROM `$this->tableName` WHERE id = :id");
        return $request->execute(['id' => $model->getId()]);
    }
}
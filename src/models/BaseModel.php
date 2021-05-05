<?php

/**
 * BaseModel.php
 * BaseModel class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace models;


abstract class BaseModel {

    protected ?int $id = null;

    public function getId() {
        return $this->id;
    }

    public function getFieldNames(): array {
        $reflex = new \ReflectionClass($this);
        $class = $reflex->getName();
        $result = [];
        foreach ($reflex->getProperties() as $prop) {
            if ($prop->class == $class)
                $result[] = $prop->name;
        }
        return $result;
    }

    public function getAllFields() {
        $fields = [];
        foreach ($this->getFieldNames() as $field) {
            $getter = 'get' . ucfirst($field);
            $fields[$field] = $this->$getter();
        }
        return $fields;
    }

    public function getAddFields() {
        return $this->getAllFields();
    }
}
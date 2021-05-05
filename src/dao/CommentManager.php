<?php

/**
 * CommentManager.php
 * Class for managing comments for project 230-TP04_Php_Poo_Critique_photo
 */


namespace dao;

use models\BaseModel;
use models\CommentModel;


class CommentManager extends BaseManager {

    public function __construct() {
        parent::__construct('comment', 'CommentModel');
    }

    public function getCommentsOnPhoto(int $photoId) {
        $commentArray = Dao::getPhotoComments($photoId);
        $comments = [];
        foreach ($commentArray as $commentData) {
            $comment = new CommentModel();
            $comment->hydrate($commentData);
            $comments[] = $comment;
        }
        return $comments;
    }
}
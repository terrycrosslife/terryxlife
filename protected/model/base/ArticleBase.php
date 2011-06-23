<?php
Doo::loadCore('db/DooModel');

class ArticleBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $article_id;

    /**
     * @var varchar Max length is 100.
     */
    public $name;

    /**
     * @var datetime
     */
    public $created;

    /**
     * @var varchar Max length is 50.
     */
    public $author;

    /**
     * @var text
     */
    public $body;

    public $_table = 'article';
    public $_primarykey = 'article_id';
    public $_fields = array('article_id','name','created','author','body');

    public function getVRules() {
        return array(
                'article_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'name' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'created' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'author' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'body' => array(
                        array( 'notnull' ),
                )
            );
    }

}
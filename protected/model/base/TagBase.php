<?php
Doo::loadCore('db/DooModel');

class TagBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $tag_id;

    /**
     * @var varchar Max length is 50.
     */
    public $name;

    public $_table = 'tag';
    public $_primarykey = 'tag_id';
    public $_fields = array('tag_id','name');

    public function getVRules() {
        return array(
                'tag_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'name' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                )
            );
    }

}
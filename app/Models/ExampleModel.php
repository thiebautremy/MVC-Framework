<?php

namespace App\Models;

use oFramework\Utils\Database;
use PDO;

// Mdoel for the table "example"
class ExampleModel extends \oFramework\Models\CoreModel {
    // here I should define every field as a property
    protected $field1;
    protected $field2;
    // etc.

    // I must implements these methods
    public static function find($id) {
        // TODO
    }

    public static function findAll() {
        // TODO
    }

    protected function insert() {
        // TODO
    }

    protected function update() {
        // TODO
    }

    public function delete() {
        // TODO
    }

    public function jSonSerialize() {
        // TODO
    }

    // GETTERS

    /**
     * Get the value of field1
     */ 
    public function getField1()
    {
        return $this->field1;
    }

    /**
     * Get the value of field2
     */ 
    public function getField2()
    {
        return $this->field2;
    }

    // SETTERS

    /**
     * Set the value of field1
     */ 
    public function setField1($field1)
    {
        $this->field1 = $field1;
    }

    /**
     * Set the value of field2
     */ 
    public function setField2($field2)
    {
        $this->field2 = $field2;
    }
}
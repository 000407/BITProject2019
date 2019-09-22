<?php

abstract class IdentifiedBaseModel extends BaseModel
{
    public $id;

    public function findById($id) {
        $tableName = get_class($this);
        $query = "SELECT * FROM $tableName WHERE id='$id'";
        return $this->select($query);
    }
}
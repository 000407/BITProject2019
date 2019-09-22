<?php

class OneTimePassword extends BaseModel
{
    public $mobileNumber;
    public $dateCreated;
    public $value;

    public function __construct($value = null , $mobileNumber = null) {
        parent::__construct();
        $this->value = $value;
        $this->mobileNumber = $mobileNumber;
        $this->dateCreated = null;
    }
    public function update($updatedEntity = null, $idField = 'mobileNumber')
    {
        return parent::update($updatedEntity, $idField);
    }

    public function findByMobileNumber($mobileNumber) {
        $tableName = get_class($this);
        $query = "SELECT * FROM $tableName WHERE mobileNumber='$mobileNumber'";
        return $this->select($query);
    }

    public function existsByMobileNumber($mobileNumber) {
        $tableName = get_class($this);
        $query = "SELECT * FROM $tableName WHERE mobileNumber='$mobileNumber'";
        return $this->exists($query);
    }
}
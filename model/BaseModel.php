<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus - PC
 * Date: 6/15/2019
 * Time: 3:08 PM
 */

abstract class BaseModel {
    protected $con;
    protected $id;

    /**
     * BaseModel constructor.
     */
    public function __construct()
    {
        //TODO: Obtain the connection from a connection pool
        $this->con = new mysqli("127.0.0.1", "root", "", "db_project2019");
    }

    public function save($entity = null) {
        if(!isset($entity)){
            $entity = $this;
        }

        $fields = $this->getFields();
        $values = $this->getFieldValues($entity);

        $fieldList = implode(", ", $fields);
        $valueList = implode(", ", $values);

        $tableName = get_class($entity);

        $query = "INSERT INTO $tableName($fieldList) VALUES($valueList)";
        $res = $this->con->query($query);

        if(!$res){
            $err = $this->con->error_list;
            //TODO:Error to be logged
        }

        return $res;
    }

    public function update($updatedEntity = null) {
        $tableName = get_class($this);

        if(!isset($updatedEntity)){
            $updatedEntity = $this;
        }

        $fieldValueMap = $this->getFieldValueMap($updatedEntity);

        $generateSqlKeyValuePairs = function($k,$v){ //Function to generate key value pairs
            return "$k=$v";
        };

        $valueString = implode(',', $this->array_map_assoc($generateSqlKeyValuePairs, $fieldValueMap));

        $query = "UPDATE $tableName SET $valueString WHERE id=$this->id";

        $res = $this->con->query($query);

        if(!$res){
            $err = $this->con->error_list;
            //TODO:Error to be logged
        }

        return $res;
    }

    public function find($id) {
        $tableName = get_class($this);
        $query = "SELECT * FROM $tableName WHERE id='$id'";

        $res = $this->con->query($query);

        if($res->num_rows < 0) {
            return null;
        }

        $record = $res->fetch_assoc();

        $fields = $this->getFields();

        foreach ($fields as $field) {
            $this->$field = $record[$field];
        }

        return $this;
    }

    public function toArray(){
        return call_user_func('get_object_vars', $this);
    }

    private function getFields() {
        $reflect = new ReflectionClass($this);
        $properties   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $fields = array();

        foreach ($properties as $f){
            if($f->getName() === "con"){
                continue;
            }
            $fields[] = $f->getName();
        }

        return $fields;
    }

    private function getFieldValues($entity) {
        $reflect = new ReflectionClass($entity);
        $properties   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $values = array();

        foreach ($properties as $p){
            if($p->getName() === "con"){
                continue;
            }

            $p->setAccessible(true);

            $val = $p->getValue($entity);
            if(gettype($val) !== "integer"){
                $val = "'$val'";
            }
            $values[] = $val;

            $p->setAccessible(false);
        }

        return $values;
    }

    private function getFieldValueMap($entity) {
        $reflect = new ReflectionClass($entity);
        $properties   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $values = array();

        foreach ($properties as $p){
            if($p->getName() === "con"){
                continue;
            }

            $p->setAccessible(true);

            $name = $p->getName();
            $value = $p->getValue($entity);
            if(gettype($value) !== "integer"){
                $value = "'$value'";
            }
            $values[$name] = $value;

            $p->setAccessible(false);
        }

        return $values;
    }

    private function array_map_assoc( $callback , $array ){
        $r = array();
        foreach ($array as $key=>$value)
            $r[$key] = $callback($key,$value);
        return $r;
    }
}
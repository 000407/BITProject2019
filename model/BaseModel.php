<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus - PC
 * Date: 6/15/2019
 * Time: 3:08 PM
 */

abstract class BaseModel{
    protected $con;

    /**
     * BaseModel constructor.
     */
    public function __construct()
    {
        $this->con = new mysqli("127.0.0.1", "root", "", "db_project2019");
    }

    public function save($entity = null) {
        if(!isset($entity)){
            $entity = $this;
        }

        $reflect = new ReflectionClass($entity);
        $properties   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $fields = array();
        $values = array();

        foreach ($properties as $f){
            if($f->getName() === "con"){
                continue;
            }
            $fields[] = $f->getName();
            $f->setAccessible(true);
            $val = $f->getValue($entity);
            if(gettype($val) !== "integer"){
                $val = "'$val'";
            }
            $values[] = $val;
            $f->setAccessible(false);
        }

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

    public function toArray(){
        return call_user_func('get_object_vars', $this);
    }
}
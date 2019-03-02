<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/2/2019
 * Time: 5:07 PM
 */

class BaseController
{
    public function loadView($controller, $action){
        require_once (ROOT . "view/$controller/$action.php");
    }
}
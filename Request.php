<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 2/23/2019
 * Time: 4:35 PM
 */

class Request
{
    private $url;
    private $controllerName;
    private $actionName;
    private $pathParams;

    public function __construct($url = null)
    {
        if(isset($url)){
            $this->url = $url;
        }
        else {
            $this->url = $_SERVER["REQUEST_URI"];
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    public function getPathParams()
    {
        return $this->pathParams;
    }

    public function setPathParams($pathParams)
    {
        $this->pathParams = $pathParams;
    }


}
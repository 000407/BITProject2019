<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 2/23/2019
 * Time: 4:31 PM
 */
session_start();

define('WEBROOT', str_replace("webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
define('RESOURCES', WEBROOT . "webroot/assets/");
define('APPROOT', "/BITProject2019");

require(ROOT . "config/core.php");

extract($config); //Decomposing $Config to variables

require(ROOT . "Router.php");
require(ROOT . "Request.php");

if (!isAuthenticated($anonymousAllowed)) {
    $postBack = $_SERVER["REQUEST_URI"];
    $postBack = urlencode(urlencode(urlencode($postBack)));
    header("location:/BITProject2019/user/login/$postBack");
}

$request = new Request();
Router::parse($request->getUrl(), $request);

spl_autoload_register(function($className){
    require_once("../controller/$className.php");
});

$controllerName = $request->getControllerName();
$methodName = $request->getActionName();
$params = $request->getPathParams();

$controller = new $controllerName();

call_user_func_array(array($controller, $methodName), $params);

function isAuthenticated($anonymousAllowed){
    $url = str_replace(APPROOT, "", $_SERVER["REQUEST_URI"]);
    foreach ($anonymousAllowed as $re){
        $regEx = sprintf("/^%s/", str_replace("/", "\/", $re));
        if(preg_match($regEx, $url)){
            return true;
        }
    }
    return isset($_SESSION["user"]["name"]);
}
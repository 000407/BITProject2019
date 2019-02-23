<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 2/23/2019
 * Time: 4:31 PM
 */

define('WEBROOT', str_replace("webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

#require(ROOT . "config/core.php");

require(ROOT . "Router.php");
require(ROOT . "Request.php");

$request = new Request();
Router::parse($request->getUrl(), $request);
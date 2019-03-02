<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 2/23/2019
 * Time: 4:36 PM
 */
class Router
{
    static public function parse($url, $request)
    {
        $url = trim($url);
        if ($url == "/PHP_Rush_MVC/")
        {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $urlSegments = explode('/', $url);
            $urlSegments = array_slice($urlSegments, 2);

            $className = sprintf("%sController", ucfirst($urlSegments[0]));
            $methodName = $urlSegments[1];
            $pathParams = array_slice($urlSegments, 2);

            $request->setControllerName($className);
            $request->setActionName($methodName);
            $request->setPathParams($pathParams);
        }
    }
}
?>
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
            $explode_url = explode('/', $url);
            echo json_encode($explode_url), "<br />";
            $explode_url = array_slice($explode_url, 2);
            echo json_encode($explode_url), "<br />";
            /*$request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);*/
        }
    }
}
?>
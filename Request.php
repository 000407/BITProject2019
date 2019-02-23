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

    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_URI"];
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


}
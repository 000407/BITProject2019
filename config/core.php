<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus - PC
 * Date: 6/1/2019
 * Time: 11:42 PM
 */

$config = array();

$config["anonymousAllowed"] = array(
    "/user/login(/[a-zA-Z\d\%]+)?",
    "/user/authenticate",
    "/user/register"
);
<?php

/**
 * My App
 *
 * 
 * @version 0.1
 * @author Muhammad Shahbaz <mohammadshahbax@gmail.com>
 */
class App {

    public static function __init()
    {
        // current dir 
        define("ROOT", __DIR__);
        // Load bootstrap
        require_once ROOT . "/app/bootstrap.php";
        AppBootstrap::init();
    }

}

App::__init();

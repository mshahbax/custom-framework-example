<?php

class AppBootstrap {

    /**
     * Init Application
     * 
     * Load all required files and setup configs.
     */
    public static function init()
    {
        // Main config file
        require_once ROOT . "/app/config/config.php";
        AppConfig::get();
        //Route checking through route list and routing
        Routes::routeMap();
    }

}

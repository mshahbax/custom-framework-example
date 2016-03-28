<?php

class AppConfig {

    /**
     * Get configuration
     * 
     * Set app configurations and return array of configurations
     * @return array Web App configs
     */
    public static function get()
    {
        self::showAllErrors();
        self::defineConstants();
        self::loadFiles();
    }

    /**
     * Returns the application environment
     * 
     * @return string environment string
     */
    public static function detectEnvironment()
    {
        return (getenv('APPLICATION_ENV')) ? getenv('APPLICATION_ENV') : 'production';
    }

    /**
     * Set PHP directives to notify of all errors
     *
     * */
    public static function showAllErrors()
    {
        if (self::detectEnvironment() !== 'production') {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }
    }

    /**
     * Load Files
     * 
     * Loads all base files
     */
    public static function loadFiles()
    {
        //Models path for PHP Autoloader
        set_include_path(implode(PATH_SEPARATOR, array(
            realpath(MODELS_FOLDER),
            realpath(CONTROLLERS_FOLDER),
        )));

        spl_autoload_register(function ($class) {
            include str_replace('\\', '/', $class) . '.php';
        });
    }

    /**
     * Define app top level constants
     *
     * */
    public static function defineConstants()
    {
        define("APP_FOLDER", ROOT . "/app");
        define("MODELS_FOLDER", APP_FOLDER . "/models/");
        define("CONTROLLERS_FOLDER", APP_FOLDER . "/controllers/");
        define("CONFIG_FOLDER", APP_FOLDER . "/config/");
    }

}

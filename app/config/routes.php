<?php

/**
 * Contains the routing mechanism
 * 
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 */
class Routes {

    /**
     * takes the rest method type, route path and pass further to process
     */
    public static function routeMap()
    {
        $requestType = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $route = filter_input(INPUT_SERVER, 'REQUEST_URI');

        self::processRoute($route, $requestType);
    }

    /**
     * 
     * @param String $route route path
     * @param String $requestType Request types e.g GET, POST, PUT
     */
    public static function processRoute($route, $requestType)
    {
        $route = strtolower(trim($route, '/'));
        if ($route == 'addresses') {
            if (strtoupper($requestType) == 'GET') {
                $dispatchData = array('ctrl' => 'Address', 'action' => 'listAddress');
            } elseif (strtoupper($requestType) == 'POST') {
                $dispatchData = array('ctrl' => 'Address', 'action' => 'saveAddress', 'params' => $_POST);
            } elseif (strtoupper($requestType) == 'PUT') {
                parse_str(file_get_contents("php://input"), $put);
                $dispatchData = array('ctrl' => 'Address', 'action' => 'updateAddress', 'params' => $put);
            }
        } elseif (preg_match('/addresses\/[0-9]+$/', $route)) {
            if (strtoupper($requestType) == 'GET') {
                $splitArray = explode('/', $route);
                $dispatchData = array('ctrl' => 'Address', 'action' => 'getAddressById', 'params' => array('id' => $splitArray[1]));
            }
        }
        if (empty($dispatchData)) {// 404 route
            echo '404 Error';
            exit;
        }

        if (!empty($dispatchData)) {
            $ctrlName = "{$dispatchData['ctrl']}Controller";
            $ctrlObj = new $ctrlName();
            $ctrlObj->dispatchAction($dispatchData);
        }

//        *# This is the simple idea to implement a generic route mapper with regix#*
//        
//        $routes = array(
//            '/addresses/' => array(
//                'controller' => 'Address',
//                'type' => array(
//                    'GET' => array('action' => 'saveAddress'),
//                    'POST' => array('action' => 'saveAddress'),
//                )
//            ),
//            '/addresses/?' => array(
//                'controller' => 'Address',
//                'type' => array(
//                    'PUT' => array('action' => 'saveAddress'),
//                    'GET' => array('action' => 'saveAddress'),
//                )
//            )
//        );
//        
//        foreach($routes as $key => $routeRow){
//            preg_match("/$key\/[0-9]+/", $route);
//        }
    }

}

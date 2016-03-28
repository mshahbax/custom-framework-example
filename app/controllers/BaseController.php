<?php

/**
 * Base controller
 * 
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 */
class BaseController {

    protected $_request;

    public function __construct()
    {
        
    }
    
    /**
     * to execute action
     * 
     * @param MixedArray $dispatchData Dispatch data required to trigger action
     */
    public function dispatchAction($dispatchData)
    {
        $action = isset($dispatchData['action']) ? $dispatchData['action'] : NULL;
        $this->_request = isset($dispatchData['params']) ? $dispatchData['params'] : NULL;
        if (!empty($action)) {
            $this->$action();
        }
    }

}

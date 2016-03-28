<?php

/**
 * Contains the all responses which are used in response of a API call
 * 
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 */
class Response {

    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const IS_NOT_SET = 'field_missing';
    const OK = 'ok';

    /**
     * Returns the response array
     * 
     * @param Array $data response patteren array
     */
    public static function sendResponse($data)
    {
        $response = array(
            'status' => isset($data['status']) ? $data['status'] : '',
            'message' => isset($data['message']) ? $data['message'] : '',
            'data' => isset($data['data']) ? $data['data'] : ''
        );

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

}

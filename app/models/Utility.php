<?php

/**
 * Contains the all common utilities of the project
 * 
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 */
class Utility {

    public function __construct()
    {
        
    }

    /**
     * Validates the associate array on keys of the arrays
     * 
     * @param Array $data Associate data array to validate
     * @return Array
     */
    public function validateArray($data)
    {
        if (!is_array($data)) {
            $response['status'] = Response::IS_NOT_SET;
            $response['message'] = 'All ' . Messages::FIELD_MISSING;
        } else {
            foreach ($data as $key => $value) {
                if ($value == NULL || $value == '') {
                    //Email Validation
                    $response['status'] = Response::IS_NOT_SET;
                    $response['message'] = "'$key' " . Messages::FIELD_MISSING;
                    break;
                } else {
                    $response['status'] = Response::OK;
                }
            }
        }
        return $response;
    }

    /**
     * 
     * @param type $string
     * @return String returns the string after escaping all special characters
     */
    public static function escapeSpecial($string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}

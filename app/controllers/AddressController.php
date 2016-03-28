<?php

/**
 * Handles the all requests related to Adresses
 * 
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 */
class AddressController extends BaseController {

    /**
     * Method POST
     * 
     * @param String $STREET Street name of the address
     * @param String $LABEL Labeled name of the address
     * @param String $HOUSENUMBER House number
     * @param String $POSTALCODE Postal code of the address
     * @param String $CITY City name of the address
     * @param String $COUNTRY Country name of the address
     * 
     * Action to insert new records
     */
    protected function saveAddress()
    {
        $street = isset($this->_request['STREET']) ? $this->_request['STREET'] : false;
        $label = isset($this->_request['LABEL']) ? $this->_request['LABEL'] : false;
        $houseNo = isset($this->_request['HOUSENUMBER']) ? $this->_request['HOUSENUMBER'] : false;
        $postalCode = isset($this->_request['POSTALCODE']) ? $this->_request['POSTALCODE'] : false;
        $city = isset($this->_request['CITY']) ? $this->_request['CITY'] : false;
        $country = isset($this->_request['COUNTRY']) ? $this->_request['COUNTRY'] : false;

        $data = array(
            'LABEL' => $label,
            'STREET' => $street,
            'HOUSENUMBER' => $houseNo,
            'POSTALCODE' => $postalCode,
            'CITY' => $city,
            'COUNTRY' => $country,
        );

        $utility = new Utility();
        $validate = $utility->validateArray($data);
        if ($validate['status'] === 'ok') {
            $addressModel = new AddressModel();
            $saved = $addressModel->saveAddress($data);
            if ($saved) {
                $response['status'] = Response::SUCCESS;
                $response['data']['addressId'] = $saved;
            } else {
                $response['status'] = Response::FAILURE;
                $response['message'] = Messages::FAILURE;
            }
        } else {
            $response['status'] = $validate['status'];
            $response['message'] = $validate['message'];
        }

        Response::sendResponse($response);
    }

    /**
     * Method GET
     * 
     * Action to List all address from database
     */
    protected function listAddress()
    {
        $addressModel = new AddressModel();
        $data = $addressModel->getList();
        $response['status'] = Response::SUCCESS;
        if (empty($data)) {
            $response['message'] = Messages::NO_RECORD;
        }
        $response['data'] = $data;

        Response::sendResponse($response);
    }

    /**
     * Method PUT
     * 
     * @param INT $id Address id which will update the tupple
     * 
     * @param String $STREET Street name of the address
     * @param String $LABEL Labeled name of the address
     * @param String $HOUSENUMBER House number
     * @param String $POSTALCODE Postal code of the address
     * @param String $CITY City name of the address
     * @param String $COUNTRY Country name of the address
     * 
     * Action to insert new records
     */
    protected function updateAddress()
    {
        $id = isset($this->_request['id']) ? Utility::escapeSpecial($this->_request['id']) : false;
        $street = isset($this->_request['STREET']) ? $this->_request['STREET'] : false;
        $label = isset($this->_request['LABEL']) ? $this->_request['LABEL'] : false;
        $houseNo = isset($this->_request['HOUSENUMBER']) ? $this->_request['HOUSENUMBER'] : false;
        $postalCode = isset($this->_request['POSTALCODE']) ? $this->_request['POSTALCODE'] : false;
        $city = isset($this->_request['CITY']) ? $this->_request['CITY'] : false;
        $country = isset($this->_request['COUNTRY']) ? $this->_request['COUNTRY'] : false;

        if ($id) {
            $addressModel = new AddressModel();
            if ($label) {
                $data['LABEL'] = $label;
            }
            if ($street) {
                $data['STREET'] = $street;
            }
            if ($houseNo) {
                $data['HOUSENUMBER'] = $houseNo;
            }
            if ($postalCode) {
                $data['POSTALCODE'] = $postalCode;
            }
            if ($city) {
                $data['CITY'] = $city;
            }
            if ($country) {
                $data['COUNTRY'] = $country;
            }
            if (!empty($data)) {
                if ($addressModel->updateAddressById($data, $id)) {
                    $response['status'] = Response::SUCCESS;
                    $response['message'] = Messages::SUCCESS;
                } else {
                    $response['status'] = Response::FAILURE;
                    $response['message'] = Messages::FAILURE;
                }
            } else {
                $response['status'] = Response::IS_NOT_SET;
                $response['message'] = 'address related ' . Messages::FIELD_MISSING;
            }
        } else {
            $response['status'] = Response::IS_NOT_SET;
            $response['message'] = 'id ' . Messages::FIELD_MISSING;
        }
        Response::sendResponse($response);
    }

    /**
     * Method GET
     * 
     * @param INT $id Address id which find the address 
     * 
     * Returns the address row according to id param
     */
    protected function getAddressById()
    {
        $id = isset($this->_request['id']) ? Utility::escapeSpecial($this->_request['id']) : false;
        if ($id) {
            $addressModel = new AddressModel();
            $address = $addressModel->getRecordById($id);
            if ($address) {
                $response['status'] = Response::SUCCESS;
                $response['data']['address'] = $address;
            } else {
                $response['status'] = Response::FAILURE;
                $response['message'] = Messages::FAILURE;
            }
        } else {
            $response['status'] = Response::IS_NOT_SET;
            $response['message'] = 'id ' . Messages::FIELD_MISSING;
        }
        Response::sendResponse($response);
    }

}

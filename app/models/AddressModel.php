<?php

/**
 * Contains the all actions related to user
 * 
 * @author Muhammad Shahbaz <mohammadshahbax@mail.com>
 */
class AddressModel extends DbConnect
{

    protected $_name = 'address';

    public function __construct()
    {
        
    }

    /**
     * Saves Address Data
     * 
     * @param Array $data Data array to save
     * @return int/bool inserted id or false otherwise
     */
    public function saveAddress($data)
    {
        return $this->save($this->_name, $data);
    }

    /**
     * Returns the adress's record by address id
     * 
     * @param int $id primary id of a address touple
     * @return Array
     */
    public function getRecordById($id)
    {
        $query = "SELECT LABEL, STREET, HOUSENUMBER, POSTALCODE, CITY, COUNTRY FROM $this->_name WHERE ADDRESSID = :id LIMIT 1";
        return $this->getRow($query, array(':id' => $id));
    }
    
    /**
     * Updates the row on id
     * 
     * @param MixedArray $data Associative array of data to update into database
     * @param INT $id id of the Address row
     * @return INT/Bool Returns the updated id, false otherwise
     */
    public function updateAddressById($data, $id)
    {
        return $this->update($this->_name, $data, " ADDRESSID = :id", array(':id' => $id));
    }
    
    /**
     * 
     * @return INT/Bool Returns the resultset, false otherwise
     */
    public function getList()
    {
        $query = "SELECT LABEL, STREET, HOUSENUMBER, POSTALCODE, CITY, COUNTRY FROM $this->_name";
        return $this->getAll($query);
    }

}

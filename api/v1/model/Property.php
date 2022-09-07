<?php


class PropertyException extends Exception
{
}

class Property
{
    private $_id;
    private $_title;
    private $_description;
    private $_type;
    private $_address;
    private $_area;
    private $_price;
    private $_post_date;


    public function __construct($id, $title, $description, $type, $address, $area, $price, $post_date = null){
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setType($type);
        $this->setAddress($address);
        $this->setArea($area);
        $this->setPrice($price);
        $this->setPostDate($post_date);
    }

    public function setID($id)
    {
        if (($id !== null) && (!is_numeric($id) || $id <= 0 || $id > 9223372036854775807 || $this->_id !== null)) {
            throw new PropertyException("Property ID error");
        }
        $this->_id = $id;
    }
    public function getID()
    {
        return $this->_id;
    }

    public function setTitle($title)
    {
        if (strlen(trim($title)) <= 0 || strlen(trim($title)) > 255) {
            throw new PropertyException("Property Title error");
        }

        $this->_title = $title;
    }
    public function getTitle()
    {
        return $this->_title;
    }

    public function setDescription($description)
    {
        if (($description !== null)  && (strlen($description) < 10)) {
            throw new PropertyException("Property Description error");
        }

        $this->_description = $description;
    }
    public function getDescription()
    {
        return $this->_description;
    }
    
    public function setType($type)
    {
        if (strtolower($type) !== 'location' && strtolower($type) !== 'vendre') {
            throw new PropertyException("property type must be 'location' or 'vendre'");
        }

        $this->_type = $type;
    }
    public function getType()
    {
        return $this->_type;
    }

    public function setAddress($address)
    {
        if (($address !== null)  && (strlen($address) < 3)) {
            throw new PropertyException("Property Address error");
        }

        $this->_address = $address;
    }
    public function getAddress()
    {
        return $this->_address;
    }

    public function setArea($area)
    {
        if (($area !== null) && $area <= 100) {
            throw new PropertyException("Property Area error");
        }
        $this->_area = $area;
    }
    public function getArea()
    {
        return $this->_area;
    }

    public function setPrice($price)
    {
        if (($price !== null) && $price <= 100) {
            throw new PropertyException("Property Price error");
        }
        $this->_price = $price;
    }
    public function getPrice()
    {
        return $this->_price;
    }

    public function setPostDate($post_date)
    {   
        if (($post_date !== null) && date_format(date_create_from_format('Y-m-d H:i:s', $post_date), 'Y-m-d H:i:s') != $post_date) {
            throw new PropertyException("Property post_date date time error");
        }elseif($post_date == null){
            $post_date = date('Y-m-d H:i:s');
        }

        $this->_post_date = $post_date;
    }
    public function getPostDate()
    {
        return $this->_post_date;
    }

    

    public function returnPropertyAsArray(){
        $property = [];
        $property['id'] = $this->getID();
        $property['title'] = $this->getTitle();
        $property['description'] = $this->getDescription();
        $property['type'] = $this->getType();
        $property['address'] = $this->getAddress();
        $property['area'] = $this->getArea();
        $property['price'] = (int) $this->getPrice();
        $property['post_date'] = $this->getPostDate();

        return $property;
    }
}
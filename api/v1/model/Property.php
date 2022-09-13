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
    private $_shower;// douche
    private $_bedroom;// chambre
    private $_picture;// image
    private $_post_date;
    private $_etat;


    public function __construct( $id, $title, $description, $type, $address, $area, $price, $shower, $bedroom, $picture = null, $post_date = null,$etat = null){
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setType($type);
        $this->setAddress($address);
        $this->setArea($area);
        $this->setPrice($price);
        $this->setShower($shower);
        $this->setBedroom($bedroom);
        $this->setPicture($picture);
        $this->setPostDate($post_date);
        $this->setEtat($etat);
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

    public function setShower($shower)
    {
        if (($shower !== null) && $shower <= 0) {
            throw new PropertyException("Property shower error");
        }
        $this->_shower = $shower;
    }
    public function getShower()
    {
        return $this->_shower;
    }

    public function setBedroom($bedroom)
    {
        if (($bedroom !== null) && $bedroom <= 0) {
            throw new PropertyException("Property bedroom error");
        }
        $this->_bedroom = $bedroom;
    }
    public function getBedroom()
    {
        return $this->_bedroom;
    }

    public function setPicture($picture)
    {
        $this->_picture = $picture;
    }
    public function getPicture()
    {
        return $this->_picture;
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

    public function setEtat($etat)
    {
        if (($etat !== null) && $etat !== 0 && $etat !== 1) {
            throw new PropertyException("property etat must be 0  or 1");
        }elseif($etat == null){
            $etat = 0;
        }

        $this->_etat = $etat;
    }
    public function getEtat()
    {
        return $this->_etat;
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
        $property['shower'] = (int) $this->getShower();
        $property['bedroom'] = (int) $this->getBedroom();
        $property['picture'] = $this->getPicture();
        $property['post_date'] = $this->getPostDate();
        $property['etat'] = $this->getEtat();

        return $property;
    }
}
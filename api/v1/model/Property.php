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
    private $_post_date;


    public function __construct($id, $title, $description, $type, $post_date){
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setType($type);
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
        if (($description !== null)  && (strlen($description) > 16777215)) {
            throw new PropertyException("Property Description error");
        }

        $this->_description = $description;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setPostDate($post_date)
    {   
        $post_date = date("Y-m-d H:i:s");
        $this->_post_date = $post_date;
    }

    public function getPostDate()
    {
        return $this->_post_date;
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

    public function returnPropertyAsArray(){
        $property = [];
        $property['id'] = $this->getID();
        $property['title'] = $this->getTitle();
        $property['description'] = $this->getDescription();
        $property['type'] = $this->getType();
        $property['post_date'] = $this->getPostDate();

        return $property;
    }
}
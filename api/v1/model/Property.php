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
    private $_shower; // douche
    private $_bedroom; // chambre
    private $_picture; // image
    private $_post_date;
    private $_etat;
    private $_view;
    private $_userId;
    private $_raison;


    public function __construct($id, $title, $description, $type, $address, $area, $price, $shower, $bedroom, $picture = null, $post_date = null, $etat = null, $userId = null, $raison = null)
    {
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
        $this->setUserId($userId);
        $this->setRaison($raison);
    }

    public function setView($view)
    {
        $this->_view = $view;
    }
    public function getView()
    {
        return $this->_view;
    }

    public function setID($id)
    {
        if (($id !== null) && (!is_numeric($id) || $id <= 0 || $id > 9223372036854775807 || $this->_id !== null)) {
            throw new PropertyException("Erreur sur l'ID");
        }
        $this->_id = $id;
    }
    public function getID()
    {
        return $this->_id;
    }

    public function setTitle($title)
    {
        if (strlen(trim($title)) <= 5 || strlen(trim($title)) > 255) {
            throw new PropertyException("Erreur sur le titre, le titre doit être compris entre 5 et 255 caractères");
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
            throw new PropertyException("Erreur sur la description, la description doit contenir au moins 10 caractères");
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
            throw new PropertyException("Le type de la propriété doit être 'location' ou 'vendre'");
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
            throw new PropertyException("Erreur sur l'adresse");
        }

        $this->_address = $address;
    }
    public function getAddress()
    {
        return $this->_address;
    }

    public function setArea($area)
    {
        if (($area !== null) && $area < 50) {
            throw new PropertyException("Erreur sur la superficie");
        }
        $this->_area = $area;
    }
    public function getArea()
    {
        return $this->_area;
    }

    public function setPrice($price)
    {
        if (($price !== null) && $price < 5000) {
            throw new PropertyException("Erreur sur le prix, le prix doit être au moins 5000");
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
            throw new PropertyException("Erreur sur le nombre de douche");
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
            throw new PropertyException("Erreur sur le nombre de chambre");
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
            throw new PropertyException("Erreur sur le format de la date, le format doit être 'Y-m-d H:i:s'");
        } elseif ($post_date == null) {
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
            throw new PropertyException("L'état doit être 0 ou 1");
        } elseif ($etat == null) {
            $etat = 0;
        }

        $this->_etat = $etat;
    }
    public function getEtat()
    {
        return $this->_etat;
    }

    public function setUserId($userId)
    {
        
        $this->_userId = $userId;
    }
    public function getUserId()
    {
        return $this->_userId;
    }

    public function setRaison($raison)
    {
        

        $this->_raison = $raison;
    }
    public function getRaison()
    {
        return $this->_raison;
    }


    public function returnPropertyAsArray()
    {
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
        $property['view'] = (int) $this->getView();
        $property['_userId'] = $this->getUserId();
        $property['raison'] = $this->getRaison();

        return $property;
    }
}

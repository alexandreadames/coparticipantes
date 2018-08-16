<?php

namespace App\Models\Entity;
/*
Table: tbl_banks
	Columns:
        id int(11) AI PK
        name varchar(255)
        initials varchar(45)
        code varchar(45) 
        jurisdiction varchar(45)
        website varchar(45)
        id_country int(11)
*/

/**
 * @Entity @Table(name="tbl_banks")
 **/
class Bank {

	/**
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

     /**
     * @var string
     * @Column(type="string")
     */
    protected $name;

     /**
     * @var string
     * @Column(type="string")
     */
    protected $initials;

     /**
     * @var string
     * @Column(type="string")
     */
    protected $code;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $jurisdiction;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $website;

    /**
     * @var integer
     * @Column(type="int")
     */
    protected $id_country;


    //Getters
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getInitials(){
        return $this->initials;
    }

    public function getCode(){
        return $this->code;
    }

    public function getJurisdiction(){
        return $this->jurisdiction;
    }

    public function getWebsite(){
        return $this->website;
    }

    public function getIdCountry(){
        return $this->idCountry;
    }

    //Setters
    public function setId($id){
        $this->id=$id;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function setInitials($initials){
        $this->initials=$initials;
    }

    public function setCode($code){
        $this->code=$code;
    }

    public function setJurisdiction($jurisdiction){
        $this->jurisdiction=$jurisdiction;
    }

    public function setWebsite($website){
        $this->website=$website;
    }

    public function setIdCountry($id_country){
        $this->id_country=$id_country;
    }

  }

?>

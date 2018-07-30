<?php 

namespace App\Models\Entity;

/**
*
   
**/


/**
 * @Entity @Table(name="tbl_persons")
 **/
class Person {

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
    protected $phone;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $street;

    /**
     * @var int
     * @Column(type="integer") 
     */
    protected $streetNumber;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $district;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $additionalAddressDetails;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $zipCode;

    /**
     * @var int
     * @Id @Column(type="integer") 
     */
    protected $idCity;

    /**
     * @var int
     * @Column(type="integer") 
     */
    protected $type;


    /**
     * @var string
     * @Column(type="string") 
     */
    protected $cpf_cnpj;

    /**
     * @var string
     * @Column(type="string") 
     */
    protected $dateOfBirth;

      /**
     * @var char
     * @Column(type="char") 
     */
    protected $sex;


    //Gets...

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }


    public function getPhone() {
        return $this->phone;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getStreetNumber() {
        return $this->streetNumber;
    }

    public function getDistrict() {
        return $this->district;
    }

    public function getAdditionalAddressDetails() {
        return $this->additionalAddressDetails;
    }  

    public function getZipCode() {
        return $this->zipCode;
    }    

    public function getIdCity() {
        return $this->idCity;
    }

    public function getType() {
        return $this->type;
    }

    public function getCpfCnpj() {
        return $this->cpf_cnpj;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    public function getSex() {
        return $this->sex;
    }
    

    //Sets...   

    public function setId($id){
        $this->id = $id;
        
    }

    public function setName($name){
        $this->name = $name;
        
    }


    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setStreetNumber($streetNumber) {
        $this->streetNumber = $streetNumber;
    }    

    public function setDistrict($district) {
        $this->district = $district;
    }

    public function seAdditionalAddressDetails($additionalAddressDetails) {
        $this->additionalAddressDetails = $additionalAddressDetails;
    }  

    public function seetZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }    

    public function setIdCity($idCity) {
        $this->idCity = $idCity;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setCpfCnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    
}

 ?>
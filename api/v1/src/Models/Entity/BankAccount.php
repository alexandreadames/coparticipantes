<?php
namespace App\Models\Entity;

/*
Table: tbl_bankaccount
  Columns:
    id int(11) AI PK
    id_bank int(11)
    agencyNumber varchar(45)
    agencyCheckNumber varchar(45)
    accountNumber varchar(45)
    accountCheckNumber varchar(45)
    id_account_type int(11)
    id_user int(11)
*/

/**
 * @Entity @Table(name="tbl_bankaccount")
 **/
class BankAccount {

    /**
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
    * @var int
    * @Column(type="integer")
    */
    protected $id_bank;

    /**
    * @var string
    * @Column(type="string")
    */
    protected $agencyNumber;

    /**
    * @var string
    * @Column(type="string")
    */
    protected $agencyCheckNumber;

    /**
    * @var string
    * @Column(type="string")
    */
    protected $accountNumber;

    /**
    * @var string
    * @Column(type="string")
    */
    protected $accountCheckNumber;

    /**
    * @var int
    * @Column(type="integer")
    */
    protected $id_account_type;

    /**
    * @var int
    * @Column(type="integer")
    */
    protected $id_user;

    //Getters
    public function getId(){
      return $this->id;
    }

    public function getIdBank(){
      return $this->id_bank;
    }

    public function getAgencyNumber(){
      return $this->agencyNumber;
    }

    public function getAgencyCheckNumber(){
      return $this->agencyCheckNumber;
    }

    public function getAccountNumber(){
      return $this->accountNumber;
    }

    public function getAccountCheckNumber(){
      return $this->accountCheckNumber;
    }

    public function getIdAccountType(){
      return $this->id_account_type;
    }

    public function getIdUser(){
      return $this->id_user;
    }

    //Setters
    public function setId($id){
      $this->id = $id;
    }

    public function setIdBank($id_bank){
      $this->id_bank = $id_bank;
    }

    public function setAgencyNumber($agencyNumber){
      $this->agencyNumber = $agencyNumber;
    }

    public function setAgencyCheckNumber($agencyCheckNumber){
      $this->agencyCheckNumber = $agencyCheckNumber;
    }

    public function setAccountNumber($accountNumber){
      $this->accountNumber = $accountNumber;
    }

    public function setAccountCheckNumber($accountCheckNumber){
      $this->accountCheckNumber = $accountCheckNumber;
    }

    public function setIdAccountType($id_account_type){
      $this->id_account_type = $id_account_type;
    }

    public function setIdUser($id_user){
      $this->id_user = $id_user;
    }
}
?>

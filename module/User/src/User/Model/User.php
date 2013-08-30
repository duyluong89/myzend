<?php
namespace User\Model;

class User{
     public $id;
     public $userName;
     public $passWord;
     public $firstName;
     public $lastName;
     public $gender;
     public $birthDay;
     public $address;
     public $phoneNumber;
     public $companyName;
     public $companyAddress;
     public $companyPhone;
     public $privilege;
     public $dateCreate;
     public $lastVisit;
     public $state;
         
     public function exchangeArray($data){
     	
     }
}
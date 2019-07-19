<?php

class User extends tableDataObject{


    const TABLENAME = 'users';


    public static function encryptPassword($value){

        $password = md5($value);
        return $password;
    }

    public static  function getUsers(){
        global $payrolldb;
        $getrecords = "select * from users ";

         $payrolldb->prepare($getrecords);
         $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static function checkUserExist($email){
      global $payrolldb;
  		$getusercount = "select count(*) as usercount from users where username  = '$email'  ";
  		$payrolldb->prepare($getusercount);
  		$usercount = $payrolldb->fetchColumn();
  		return $usercount;
	 }

   public static function userlogin($email, $password){
     global $payrolldb;
     $getusercount = "select count(*) as usercount from users where username  = '$email' and password = '$password'  ";
     $payrolldb->prepare($getusercount);
     $usercount = $payrolldb->fetchColumn();
     return $usercount;
  }

  public static function userinfo($email){
    global $payrolldb;
    $getusercount = "select * from users where username  = '$email' ";
     $payrolldb->prepare($getusercount);
     return $payrolldb->singleRecord();

 }


    public static function deleteuserbyEmail($email){
        global $payrolldb;
        $getusercount = "delete from  users where username  = '$email' ";
        $payrolldb->prepare($getusercount);
        $payrolldb->execute();

    }



}

?>

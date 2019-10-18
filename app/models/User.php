<?php

class User extends tableDataObject{


    const TABLENAME = 'users';


    public static function encryptPassword($value){

        $password = md5($value);
        return $password;
    }

    public static  function getUsers(){
        global $connectedDb;
        $getrecords = "select * from users ";

        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }

    public static function checkUserExist($email){
        global $connectedDb;
        $getusercount = "select count(*) as usercount from users where username  = '$email'  ";
        $connectedDb->prepare($getusercount);
        $usercount = $connectedDb->fetchColumn();
        return $usercount;
    }

    public static function userlogin($email, $password){
        global $connectedDb;
        $getusercount = "select count(*) as usercount from users where username  = '$email' and password = '$password'  ";
        $connectedDb->prepare($getusercount);
        $usercount = $connectedDb->fetchColumn();
        return $usercount;
    }

    public static function userinfo($email){
        global $connectedDb;
        $getusercount = "select * from users where username  = '$email' ";
        $connectedDb->prepare($getusercount);
        return $connectedDb->singleRecord();

    }


    public static function deleteuserbyEmail($email){
        global $connectedDb;
        $getusercount = "delete from  users where username  = '$email' ";
        $connectedDb->prepare($getusercount);
        $connectedDb->execute();

    }

    public static function getUserCountByEmail($email){
        global $connectedDb;
        $getusercount = "SELECT count(*) as ct  from  users where username  = '$email' ";
        $connectedDb->prepare($getusercount);
        return $connectedDb->fetchColumn();

    }

    public static function userIdByEmail($email){
        global $connectedDb;
        $getusercount = "SELECT uid  from  users where username  = '$email' ";
        $connectedDb->prepare($getusercount);
        return $connectedDb->fetchColumn();
    }

    public static function checkUserCredentials($username, $password) {
        global $connectedDb;
        $password = self::encryptPassword($password);
        $getusercount = "SELECT count(*) as ct  from  users where 
                         username  = '$username' and password = '$password' ";
        $connectedDb->prepare($getusercount);
        return $connectedDb->fetchColumn();

    }









}

?>

<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 10/14/2019
 * Time: 1:32 PM
 */

class Login extends PostController
{

    public function index(){

        $rs = new RestApi();

        $requiredfieldnames = ['username', 'password'];

        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Check email
        $emailcount = User::getUserCountByEmail($username);
        if ($emailcount == 0) {
            $rs->throwErrror('USR_05', USR_05, 'username');
        }

        //Check user credential
        $usercount = User::checkUserCredentials($username, $password);
        if ($usercount == 0) {
            $rs->throwErrror('USR_01', USR_01, 'username , password');
        }

        $uid = User::userIdByEmail($username);
        $us = new User($uid);
        $userdata = $us->recordObject;


        //Generate token
        $jwt = new JwtToken();
        $tokenresposnse = $jwt->generateToken($apikey);

        $rs->returnResponse(['tokenInfo'=> $tokenresposnse, 'userdata'=>$userdata]);

    }


}
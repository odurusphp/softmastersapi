<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/21/2019
 * Time: 8:47 AM
 */

class Login extends  PostController
{

    public function index(){

        $rs = new RestApi();


        $requiredfieldnames = ['email', 'password'];

        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $apikey = $rs->getApikey();

        //Check email
        $emailcount = User::getUserCountByEmail($email);
        if ($emailcount == 0) {
            $rs->throwErrror('USR_04', USR_04, 'email');
        }

        //Check user credential
        $usercount = User::checkUserCredentials($email, $password);
        if ($usercount == 0) {
            $rs->throwErrror('USR_01', USR_01, 'email, password');
        }

        $uid = User::userIdByEmail($email);

        $roleid = User::getrolebyUserId($uid);

        $role = User::getRolebyRoleId($roleid);

        if($role == 'Individual'){

            $bid = User::getBasicUserId($uid);

            $bas  = new Basic($bid);
            $userdata = $bas->recordObject;
            $applicantid = $bas->recordObject->applicantid;

            //Generate token
            $jwt = new JwtToken();
            $tokenresposnse = $jwt->generateToken($apikey);


            //Get sms verification time
            $vf = Smslog::getverifiedAt($applicantid);
            $verifiedat = $vf->verified_at;

            $rs->returnResponse( ['basicInfo'=>$userdata, 'tokenInfo'=>$tokenresposnse, 'verified_at'=>$verifiedat ] );

        }elseif($role == 'Business'){
            $busid = User::getBusinessUserId($uid);

            $bus = new Business($busid);
            $businessdata = $bus->recordObject;
            $businessuid = $bus->recordObject->businessuid;

            //Generate token
            $jwt = new JwtToken();
            $tokenresposnse = $jwt->generateToken($apikey);

            //Get sms verification time
            $vf = Smslog::getverifiedAt($businessuid);
            $verifiedat = $vf->verified_at;

            $rs->returnResponse( ['businessInfo'=>$businessdata, 'tokenInfo'=>$tokenresposnse, 'verified_at'=>$verifiedat ] );

        }







    }

}
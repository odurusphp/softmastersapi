<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/20/2019
 * Time: 12:45 PM
 */

class Register extends PostController
{

    public function index(){

        $rs = new RestApi();

        $applicantid = $this->generateuserid();

        $requiredfieldnames = ['firstname', 'lastname', 'middlename', 'date_of_birth',
                                'phone', 'email', 'password'];

        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $othernames = isset($_POST['middlename']) ? $_POST['middlename'] : '';
        $dateofbirth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';
        $telephone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ?  $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';;

        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);


        $fullname = $firstname.' '.$lastname.' '.$othernames;
        $today = date('Y-m-d');
        $dateofbirth = date('Y-m-d', strtotime($dateofbirth));



        // Verify Apikey
        $apikey = $rs->getApikey();

        $emailcount = User::getUserCountByEmail($email);

        if($emailcount > 0){
            $rs->throwErrror('USR_04', USR_04, 'email');
        }else {

            $bas = new Basic();
            $datarow =& $bas->recordObject;
            $datarow->firstname = $firstname;
            $datarow->lastname = $lastname;
            $datarow->othernames = $othernames ;
            $datarow->email = $email ;
            $datarow->telephone = $telephone;
            $datarow->fullname = $fullname;
            $datarow->dateofbirth = $dateofbirth;
            $datarow->applicantid = $applicantid;
            $datarow->applieddate = $today;

            if($bas->store()){
                $bid = $bas->recordObject->bid;
                $role  = 'Individual';
                $uid = $this->adduser($email, $password, $role);

                //Generate token
                $jwt = new JwtToken();
                $tokenresposnse = $jwt->generateToken($apikey);

                //insert user_basic
                Basic::insertIndividualUser($uid, $bid);

                // Send SMS
                $this->sendmessage($telephone, $applicantid);

                $rs->returnResponse( ['basicInfo'=>$bas->recordObject, 'tokenInfo'=>$tokenresposnse] );
            }


        }
    }

    public function business()
    {

        $rs = new RestApi();

        $businessuid = 'BUS-'.$this->generateuserid();

        $requiredfieldnames = ['businessname', 'tin', 'phone', 'email', 'password'];
        $businessname = isset($_POST['businessname']) ? $_POST['businessname'] : '';
        $tin = isset($_POST['tin']) ? $_POST['tin'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $postfields = (array_keys($_POST));

        //Validating the fieldnames in the method
        $rs->validateFieldNames($requiredfieldnames, $postfields);

        // Verify Apikey
        $apikey = $rs->getApikey();

        $emailcount = User::getUserCountByEmail($email);

        if ($emailcount > 0) {
            $rs->throwErrror('USR_04', USR_04, 'email');
        } else {

            $bus = new Business();
            $busrow =& $bus->recordObject;
            $busrow->businessname = $businessname;
            $busrow->tinnumber = $tin;
            $busrow->telephone = $phone;
            $busrow->email = $email;
            $busrow->businessuid = $businessuid;
            $busrow->applieddate = date('Y-m-d');
            if($bus->store()){

                $busid = $bus->recordObject->busid;
                $role  = 'Business';
                $uid = $this->adduser($email, $password, $role);

                //Generate token
                $jwt = new JwtToken();
                $tokenresposnse = $jwt->generateToken($apikey);

                //insert user_business
                Business::insertBusinessUser($uid, $busid);

                // Send SMS
                $this->sendmessage($phone, $businessuid);

                $rs->returnResponse( ['businessInfo'=>$bus->recordObject, 'tokenInfo'=>$tokenresposnse] );
            }


        }
    }



    private function adduser($email, $password,$role)
    {
        $us = new User();
        $us->recordObject->email = $email;
        $us->recordObject->password = md5($password);

        if($us->store()){
            $uid = $us->recordObject->uid;
            $us->addRole($role);
            return $uid;
        }
        exit;

    }




    private function generateuserid(){

        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid = chr(123)
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);

            $guid = $uuid;

            $array = array('{', '}');
            $userid  = str_replace($array , '' , $guid);
            return $userid;

        }
    }

    private function sendmessage($telephone, $applicantid){


        $code = rand(100000 , 999999);

        $key=SMS_KEY;
        $altelephone = substr($telephone, 1);
        $mestelephone = '233'.$altelephone;

        $message =  'Your validation code is:'. $code;
        $message=urlencode($message);
        $sender_id = 'SMasters';

        $url="https://apps.mnotify.net/smsapi?key=$key&to=$telephone&msg=$message&sender_id=$sender_id";
        $result=file_get_contents($url);


        //insert sms code
        $sm  = new Smslog();
        $sm->recordObject->applicantid = $applicantid;
        $sm->recordObject->code = $code;
        $sm->recordObject->status = 0;
        $sm->store();
    }



}
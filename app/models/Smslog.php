<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/20/2019
 * Time: 4:06 PM
 */

class Smslog extends tableDataObject
{
   const TABLENAME  = 'smslog';

    public static function getSmsCount($applicantid , $code){
        global $connectedDb;
        $getdata = "SELECT count(*) as count from smslog where applicantid  = '$applicantid' and code = '$code' ";
        $connectedDb->prepare($getdata);
        return $connectedDb->fetchColumn();
    }

    public static function getSmsByApplicant($applicantid){
        global $connectedDb;
        $getdata = "SELECT * from smslog where applicantid  = '$applicantid' ";
        $connectedDb->prepare($getdata);
        return $connectedDb->singleRecord();
    }

    public static function getsmsBycode($code){
        global $connectedDb;
        $getdata = "SELECT * from smslog where code = '$code' ";
        $connectedDb->prepare($getdata);
        return $connectedDb->singleRecord();
    }

    public static function getverifiedAt($applicantid){
        global $connectedDb;
        $getdata = "SELECT * from smslog where applicantid = '$applicantid' ";
        $connectedDb->prepare($getdata);
        return $connectedDb->singleRecord();
    }

}
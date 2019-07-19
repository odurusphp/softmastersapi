<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/20/2019
 * Time: 12:53 PM
 */

class Basic extends tableDataObject
{
   const TABLENAME = 'basicinformation';

    public static function insertIndividualUser($uid, $bid){
        global $connectedDb;
        $query = "INSERT INTO user_basic (userid, bid) values ($uid, $bid)  ";
        $connectedDb->prepare($query);
        $connectedDb->execute();
    }

    public static function getDataByApplicantId($applicantid){
        global $connectedDb;
        $query = "SELECT * from basicinformation where applicantid = '$applicantid' ";
        $connectedDb->prepare($query);
        return $connectedDb->singleRecord();
    }

    public static function getCountbyBasicId($bid){
        global $connectedDb;
        $query = "SELECT count(*) as count from basicinformation where bid = $bid ";
        $connectedDb->prepare($query);
        return $connectedDb->fetchColumn();
    }

    public static function getCountByApplicantId($applicantid){
        global $connectedDb;
        $query = "SELECT count(*) as ct from basicinformation where applicantid = '$applicantid' ";
        $connectedDb->prepare($query);
        return $connectedDb->fetchColumn();
    }



}
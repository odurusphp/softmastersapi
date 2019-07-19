<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 7/3/2019
 * Time: 12:27 PM
 */

class Fundingmobile extends tableDataObject
{
   const TABLENAME  = 'fundingsource_mobilemoney';


    public static function getMobileCount($mobilenumber){
        global $connectedDb;
        $query = "SELECT count(*) as ct from fundingsource_mobilemoney where mobilenumber   = '$mobilenumber' ";
        $connectedDb->prepare($query);
        return $connectedDb->fetchColumn();
    }

    public static function getMobileDatabyId($userid){
        global $connectedDb;
        $query = "SELECT * from fundingsource_mobilemoney where userid = '$userid' ";
        $connectedDb->prepare($query);
        return $connectedDb->resultSet();
    }


}
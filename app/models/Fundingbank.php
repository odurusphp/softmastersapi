<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 7/3/2019
 * Time: 11:45 AM
 */

class Fundingbank extends tableDataObject
{

    const TABLENAME = 'fundingsource_bank';

    public static function getBankcount($bank){
        global $connectedDb;
        $query = "SELECT count(*) as ct from fundingsource_bank where bankname = '$bank' ";
        $connectedDb->prepare($query);
        return $connectedDb->fetchColumn();
    }

    public static function getBankDatabyId($userid){
        global $connectedDb;
        $query = "SELECT * from fundingsource_bank where userid = '$userid' ";
        $connectedDb->prepare($query);
        return $connectedDb->resultSet();
    }




}
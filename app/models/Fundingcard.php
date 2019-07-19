<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 7/3/2019
 * Time: 12:19 PM
 */

class Fundingcard extends  tableDataObject
{

    const TABLENAME = 'fundingsource_card';

    public static function getCardCount($cardnumber){
        global $connectedDb;
        $query = "SELECT count(*) as ct from fundingsource_card where cardnumber   = '$cardnumber' ";
        $connectedDb->prepare($query);
        return $connectedDb->fetchColumn();
    }

    public static function getCardDatabyId($userid){
        global $connectedDb;
        $query = "SELECT * from fundingsource_card where userid = '$userid' ";
        $connectedDb->prepare($query);
        return $connectedDb->resultSet();
    }

}
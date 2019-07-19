<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/29/2019
 * Time: 1:44 AM
 */

class Identification extends tableDataObject
{
   const TABLENAME = 'identification';


    public static function getIdentificationById($bid){
        global $connectedDb;
        $query = "SELECT * from identification  where bid = $bid ";
        $connectedDb->prepare($query);
        return $connectedDb->resultSet();
    }

    public static function getsingleIdentificationById($bid){
        global $connectedDb;
        $query = "SELECT * from identification  where bid = $bid ";
        $connectedDb->prepare($query);
        return $connectedDb->singleRecord();
    }


}


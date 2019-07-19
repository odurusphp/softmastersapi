<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 4/29/2019
 * Time: 9:17 PM
 */

class Location extends tableDataObject
{

    const TABLENAME  = 'location';

    public static  function getcustomersLocation($cid){
        global $connectedDb;
        $getrecords = "SELECT  * FROM location WHERE  cid  = $cid  ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->singleRecord();
    }




}
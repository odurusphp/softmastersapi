<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 3/4/2019
 * Time: 12:34 PM
 */

class Storenumbers extends tableDataObject
{

     const TABLENAME  = 'storenumbers';

    public static  function getstorenumberbyFloor($floor){
        global $payrolldb;
        $getrecords = "select * from storenumbers where floor = '$floor' and status is NULL ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static  function getStoreDetailsbyStoreNumber($stnumber){
        global $payrolldb;
        $getrecords = "Select * from storenumbers where  shopnumber = '$stnumber' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->singleRecord();
    }


    public static  function getStorebyNatureoftrade($trade){
        global $payrolldb;
        $getrecords = "Select * from storenumbers where  natureoftrade = '$trade' and status is null ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static  function updateStoreStatus($shopnumber, $cid){
        global $payrolldb;
        $getrecords = "UPDATE storenumbers SET status=1, cid=$cid  where  shopnumber = '$shopnumber' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static  function getStoreStatus($shopnumber){
        global $payrolldb;
        $getrecords = "SELECT status  from storenumbers  where  shopnumber = '$shopnumber' ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }



    public static  function updatestorenumber($floor, $floorid, $storenumber){
        global $payrolldb;
        $getrecords = "UPDATE storenumbers SET floorid = '$floorid', status=1 where floor = '$floor' and shopnumber='$storenumber'  ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }


    public static  function getCustomerStores($cid){
        global $payrolldb;
        $getrecords = "SELECT * from storenumbers  where  cid = $cid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


}

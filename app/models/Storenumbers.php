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
        global $connectedDb;
        $getrecords = "select * from storenumbers where floor = '$floor' and status is NULL ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }

    public static  function getStoreDetailsbyStoreNumber($stnumber){
        global $connectedDb;
        $getrecords = "Select * from storenumbers where  shopnumber = '$stnumber' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }


    public static  function getStorebyNatureoftrade($trade){
        global $connectedDb;
        $getrecords = "Select * from storenumbers where  natureoftrade = '$trade' and status is null ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }

    public static  function updateStoreStatus($shopnumber, $cid){
        global $connectedDb;
        $getrecords = "UPDATE storenumbers SET status=1, cid=$cid  where  shopnumber = '$shopnumber' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }

    public static  function getStoreStatus($shopnumber){
        global $connectedDb;
        $getrecords = "SELECT status  from storenumbers  where  shopnumber = '$shopnumber' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }



    public static  function updatestorenumber($floor, $floorid, $storenumber){
        global $connectedDb;
        $getrecords = "UPDATE storenumbers SET floorid = '$floorid', status=1 where floor = '$floor' and shopnumber='$storenumber'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }


    public static  function getCustomerStores($cid){
        global $connectedDb;
        $getrecords = "SELECT * from storenumbers  where  cid = $cid ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }

    public static  function searhallocated($page, $limit){
        global $connectedDb;
        $getrecords = "SELECT customers.firstname, customers.lastname, customers.telephone, customers.staffid, 
                       storenumbers.shopnumber, storenumbers.grossarea, storenumbers.natureoftrade,
                       storenumbers.storetype FROM storenumbers INNER JOIN customers
                       ON storenumbers.cid = customers.cid  limit $page, $limit";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }




}

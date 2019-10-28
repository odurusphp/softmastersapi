<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 9/27/2019
 * Time: 7:18 AM
 */

class Tenants extends tableDataObject
{
    const TABLENAME  = 'tenants';

    public static  function getTenantCount(){
        global $connectedDb;
        $getrecords = "SELECT count(*) as ct  from tenants ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }

    public static  function getTenant($limit, $interval){
        global $connectedDb;
        $getrecords = "SELECT  * from tenants  limit  $limit, $interval ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }


    public static  function tenantCount($storenumber){
        global $connectedDb;
        $getrecords = "SELECT  count(*) as ct  from tenants where storenumber = '$storenumber'  ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }

    public static  function searchtenant($parameter){
        global $connectedDb;
        $getrecords = "SELECT tenants.*, customers.telephone, customers.firstname,
        customers.lastname FROM tenants INNER JOIN customers ON customers.cid = tenants.cid WHERE
        (tenants.storenumber LIKE '%$parameter' OR customers.telephone LIKE '$parameter%' OR
        CONCAT(firstname,' ',lastname) LIKE '$parameter%' OR CONCAT(lastname, ' ',firstname) LIKE '$parameter%')";
        $connectedDb->prepare($getrecords);
        return $connectedDb->resultSet();
    }


}
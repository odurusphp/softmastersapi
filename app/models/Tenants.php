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
        global $payrolldb;
        $getrecords = "SELECT count(*) as ct  from tenants ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

    public static  function getTenant($limit, $interval){
        global $payrolldb;
        $getrecords = "SELECT  * from tenants  limit  $limit, $interval ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function tenantCount($storenumber){
        global $payrolldb;
        $getrecords = "SELECT  count(*) as ct  from tenants where storenumber = '$storenumber'  ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

    public static  function searchtenant($parameter){
        global $payrolldb;
        $getrecords = "SELECT tenants.*, customers.telephone, customers.firstname,
        customers.lastname FROM tenants INNER JOIN customers ON customers.cid = tenants.cid WHERE
        (tenants.storenumber LIKE '%$parameter' OR customers.telephone LIKE '$parameter%' OR
        CONCAT(firstname,' ',lastname) LIKE '$parameter%' OR CONCAT(lastname, ' ',firstname) LIKE '$parameter%')";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


}
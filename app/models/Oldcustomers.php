<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 2/6/2019
 * Time: 3:36 PM
 */

class Oldcustomers extends tableDataObject
{

    const TABLENAME = 'oldcustomers';

    public static function  getoldcustomers($telephone){
        $newtelephone = substr($telephone, 1);

    global $payrolldb;
    $getrecords = "SELECT * FROM oldcustomers INNER JOIN oldownership ON
                    oldcustomers.staffid = oldownership.staffid 
                    WHERE oldcustomers.telephone = '$newtelephone' ";
    $payrolldb->prepare($getrecords);
    return $payrolldb->singleRecord();

   }

    public static function  getmarketdata($shopid){

        global $payrolldb;
        $getrecords = "SELECT * from oldmarket  where shopid = '$shopid' ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->singleRecord();

    }

    public static function  getoldCustomerCount($telephone){
        $newtelephone = substr($telephone, 1);
        global $payrolldb;
        $getrecords = "SELECT count(*) as count  from oldcustomers WHERE telephone = '$newtelephone' ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

}
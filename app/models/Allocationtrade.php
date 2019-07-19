<?php
/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 6/28/2019
 * Time: 11:42 AM
 */

class Allocationtrade extends tableDataObject
{

    const TABLENAME = 'allocationtrade';

    public static  function assigntrade($cid, $natid){
        global $payrolldb;
        $getrecords = "INSERT INTO assignedtrade (cid, natid) values ($cid, $natid)  ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();

    }

    public static  function getassignedtrade($cid){
        global $payrolldb;
        $getrecords = "SELECT * FROM assignedtrade INNER JOIN allocationtrade
                       ON assignedtrade.natid = allocationtrade.natid WHERE cid = $cid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function deletetrade($cid, $natid){
        global $payrolldb;
        $getrecords = "Delete from assignedtrade where  natid = $natid and  cid = $cid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static  function insertallocatednumbers($cid, $natid, $shopnumber){
        global $payrolldb;
        $getrecords = "INSERT INTO allocatednumbers (cid, natid, shopnumber) values ($cid, $natid, '$shopnumber')";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static  function updateallocatednumbers($cid, $natid, $payment){
        global $payrolldb;
        $getrecords = "UPDATE allocatednumbers SET  paymentcycle = '$payment' where cid = $cid and natid = $natid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static  function getcycle($cid, $natid){
        global $payrolldb;
        $getrecords = "SELECT  paymentcycle from allocatednumbers where cid = $cid and natid = $natid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

    public static  function getAllocatedNumber($cid, $natid){
        global $payrolldb;
        $getrecords = "SELECT shopnumber from allocatednumbers where cid = $cid and natid = $natid";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }

    public static  function deleteallocatednumbers($cid, $natid){
        global $payrolldb;
        $getrecords = "Delete from allocatednumbers where  natid = $natid and  cid = $cid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static  function getStores($cid){
        global $payrolldb;
        $getrecords = "Select * from allocatednumbers where   cid = $cid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function deleteAfterallocation($cid){
        global $payrolldb;
        $getrecords = "Delete from allocatednumbers where  cid = $cid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static  function deleteassignedtrade($cid){
        global $payrolldb;
        $getrecords = "Delete from assignedtrade where  cid = $cid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }









}
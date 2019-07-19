<?php


class Invoiceitems extends tableDataObject{

    const TABLENAME = 'invoiceitems';

    public static  function getitemsByInvoiceId($invoiceid){
        global $payrolldb;
        $getrecords = "select * from invoiceitems where invoiceid = '$invoiceid' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static  function getitemsByCid($cid){
        global $payrolldb;
        $getrecords = "select * from invoiceitems where cid= $cid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }


    public static  function getTotalInvoiceAmount($invoiceid){
        global $payrolldb;
        $getrecords = "select sum(amount) as toatl from invoiceitems where invoiceid = $invoiceid ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->fetchColumn();
    }

 }



 ?>

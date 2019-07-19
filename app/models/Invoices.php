<?php


class Invoices extends tableDataObject{

    const TABLENAME = 'invoices';

    public static  function getInvoices($invoiceid){
        global $payrolldb;

        $getrecords = "SELECT invoices.*, customers.* FROM invoices INNER JOIN customers
                        ON invoices.cid  = customers.cid  WHERE invoiceid = '$invoiceid'";
        $payrolldb->prepare($getrecords);
        return $payrolldb->singleRecord();
    }

    public static  function getInvoicesbycid($cid){
        global $payrolldb;

        $getrecords = "SELECT * from invoices where cid = $cid";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }

    public static  function gettotalAmountBycid($cid){
        global $payrolldb;

        $getrecords = "SELECT sum(amount) as total from invoices where cid = $cid";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

    public static  function gettotalAmountByInvoiceId($invoiceid){
        global $payrolldb;

        $getrecords = "SELECT sum(amount) as total from invoices where invoiceid = $invoiceid ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }



 }



 ?>

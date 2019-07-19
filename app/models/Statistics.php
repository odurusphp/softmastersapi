<?php

class Statistics extends tableDataObject{

    public static  function getTotals($type){
        global $payrolldb;
        if($type == 'kma'){
            $getrecords = "SELECT COUNT(DISTINCT telephone) AS TotalRows
                           FROM customers  LEFT OUTER JOIN stores ON customers.staffid = stores.staffid 
                           WHERE  STATUS='validated' AND telephone != '' AND stores.storenumber != '' AND 
                           stores.storenumber  LIKE '%kma%' ";
            $payrolldb->prepare($getrecords);
            $payrolldb->execute();
            return $payrolldb->fetchColumn();
        }
        elseif ($type == 'central'){
            $getrecords = "SELECT COUNT(DISTINCT telephone) AS TotalRows
                           FROM customers  LEFT OUTER JOIN stores ON customers.staffid = stores.staffid 
                           WHERE  STATUS='validated' AND telephone != '' AND stores.storenumber != '' AND 
                           stores.storenumber NOT LIKE '%kma%' ";
            $payrolldb->prepare($getrecords);
            $payrolldb->execute();
            return $payrolldb->fetchColumn();
        }
        elseif ($type == 'all'){
            $getrecords = "SELECT COUNT(DISTINCT telephone) AS TotalRows
                           FROM customers  LEFT OUTER JOIN stores ON customers.staffid = stores.staffid 
                           WHERE  STATUS='validated' AND telephone != '' AND stores.storenumber != ''";
            $payrolldb->prepare($getrecords);
            $payrolldb->execute();
            return $payrolldb->fetchColumn();
        }


    }

    public static  function getCustomersByOccupnacy($type, $occupancy){
        global $payrolldb;

        $stmt = "( occupancy = '$occupancy' )";
        if($type == 'kma'){
            $getrecords = "select COUNT(DISTINCT telephone) AS TotalRows  from customers  where 
                           status='validated' AND telephone != '' AND storenumber != ''
                           and $stmt
                           AND storenumber like '%kma%' ";
        }
        elseif ($type == 'central'){
            $getrecords = "select COUNT(DISTINCT telephone) AS TotalRows  from customers  where 
                           status='validated' AND telephone != '' AND storenumber != ''
                           and $stmt
                           AND storenumber NOT like '%kma%' ";
        }
        elseif ($type == 'all'){
            $getrecords = "select COUNT(DISTINCT telephone) AS TotalRows  from customers  where 
                           status='validated' AND telephone != '' AND storenumber != ''
                           and $stmt
                            ";
        }

        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function getCustomersByOccupnacyUnknown($type){
        global $payrolldb;

        $stmt =  "occupancy =  '' ";

        if($type == 'kma'){
            $getrecords = "select COUNT(DISTINCT telephone) AS TotalRows  from customers  where 
                           status='validated' AND telephone != '' AND storenumber != ''
                           and $stmt
                           AND storenumber like '%kma%' ";
        }
        elseif ($type == 'central'){
            $getrecords = "select COUNT(DISTINCT telephone) AS TotalRows  from customers  where 
                           status='validated' AND telephone != '' AND storenumber != ''
                           and $stmt
                           AND storenumber NOT like '%kma%' ";
        }
        elseif ($type == 'all'){
            $getrecords = "select COUNT(DISTINCT telephone) AS TotalRows  from customers  where 
                           status='validated' AND telephone != '' AND storenumber != ''
                           and $stmt
                            ";
        }

        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

}
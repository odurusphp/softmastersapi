<?php

class ApprovedList extends tableDataObject{


    const TABLENAME = 'approvedlist';

    public static  function updatelist($id, $fullname){
        global $payrolldb;
        $getrecords = "UPDATE approvedlist SET fullname = '$fullname' where apid =$id  ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
    }

    public static function searchcustomers($value){
       global $payrolldb;
       $getrecords = "select * from approvedlist where  telephone like  '%$value%' OR storenumber like  '%$value%'   ";
       $payrolldb->prepare($getrecords);
       $payrolldb->execute();
       return $payrolldb->resultSet();
    }





  }


  ?>

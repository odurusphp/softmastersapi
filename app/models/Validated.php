<?php

class Validated extends tableDataObject{


    const TABLENAME = 'validatedata';

    public static function getscstores(){
       global $payrolldb;
       $getrecords = "select * from validatedata where storenumber like '%SC%' ";
       $payrolldb->prepare($getrecords);
       $payrolldb->execute();
       return $payrolldb->resultSet();
    }




}




?>

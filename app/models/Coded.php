<?php

class Coded extends tableDataObject{


    const TABLENAME = 'coded';

    public static function updatecoded($telephone){
       global $payrolldb;
       $updaterecord = "UPDATE customers SET registereddate = '22-MAR-16' where
                        telephone = '$telephone'  ";
       $payrolldb->prepare($updaterecord);
       $payrolldb->execute();
    }

}




?>

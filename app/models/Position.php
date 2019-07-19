<?php

class Position extends tableDataObject{


    const TABLENAME = 'position';

    public static  function getPosition(){
        global $payrolldb;
        $getrecords = "select * from position";
    
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return  $payrolldb->resultSet();
    }

    public static  function getPositionByDeparment($department, $company){
        global $payrolldb;

        $getrecords = "select * from position where company = '$company' and department = '$department'";
    
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }



}

?>
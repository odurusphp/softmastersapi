<?php

class Employee extends tableDataObject{


    const TABLENAME = 'basicinformation';

    public static  function getEmployees(){
        global $payrolldb;
        $getrecords = "select * from  basicinformation where source is null ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static  function getEmployeesByCompanyandDepartment($company, $department){
        global $payrolldb;
        $getrecords = "select * from  basicinformation  where company = '$company' and department = '$department' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static  function getEmployeesByCompany($company){
        global $payrolldb;
        $getrecords = "select * from  basicinformation  where company = '$company' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }

    public static  function getEmployeesById($id){
        global $payrolldb;
        $getrecords = "select * from  basicinformation  where basic_id = '$id' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }


    public static  function addchildren($basicid, $name, $dob){
        global $payrolldb;
        $insertrecords = "INSERT into children (childname, dateofbirth, basic_id) values ('$name', '$dob', $basicid)  ";
        $payrolldb->prepare($insertrecords);
        $payrolldb->execute();

    }

    public static  function getvisaemployees(){
        global $payrolldb;
        $getrecords = "select * from  basicinformation where source = 'visa' ";
        $payrolldb->prepare($getrecords);
        $payrolldb->execute();
        return $payrolldb->resultSet();
    }





}

?>

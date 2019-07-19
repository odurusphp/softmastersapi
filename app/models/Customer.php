<?php

class Customer extends tableDataObject{


    const TABLENAME = 'customers';

    public static  function getcustomersbyTelephone($telephone){
        global $connectedDb;
        $getrecords = "SELECT  *  FROM customers WHERE telephone like '%$telephone%'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }

    public static  function getTelephonebyStoreNumber($storenumber){
        global $connectedDb;
        $getrecords = "SELECT telephone  FROM customers WHERE storenumber like '%$storenumber%'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static  function getcustomerscountbyTelephone($telephone){
        global $connectedDb;
        $getrecords = "SELECT count(*) as CT  FROM customers WHERE telephone = '$telephone'   ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }



    public static  function getcustomerscountbyStore($storenumber){
        global $connectedDb;
        $getrecords = "SELECT count(*) as CT  FROM stores  WHERE  storenumber  like '%$storenumber%'   ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static  function getstorecountbystore($staffid, $storenumber){
        global $connectedDb;
        $getrecords = "SELECT count(*) as ct  from stores  where staffid = '$staffid' and storenumber = '$storenumber'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static  function getcustomers(){
        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE firstname  IS NOT NULL OR firstname <> '' LIMIT 1000  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }

    public static  function getcustomercount($type){
        global $connectedDb;
        if($type == 'All'){
            $getrecords = "SELECT count(*) as mcount FROM customers where source = 'old' ";
            $connectedDb->prepare($getrecords);
            $connectedDb->execute();
            return $connectedDb->fetchColumn();
        }elseif($type == 'Pending' || $type == ''){
            $getrecords = "SELECT count(*) as mcount FROM customers where source = 'old' and status is null  ";
            $connectedDb->prepare($getrecords);
            $connectedDb->execute();
            return $connectedDb->fetchColumn();
        }elseif($type == 'validated'){
            $getrecords = "SELECT count(*) as ct FROM customers where source = 'old' and status = 'validated' and telephone !='' ";
            $connectedDb->prepare($getrecords);
            $connectedDb->execute();
            return $connectedDb->fetchColumn();

        }

    }

    public static  function getcustomerdetails($type){
        global $connectedDb;
        if($type == 'All'){
            $getrecords = "SELECT *  FROM customers where source = 'old' ";
        }elseif($type == 'Pending' || $type == ''){
            $getrecords = "SELECT * FROM customers where source = 'old' and status is null  ";
        }elseif($type == 'kma'){
            $getrecords = "SELECT customers.lastname, customers.firstname, customers.dateofbirth, customers.middlename,
                            customers.gender, customers.placeofbirth, customers.age,customers.telephone,
                            customers.nationality, customers.marital,
                            customers.natureoftrade,customers.occupancy,customers.idnumber, customers.idtype, stores.storenumber, stores.structure
                            FROM customers  LEFT OUTER JOIN stores ON customers.staffid = stores.staffid
                            WHERE  STATUS='validated' AND telephone != '' AND stores.storenumber != '' AND
                            stores.storenumber  LIKE '%kma%' AND occupancy='owned'
                            GROUP BY telephone  ";
        }
        elseif($type == 'central'){
            $getrecords = "SELECT customers.lastname, customers.firstname, customers.dateofbirth, customers.middlename,
                            customers.gender, customers.placeofbirth, customers.age,customers.telephone,
                            customers.nationality, customers.marital,
                            customers.natureoftrade,customers.occupancy,customers.idnumber, customers.idtype, stores.storenumber, stores.structure
                            FROM customers  LEFT OUTER JOIN stores ON customers.staffid = stores.staffid
                            WHERE  STATUS='validated' AND telephone != '' AND stores.storenumber != '' AND
                            stores.storenumber  NOT LIKE '%kma%' AND (occupancy='owned' OR occupancy = 'leased')
                            GROUP BY telephone  ";
        }

        elseif($type == 'nooccupancy'){
            $getrecords = "SELECT * FROM customers WHERE STATUS='validated' AND source = 'old' AND occupancy = ''
          AND (storenumber IS NOT NULL AND telephone <> '')   GROUP BY storenumber, telephone ";
        }
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }



    public static function getstorecount($staffid){
        global $connectedDb;
        $getrecords = "SELECT count(*) as stores FROM stores where staffid = '$staffid' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static function insertstores($staffid, $storenumber, $structure, $owner){
        global $connectedDb;
        $getrecords = "INSERT INTO stores (staffid, storenumber, structure, owner) values ('$staffid', '$storenumber', '$structure', '$owner') ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }

    public static function updatestores($staffid, $storenumber, $structure, $owner){
        global $connectedDb;
        $getrecords = "UPDATE stores set storenumber ='$storenumber',  structure='$structure', owner = '$owner' where staffid = '$staffid'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }

    public static function getstores($staffid){
        global $connectedDb;
        $getrecords = "SELECT * FROM stores where staffid = '$staffid' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }

    public static function searchcustomers($value){
        global $connectedDb;
        $getrecords = "select * from customers where concat_ws(' ',firstname,lastname)
                    like '$value%' or  (telephone like '$value%') or (storenumber like '%$value%')
                     and status = 'validated' limit 0, 20 ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }

    public static  function approvecustomer($cid, $status){
        global $connectedDb;
        $getrecords = "INSERT INTO approvedcustomers (cid, status) values ($cid, $status)";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }

    public static  function updateapprovecustomer($cid, $status){
        global $connectedDb;
        $getrecords = "UPDATE  approvedcustomers SET status = '$status' where cid = $cid ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }

    public static  function approvecustomercount($cid){
        global $connectedDb;
        $getrecords = "SELECT count(*) as ct from  approvedcustomers where  cid = $cid ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();
    }



    public static function getagent($telephone){
        global $connectedDb;
        $getrecords = "SELECT agentcompany from customers where source = 'new' and telephone =  '$telephone' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }

    public static function updatebytelephone($telephone){
        global $connectedDb;
        $getrecords = "UPDATE customers SET registereddate = '07-MAY-15' where telephone like '%$telephone%'
                        AND (registereddate IS NULL   OR registereddate= '') ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
    }


    public static function getTenants($storenumber){

        global $connectedDb;
        $getrecords = "SELECT customers.*,  stores.storenumber from customers inner join stores ON
                       customers.staffid = stores.staffid where stores.storenumber like '%$storenumber%'
                       and occupancy != 'owned' ";
        $connectedDb->prepare($getrecords);
        //$connectedDb->execute();
        return $connectedDb->resultSet();

    }

    public static function printCard($start, $range){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND storenumber != '' AND
                       storenumber  LIKE '%kma%' AND occupancy='owned' GROUP BY telephone
                       ORDER BY lastname ASC LIMIT $start, $range ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }


    public static function printkmawithoutprotocol(){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND storenumber != '' AND
                      storenumber  LIKE '%kma%' AND (
                      storenumber   NOT LIKE '%ptc%' AND storenumber   NOT LIKE '%sc%'  AND storenumber NOT LIKE '%prl%'
                      AND storenumber NOT LIKE '%plt%'  AND storenumber NOT LIKE '%por%' )
                      AND occupancy='owned' GROUP BY telephone
                      ORDER BY lastname";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }

    public static function printkmawithprotocol(){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND storenumber != '' AND
                      storenumber  LIKE '%kma/ptc%' OR storenumber  LIKE '%kma/sc%' OR storenumber
                      OR storenumber  LIKE '%kma/plt%' OR storenumber  LIKE '%kma/por%'
                      AND occupancy='owned' GROUP BY telephone
                      ORDER BY lastname";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }

    public static function printcentralmarket($start, $range){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND
                       storenumber != '' AND
                       storenumber  NOT LIKE '%kma%' AND (occupancy='leased' OR occupancy = 'owned')  GROUP BY telephone
                       ORDER BY lastname ASC LIMIT $start, $range ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }

    public static function printcentralmarketexcel(){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND
                       storenumber != '' AND
                       storenumber  NOT LIKE '%kma%' AND (occupancy='leased' OR occupancy = 'owned')  GROUP BY telephone
                       ORDER BY lastname ASC ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }

    public static function printcentralmarketbutchers(){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND
                       storenumber != '' AND
                       storenumber  NOT LIKE '%butcher%' AND (occupancy='leased' OR occupancy = 'owned')  GROUP BY telephone
                       ORDER BY lastname ASC ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }

    public static function printCardwithpicture(){
        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE  STATUS='validated' AND telephone != '' AND storenumber != '' AND
                       storenumber  LIKE '%kma%' AND occupancy='owned' GROUP BY telephone
                       ORDER BY lastname ASC  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();
    }


    public static function getvalidated($telephone){
        global $connectedDb;
        $getrecords = "SELECT count(*) as ct from customers where telephone = '$telephone' and telephone <> '' and telephone <> '0'  and status = 'validated'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static function getvalidatedstores($storenumber){
        global $connectedDb;
        $getrecords = "SELECT count(*) as ct from customers where storenumber <> '' and storenumber is not null  and storenumber like '%$storenumber%'  and status = 'validated'  ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->fetchColumn();
    }

    public static  function getownersbyTelephone($telephone){
        global $connectedDb;
        $getrecords = "SELECT *  FROM customers WHERE telephone = '$telephone'    ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->singleRecord();
    }

    public static  function getapprovedbyTelephone($telephone){
        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE telephone like  '%$telephone%' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->singleRecord();
    }

    public static  function getapprovedbyStore($storenumber){
        global $connectedDb;
        $getrecords = "SELECT customers.staffid , stores.storenumber, customers.telephone, customers.age,
                      customers.occupancy, customers.registereddate, customers.cid, customers.dateofbirth,
                      customers.status
                      FROM customers INNER JOIN stores ON customers.staffid = stores.staffid WHERE
                      stores.storenumber LIKE '%$storenumber%' ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->singleRecord();
    }

    public static  function getownersbystore($store){
        global $connectedDb;
        $getrecords = "SELECT customers.firstname, customers.lastname, customers.staffid,
                      customers.registereddate, customers.telephone, customers.age, customers.occupancy,
                      customers.validatedate, customers.cid, stores.storenumber FROM customers INNER JOIN stores
                      ON customers.staffid = stores.staffid WHERE  stores.storenumber LIKE '%$store%'
                      AND (stores.storenumber <> '' and stores.storenumber is not null)  ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->singleRecord();
    }

    public static function getEmployees(){

        global $connectedDb;
        $getrecords = "SELECT * FROM customers WHERE category = 'Employees' ";
        $connectedDb->prepare($getrecords);
        $connectedDb->execute();
        return $connectedDb->resultSet();

    }


    public static function getapprovedCustomers($cid){

        global $connectedDb;
        $getrecords = "SELECT count(*) as ct  FROM approvedcustomers WHERE  cid = $cid and status = 1 ";
        $connectedDb->prepare($getrecords);
        return $connectedDb->fetchColumn();

    }




}

?>

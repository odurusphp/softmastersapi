<?php

class Reports extends tableDataObject{



    public static  function kejetiaowners($ownership, $groupby){
        global $payrolldb;
        $getrecords = "SELECT  firstname, lastname, middlename, othernames, storenumber, telephone,
                        registereddate, validatedate, occupancy, natureoftrade FROM customers
                        WHERE STATUS = 'validated'  AND storenumber LIKE '%kma%' AND occupancy = '$ownership'
                        GROUP BY $groupby  ORDER BY lastname asc";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();

    }

    public static  function kejetiaownerscount($ownership, $distinct){
        global $payrolldb;
        $getrecords = "SELECT  COUNT(DISTINCT $distinct) as ct FROM customers
                        WHERE STATUS = 'validated'  AND storenumber LIKE '%kma%' AND occupancy = '$ownership'
                        ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }




    public static  function phaseonedata($ownership, $groupby){
        global $payrolldb;
        $getrecords = "SELECT firstname, lastname, middlename, othernames, storenumber, telephone,
        registereddate, validatedate, occupancy, natureoftrade FROM customers 
        WHERE STATUS = 'validated' AND occupancy = '$ownership' 
         AND (validatedate <= '2019-02-01' OR validatedate is null) AND 
        (storenumber LIKE 'a%' OR storenumber LIKE  'b%' OR storenumber LIKE 'c%' 
        OR storenumber LIKE 'd%' OR storenumber LIKE 'e%'
        OR storenumber LIKE  'f%' OR storenumber LIKE 'g%' 
        OR storenumber LIKE 'h%' OR storenumber LIKE 'i%'
        OR storenumber LIKE 'j%' OR storenumber LIKE 'k%' OR storenumber LIKE 'l%' 
        OR storenumber LIKE  'm%' OR storenumber LIKE 'n%' OR storenumber LIKE 'o%' 
        OR storenumber LIKE  'p%' OR storenumber LIKE 'q%' OR storenumber LIKE 'r%' 
        OR storenumber LIKE 's%' OR storenumber LIKE  't%' OR storenumber LIKE 'u%'
        OR storenumber LIKE 'v%'OR storenumber LIKE 'w%' OR storenumber LIKE  'x%' 
        OR storenumber LIKE 'y%' OR storenumber LIKE 'z%') AND   storenumber NOT LIKE  'Kejetia%' 
        AND   storenumber NOT LIKE  'Kma%' AND   storenumber NOT LIKE  'Akua%'
        AND   storenumber NOT LIKE  'kiosk%' AND   storenumber NOT LIKE  'lane%'   
        AND   storenumber NOT LIKE  'central%'   AND   storenumber NOT LIKE  'utf%'   
        AND   storenumber NOT LIKE  'u.t.f%'  AND   storenumber NOT LIKE  'yam%'  
        AND   storenumber NOT LIKE  'main%'   AND   storenumber NOT LIKE  'lane%'  
        AND   storenumber NOT LIKE  'container%'   AND   storenumber NOT LIKE  'butcher%'  
        GROUP BY $groupby ORDER BY lastname asc";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }

    public static  function phaseonecount($ownership, $distinct){
        global $payrolldb;
        $getrecords = "SELECT COUNT(DISTINCT $distinct) as ct FROM customers 
        WHERE STATUS = 'validated' AND occupancy = '$ownership' 
        AND (validatedate <= '2019-02-01' OR validatedate is null) AND 
        (storenumber LIKE 'a%' OR storenumber LIKE  'b%' OR storenumber LIKE 'c%' 
        OR storenumber LIKE 'd%' OR storenumber LIKE 'e%'
        OR storenumber LIKE  'f%' OR storenumber LIKE 'g%' 
        OR storenumber LIKE 'h%' OR storenumber LIKE 'i%'
        OR storenumber LIKE 'j%' OR storenumber LIKE 'k%' OR storenumber LIKE 'l%' 
        OR storenumber LIKE  'm%' OR storenumber LIKE 'n%' OR storenumber LIKE 'o%' 
        OR storenumber LIKE  'p%' OR storenumber LIKE 'q%' OR storenumber LIKE 'r%' 
        OR storenumber LIKE 's%' OR storenumber LIKE  't%' OR storenumber LIKE 'u%'
        OR storenumber LIKE 'v%'OR storenumber LIKE 'w%' OR storenumber LIKE  'x%' 
        OR storenumber LIKE 'y%' OR storenumber LIKE 'z%') AND   storenumber NOT LIKE  'Kejetia%' 
        AND   storenumber NOT LIKE  'Kma%' AND   storenumber NOT LIKE  'Akua%'
        AND   storenumber NOT LIKE  'kiosk%' AND   storenumber NOT LIKE  'lane%'   
        AND   storenumber NOT LIKE  'central%'   AND   storenumber NOT LIKE  'utf%'   
        AND   storenumber NOT LIKE  'u.t.f%'  AND   storenumber NOT LIKE  'yam%'  
        AND   storenumber NOT LIKE  'main%'   AND   storenumber NOT LIKE  'lane%'  
        AND   storenumber NOT LIKE  'container%'   AND   storenumber NOT LIKE  'butcher%'  
       ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function phasetwodata($ownership, $groupby){
        global $payrolldb;
        $getrecords = "SELECT firstname, lastname, middlename, othernames, storenumber, telephone,
        registereddate, validatedate, occupancy, natureoftrade FROM customers 
        WHERE STATUS = 'validated' AND occupancy = '$ownership' AND validatedate > '2019-02-01' AND 
        (storenumber LIKE 'a%' OR storenumber LIKE  'b%' OR storenumber LIKE 'c%' 
        OR storenumber LIKE 'd%' OR storenumber LIKE 'e%'
        OR storenumber LIKE  'f%' OR storenumber LIKE 'g%' 
        OR storenumber LIKE 'h%' OR storenumber LIKE 'i%'
        OR storenumber LIKE 'j%' OR storenumber LIKE 'k%' OR storenumber LIKE 'l%' 
        OR storenumber LIKE  'm%' OR storenumber LIKE 'n%' OR storenumber LIKE 'o%' 
        OR storenumber LIKE  'p%' OR storenumber LIKE 'q%' OR storenumber LIKE 'r%' 
        OR storenumber LIKE 's%' OR storenumber LIKE  't%' OR storenumber LIKE 'u%'
        OR storenumber LIKE 'v%'OR storenumber LIKE 'w%' OR storenumber LIKE  'x%' 
        OR storenumber LIKE 'y%' OR storenumber LIKE 'z%') AND   storenumber NOT LIKE  'Kejetia%' 
        AND   storenumber NOT LIKE  'Kma%' AND   storenumber NOT LIKE  'Akua%'
        AND   storenumber NOT LIKE  'kiosk%' AND   storenumber NOT LIKE  'lane%'   
        AND   storenumber NOT LIKE  'central%'   AND   storenumber NOT LIKE  'utf%'   
        AND   storenumber NOT LIKE  'u.t.f%'  AND   storenumber NOT LIKE  'yam%'  
        AND   storenumber NOT LIKE  'main%'   AND   storenumber NOT LIKE  'lane%'  
        AND   storenumber NOT LIKE  'container%'   AND   storenumber NOT LIKE  'butcher%'  
        GROUP BY $groupby ORDER BY lastname asc";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }

    public static  function phasetwocount($ownership, $distinct){
        global $payrolldb;
        $getrecords = "SELECT COUNT(DISTINCT $distinct) as ct FROM customers 
        WHERE STATUS = 'validated' AND occupancy = '$ownership' AND validatedate > '2019-02-01' AND 
        (storenumber LIKE 'a%' OR storenumber LIKE  'b%' OR storenumber LIKE 'c%' 
        OR storenumber LIKE 'd%' OR storenumber LIKE 'e%'
        OR storenumber LIKE  'f%' OR storenumber LIKE 'g%' 
        OR storenumber LIKE 'h%' OR storenumber LIKE 'i%'
        OR storenumber LIKE 'j%' OR storenumber LIKE 'k%' OR storenumber LIKE 'l%' 
        OR storenumber LIKE  'm%' OR storenumber LIKE 'n%' OR storenumber LIKE 'o%' 
        OR storenumber LIKE  'p%' OR storenumber LIKE 'q%' OR storenumber LIKE 'r%' 
        OR storenumber LIKE 's%' OR storenumber LIKE  't%' OR storenumber LIKE 'u%'
        OR storenumber LIKE 'v%'OR storenumber LIKE 'w%' OR storenumber LIKE  'x%' 
        OR storenumber LIKE 'y%' OR storenumber LIKE 'z%') AND   storenumber NOT LIKE  'Kejetia%' 
        AND   storenumber NOT LIKE  'Kma%' AND   storenumber NOT LIKE  'Akua%'
        AND   storenumber NOT LIKE  'kiosk%' AND   storenumber NOT LIKE  'lane%'   
        AND   storenumber NOT LIKE  'central%'   AND   storenumber NOT LIKE  'utf%'   
        AND   storenumber NOT LIKE  'u.t.f%'  AND   storenumber NOT LIKE  'yam%'  
        AND   storenumber NOT LIKE  'main%'   AND   storenumber NOT LIKE  'lane%'  
        AND   storenumber NOT LIKE  'container%'   AND   storenumber NOT LIKE  'butcher%'  
        ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function kejetiaothers(){
        global $payrolldb;
        $getrecords = "SELECT firstname, lastname, middlename, othernames, storenumber, telephone,
        registereddate, validatedate, occupancy, natureoftrade FROM 
        customers WHERE STATUS = 'validated' 
        AND  (storenumber LIKE '%tables%' OR storenumber  LIKE '%kejetia%'
        OR storenumber  LIKE '%maink%'  OR storenumber  LIKE '%container%')
        GROUP BY telephone ORDER BY validatedate ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function kejetiaotherscount(){
        global $payrolldb;
        $getrecords = "SELECT COUNT(DISTINCT telephone) as ct FROM 
        customers WHERE STATUS = 'validated' 
        AND  (storenumber LIKE '%tables%' OR storenumber  LIKE '%kejetia%'
        OR storenumber  LIKE '%maink%'  OR storenumber  LIKE '%container%') ";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }



    public static  function phaseoneothers(){
        global $payrolldb;
        $getrecords = "SELECT firstname, lastname, middlename, othernames, storenumber, telephone,
        registereddate, validatedate, occupancy, natureoftrade FROM 
        customers WHERE STATUS = 'validated' AND  (validatedate <= '2019-02-01' OR validatedate is null)
        AND  (storenumber LIKE '%central%' OR storenumber  LIKE '%yam%'
        OR storenumber  LIKE '%kiosk%'  OR storenumber  LIKE '%lane%' 
        OR storenumber  OR storenumber  LIKE '%utf%' 
        OR storenumber LIKE '%u.t.f%' OR storenumber LIKE '%but%')
        GROUP BY telephone ORDER BY lastname asc";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function phaseoneotherscount(){
        global $payrolldb;
        $getrecords = "SELECT count(DISTINCT   telephone) as others  FROM 
        customers WHERE STATUS = 'validated'  AND (validatedate <= '2019-02-01' OR validatedate is null)
        AND  (storenumber LIKE '%central%' OR storenumber  LIKE '%yam%'
        OR storenumber  LIKE '%kiosk%'  OR storenumber  LIKE '%lane%' 
        OR storenumber  OR storenumber  LIKE '%utf%' 
        OR storenumber LIKE '%u.t.f%' OR storenumber LIKE '%but%')";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }

    public static  function phasetwoothers(){
        global $payrolldb;
        $getrecords = "SELECT firstname, lastname, middlename, othernames, storenumber, telephone,
        registereddate, validatedate, occupancy, natureoftrade FROM 
        customers WHERE STATUS = 'validated' AND validatedate > '2019-02-1'
        AND  (storenumber LIKE '%central%' OR storenumber  LIKE '%yam%'
        OR storenumber  LIKE '%kiosk%'  OR storenumber  LIKE '%lane%' 
        OR storenumber  OR storenumber  LIKE '%utf%' 
        OR storenumber LIKE '%u.t.f%' OR storenumber LIKE '%but%')
        GROUP BY telephone ORDER BY lastname asc";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }


    public static  function phasetwootherscount(){
        global $payrolldb;
        $getrecords = "SELECT count(DISTINCT   telephone) as others  FROM 
        customers WHERE STATUS = 'validated' AND validatedate > '2019-02-1'
        AND  (storenumber LIKE '%central%' OR storenumber  LIKE '%yam%'
        OR storenumber  LIKE '%kiosk%'  OR storenumber  LIKE '%lane%' 
        OR storenumber  OR storenumber  LIKE '%utf%' 
        OR storenumber LIKE '%u.t.f%' OR storenumber LIKE '%but%')";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }


    public static  function transport(){
        global $payrolldb;
        $getrecords = "SELECT * FROM customers WHERE regtype LIKE 'transp%' GROUP BY vehiclenumber order by lastname asc";
        $payrolldb->prepare($getrecords);
        return $payrolldb->resultSet();
    }

    public static  function transportcount(){
        global $payrolldb;
        $getrecords = "SELECT count(DISTINCT  vehiclenumber) as ct FROM customers WHERE regtype LIKE 'transp%'";
        $payrolldb->prepare($getrecords);
        return $payrolldb->fetchColumn();
    }











}

?>

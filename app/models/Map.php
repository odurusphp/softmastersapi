<?php

require APPROOT .'/config/pgconfig.php';

class Map {

    public static function updatefirstfloor($id, $color){
      global $con;
      $updatedata = $con->query('UPDATE  First  SET  b_color="$color"  WHERE  id = $id ');
      if(!$updatedata) {echo 'Error';  print_r($con->errorInfo()); }
      // $data = $getdata->fetchAll(PDO::FETCH_OBJ);
      // return $data;

    }

}



?>

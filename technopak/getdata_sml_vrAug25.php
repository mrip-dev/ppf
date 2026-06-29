<?php
  include 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    $myObj = (object)array();
    
    //........................................ 
    $pdo = Database::connect();
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
    // This table is used to store DHT11 sensor data updated by ESP32. 
    // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
    $sql = 'SELECT * FROM esp32_table_dht11_leds_update WHERE id="' . $id . '"';
    foreach ($pdo->query($sql) as $row) {
      //$cont;
     // $cont2=123;
      $date = date_create($row['date']);
      $dateFormat = date_format($date,"d-m-Y");
      
      $myObj->id = $row['id'];
      $myObj->temperature = $row['temperature'];
      $myObj->temperature2 = $row['temp2_brooder']; //$row['temperature'];
      $myObj->humidity = $row['humidity'];
      $myObj->humidity2 =  $row['temp3_outside'] ; //$row['humidity'];
      $myObj->cont = $row['update_cont'] ; //$row['humidity'];
      $myObj->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
      $myObj->fc_on1 = $row['fan1_on_temp'];
      
      //*** fans1 valuse update***************
     // $myObj->fc_on1 = (string)$cont2;//$row['fan1_on_temp'];
      $myObj->fc_on1 = $row['fan1_on_temp'];
      $myObj->fc_of1 = $row['fan1_off_temp'];
      $myObj->ft_on1 = $row['fan1_on_time'];
      $myObj->ft_of1 = $row['fan1_off_time'];
      //*** fans2 valuse update***************
      $myObj->fc_on2 = $row['fan2_on_temp'];
      $myObj->fc_of2 = $row['fan2_off_temp'];
      $myObj->ft_on2 = $row['fan2_on_time'];
      $myObj->ft_of2 = $row['fan2_off_time'];
      //*** fans3 valuse update***************
      $myObj->fc_on3 = $row['fan3_on_temp'];
      $myObj->fc_of3 = $row['fan3_off_temp'];
      $myObj->ft_on3 = $row['fan3_on_time'];
      $myObj->ft_of3 = $row['fan3_off_time'];
      //*** fans4 valuse update***************
      $myObj->fc_on4 = $row['fan4_on_temp'];
      $myObj->fc_of4 = $row['fan4_off_temp'];
      $myObj->ft_on4 = $row['fan4_on_time'];
      $myObj->ft_of4 = $row['fan4_off_time'];
      //*** fans5 valuse update***************
      $myObj->fc_on5 = $row['fan5_on_temp'];
      $myObj->fc_of5 = $row['fan5_off_temp'];
      $myObj->ft_on5 = $row['fan5_on_time'];
      $myObj->ft_of5 = $row['fan5_off_time'];
      //*** fans6 valuse update***************
      $myObj->fc_on6 = $row['fan6_on_temp'];
      $myObj->fc_of6 = $row['fan6_off_temp'];
      $myObj->ft_on6 = $row['fan6_on_time'];
      $myObj->ft_of6 = $row['fan6_off_time'];
         //*** fans7 valuse update***************
      $myObj->fc_on7 = $row['fan7_on_temp'];
      $myObj->fc_of7 = $row['fan7_off_temp'];
      $myObj->ft_on7 = $row['fan7_on_time'];
      $myObj->ft_of7 = $row['fan7_off_time'];
      //*** fans8 valuse update***************
      $myObj->fc_on8 = $row['fan8_on_temp'];
      $myObj->fc_of8 = $row['fan8_off_temp'];
      $myObj->ft_on8 = $row['fan8_on_time'];
      $myObj->ft_of8 = $row['fan8_off_time'];
      //*** fans9 valuse update***************
      $myObj->fc_on9 = $row['fan9_on_temp'];
      $myObj->fc_of9 = $row['fan9_off_temp'];
      $myObj->ft_on9 = $row['fan9_on_time'];
      $myObj->ft_of9 = $row['fan9_off_time'];
      //*** fans10 valuse update***************
      $myObj->fc_on10 = $row['fan10_on_temp'];
      $myObj->fc_of10 = $row['fan10_off_temp'];
      $myObj->ft_on10 = $row['fan10_on_time'];
      $myObj->ft_of10 = $row['fan10_off_time'];
      //*** fans11 valuse update***************
      $myObj->fc_on11 = $row['fan11_on_temp'];
      $myObj->fc_of11 = $row['fan11_off_temp'];
      $myObj->ft_on11 = $row['fan11_on_time'];
      $myObj->ft_of11 = $row['fan11_off_time'];
      //*** fans12 valuse update***************
      $myObj->fc_on12 = $row['fan12_on_temp'];
      $myObj->fc_of12 = $row['fan12_off_temp'];
      $myObj->ft_on12 = $row['fan12_on_time'];
      $myObj->ft_of12 = $row['fan12_off_time'];
    
      //*** cooling pad1 valuse update********
      $myObj->pc_on1 = $row['pad1_on_temp'];
      $myObj->pc_of1 = $row['pad1_off_temp'];
      $myObj->pt_on1 = $row['pad1_on_time'];
      $myObj->pt_of1 = $row['pad1_off_time'];
      //*** cooling pad1 valuse update********
      $myObj->pc_on2 = $row['pad2_on_temp'];
      $myObj->pc_of2 = $row['pad2_off_temp'];
      $myObj->pt_on2 = $row['pad2_on_time'];
      $myObj->pt_of2 = $row['pad2_off_time'];
      //*** Heat valuse update******************
      $myObj->hc_on1 = $row['heat_on_temp'];
      $myObj->hc_of1 = $row['heat_off_temp'];
      //*** LED Status  update******************
      $myObj->LED_01 = $row['LED_01'];
      $myObj->LED_02 = $row['LED_02'];
      $myObj->ls_time = $row['time'];
      $myObj->ls_date = $dateFormat;
      $myJSON = json_encode($myObj);
      
      //$fan1_on_temp = $_POST['fan1_on_temp'];
      echo $myJSON;
    }
    Database::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>
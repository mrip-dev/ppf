<?php
  require 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $status_read_sensor_dht11 = $_POST['status_read_sensor_dht11'];
    $led_01 = $_POST['led_01'];
    $led_02 = $_POST['led_02'];
   //*** fans1 valuse update***************
    $fan1_on_temp = $_POST['fan1_on_temp'];
    $fan1_off_temp= $_POST['fan1_off_temp'];
    $fan1_on_time = $_POST['fan1_on_time'];
    $fan1_off_time= $_POST['fan1_off_time'];
    //*** fans2 valuse update***************
    $fan2_on_temp  = $_POST['fan2_on_temp'];
    $fan2_off_temp = $_POST['fan2_off_temp'];
    $fan2_on_time  = $_POST['fan2_on_time'];
    $fan2_off_time = $_POST['fan2_off_time'];
     //*** fans3 valuse update***************
    $fan3_on_temp  = $_POST['fan3_on_temp'];
    $fan3_off_temp = $_POST['fan3_off_temp'];
    $fan3_on_time  = $_POST['fan3_on_time'];
    $fan3_off_time = $_POST['fan3_off_time'];
     //*** fans4 valuse update***************
    $fan4_on_temp  = $_POST['fan4_on_temp'];
    $fan4_off_temp = $_POST['fan4_off_temp'];
    $fan4_on_time  = $_POST['fan4_on_time'];
    $fan4_off_time = $_POST['fan4_off_time'];
     //*** fans5 valuse update***************
    $fan5_on_temp  = $_POST['fan5_on_temp'];
    $fan5_off_temp = $_POST['fan5_off_temp'];
    $fan5_on_time  = $_POST['fan5_on_time'];
    $fan5_off_time = $_POST['fan5_off_time'];
     //*** fans6 valuse update***************
    $fan6_on_temp  = $_POST['fan6_on_temp'];
    $fan6_off_temp = $_POST['fan6_off_temp'];
    $fan6_on_time  = $_POST['fan6_on_time'];
    $fan6_off_time = $_POST['fan6_off_time'];
     //*** fans7 valuse update***************
    $fan7_on_temp  = $_POST['fan7_on_temp'];
    $fan7_off_temp = $_POST['fan7_off_temp'];
    $fan7_on_time  = $_POST['fan7_on_time'];
    $fan7_off_time = $_POST['fan7_off_time']; 
    //*** fans8 valuse update****************
    $fan8_on_temp  = $_POST['fan8_on_temp'];
    $fan8_off_temp = $_POST['fan8_off_temp'];
    $fan8_on_time  = $_POST['fan8_on_time'];
    $fan8_off_time = $_POST['fan8_off_time'];
    //*** fans9 valuse update*****************
    $fan9_on_temp  = $_POST['fan9_on_temp'];
    $fan9_off_temp = $_POST['fan9_off_temp'];
    $fan9_on_time  = $_POST['fan9_on_time'];
    $fan9_off_time = $_POST['fan9_off_time'];
     //*** fans10 valuse update***************
    $fan10_on_temp  = $_POST['fan10_on_temp'];
    $fan10_off_temp = $_POST['fan10_off_temp'];
    $fan10_on_time  = $_POST['fan10_on_time'];
    $fan10_off_time = $_POST['fan10_off_time'];
    //*** fans11 valuse update*****************
    $fan11_on_temp  = $_POST['fan11_on_temp'];
    $fan11_off_temp = $_POST['fan11_off_temp'];
    $fan11_on_time  = $_POST['fan11_on_time'];
    $fan11_off_time = $_POST['fan11_off_time'];
    //*** fans12 valuse update*****************
    $fan12_on_temp  = $_POST['fan12_on_temp'];
    $fan12_off_temp = $_POST['fan12_off_temp'];
    $fan12_on_time  = $_POST['fan12_on_time'];
    $fan12_off_time = $_POST['fan12_off_time'];
    //*** cooling pad1 valuse update***********
    $pad1_on_temp  = $_POST['pad1_on_temp'];
    $pad1_off_temp = $_POST['pad1_off_temp'];
    $pad1_on_time  = $_POST['pad1_on_time'];
    $pad1_off_time = $_POST['pad1_off_time'];
    //*** cooling pad2 valuse update**********
    $pad2_on_temp  = $_POST['pad2_on_temp'];
    $pad2_off_temp = $_POST['pad2_off_temp'];
    $pad2_on_time  = $_POST['pad2_on_time'];
    $pad2_off_time = $_POST['pad2_off_time'];
    //*** Heat valuse update******************
    $heat_on_temp  = $_POST['heat_on_temp'];
    $heat_off_temp = $_POST['heat_off_temp'];
    
    //........................................
    
    //........................................ Get the time and date.
    date_default_timezone_set("Asia/Karachi"); // Look here for your timezone : https://www.php.net/manual/en/timezones.php
    $tm = date("H:i:s");
    $dt = date("Y-m-d");
    //........................................
    
    //........................................ Updating the data in the table.
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
    // This table is used to store DHT11 sensor data updated by ESP32. 
    // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // This table is operated with the "UPDATE" command, so this table will only contain one row.
    $sql = "UPDATE esp32_table_dht11_leds_update SET temperature = ?, humidity = ?, status_read_sensor_dht11 = ?, time = ?, date = ?,fan1_on_temp = ?, fan1_off_temp = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($temperature,$humidity,$status_read_sensor_dht11,$tm,$dt,$fan1_on_temp,$fan1_off_temp,$id));
    Database::disconnect();
    //........................................ 
    
    //........................................ Entering data into a table.
    $id_key;
    $board = $_POST['id'];
    $found_empty = false;
    
    $pdo = Database::connect();
    
    //:::::::: Process to check if "id" is already in use.
    while ($found_empty == false) {
      $id_key = generate_string_id(10);
      // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
      // This table is used to store and record DHT11 sensor data updated by ESP32. 
      // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
      // This table is operated with the "INSERT" command, so this table will contain many rows.
      // Before saving and recording data in this table, the "id" will be checked first, to ensure that the "id" that has been created has not been used in the table.
      $sql = 'SELECT * FROM esp32_table_dht11_leds_record WHERE id="' . $id_key . '"';
      $q = $pdo->prepare($sql);
      $q->execute();
      
      if (!$data = $q->fetch()) {
        $found_empty = true;
      }
    }
    //::::::::
    
    //:::::::: The process of entering data into a table.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
    // This table is used to store and record DHT11 sensor data updated by ESP32. 
    // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // This table is operated with the "INSERT" command, so this table will contain many rows.
		$sql = "INSERT INTO esp32_table_dht11_leds_record (id,board,temperature,humidity,status_read_sensor_dht11,LED_01,LED_02,time,date,fan1_on_temp,fan1_off_temp) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_key,$board,$temperature,$humidity,$status_read_sensor_dht11,$led_01,$led_02,$tm,$dt,$fan1_on_temp,$fan1_off_temp));
    //::::::::
    
    Database::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
  
  //---------------------------------------- Function to create "id" based on numbers and characters.
  function generate_string_id($strength = 16) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }
    return $random_string;
  }
  //---------------------------------------- 
?>
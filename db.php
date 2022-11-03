<?php

if(isset($_GET["link"])) {
   $link = $_GET["link"]; // get temperature value from HTTP GET
   echo $link;

   $servername = "localhost";
   $username = "root";
   $password = "";
   $database_name = "iot";

   // Create MySQL connection fom PHP to MySQL server
   $connection = new mysqli($servername, $username, $password, $database_name);
   // Check connection
   if ($connection->connect_error) {
      die("MySQL connection failed: " . $connection->connect_error);
   }

   $sql = "INSERT INTO link (link)
   SELECT * FROM (SELECT '$link') AS tmp
   WHERE NOT EXISTS (
       SELECT link FROM link WHERE link = '$link'
   ) LIMIT 1;";
   echo $sql;

   if ($connection->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . " => " . $connection->error;
   }

   $connection->close();
} else {
   echo "temperature is not set in the HTTP request";
}
?>

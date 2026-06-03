
<?php
$servername = "localhost";
$username = "besterpsolution";
$password = "DLbayLNmbDqgldb";
// Connection
$connection = new mysqli($servername,
           $username, $password);
if($stmt = $connection->query("SHOW DATABASES")){
  echo "No of records : ".$stmt->num_rows."<br>";
  while ($row = $stmt->fetch_assoc()) {
	$retval = mysqli_select_db( $connection, $row['Database'] );
	$sql = "ALTER TABLE `event` ADD `pdf_file` VARCHAR(255) NOT NULL AFTER `is_delete`";
    $connection->query($sql);
  }
}else{
echo $connection->error;
}
?>

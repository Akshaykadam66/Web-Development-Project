<?php
extract($_GET);
$username = null;
$passwd = null;
$conn = new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$array_products = array();
$stmt = $conn->prepare("SELECT productname FROM products WHERE productname LIKE CONCAT('%',?,'%')");
$stmt->bindParam(1,$term);
$stmt->execute();
while($row =$stmt->fetch(PDO::FETCH_ASSOC)){
	array_push($array_products,$row);
}
$conn = null;
echo json_encode($array_products);
?>

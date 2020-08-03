<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$productcode=$_POST["txtproductcode"];
$productname=$_POST["txtproductname"];
$price=$_POST["txtprice"];
$stock=$_POST["txtstocks"];
$username=null;
$passwd=null;
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("insert into products(productcode,productname,price,stock)values(?,?,?,?)");
$stmt->bindParam(1, $productcode);
$stmt->bindParam(2, $productname);
$stmt->bindParam(3, $price);
$stmt->bindParam(4, $stock);
if($stmt->execute())
{
    echo '<script language="javascript">';
	echo 'alert("Inserted Successfully");';
	echo 'window.location.href="addproduct.html";';
	echo '</script>';
}
 else 
{
    echo '<script language="javascript">';
	echo 'alert("Insertion failed");';
	echo 'window.location.href="addproduct.html";';
	echo '</script>';
}
$conn=null;
echo "$msg";
?>


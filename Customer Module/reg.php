<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$name=$_POST["txtname"];
$area=$_POST["txtarea"];
$city=$_POST["txtcity"];
$pincode=$_POST["txtpincode"];
$emailid=$_POST["txtemailid"];
$mobile=$_POST["txtmobile"];
$password=$_POST["txtpassword"];
$username=null;
$passwd=null;
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("insert into customers(name,area,city,pincode,emailid,mobile,password)values(?,?,?,?,?,?,?)");
$stmt->bindParam(1,$name);
$stmt->bindParam(2,$area);
$stmt->bindParam(3,$city);
$stmt->bindParam(4,$pincode);
$stmt->bindParam(5,$emailid);
$stmt->bindParam(6,$mobile);
$stmt->bindParam(7,$password);
if($stmt->execute())
{
    $msg="Inserted";
}
 else 
{
     $msg="Insertion Failed";
}
$conn=null;
echo "$msg";
?>

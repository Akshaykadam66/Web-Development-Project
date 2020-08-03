<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//A session is a way to store information (in variables) to be used across multiple pages.
$emailid=$_POST["txtemailid"];
$password=$_POST["txtpassword"];
$username=null;
$passwd=null;
$array_customer=array();
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("select * from customers where emailid=? and password=?");
$stmt->bindParam(1, $emailid);
$stmt->bindParam(2, $password);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($array_customer, $row);
}
$c=count($array_customer);
$conn=null;
$msg="";
if($c==0)
{
 	echo '<script language="javascript">';
	echo 'alert("Invalid Login");';
	echo 'window.location.href="custlogin.html";';
	echo '</script>';
}
else
{
    $_SESSION["emailid"]=$emailid;
    $_SESSION["password"]=$password;
    $_SESSION["customerid"]=$array_customer[0]["custid"];
    header("Location:customerhome.html");
}
$conn=null;
echo "$msg";
?>

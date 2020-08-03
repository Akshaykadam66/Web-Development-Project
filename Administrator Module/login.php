<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$loginid=$_POST["txtloginid"];
$password=$_POST["txtpassword"];
$username=null;
$passwd=null;
$array_login=array();
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("select * from users where loginid=? and password=?");
$stmt->bindParam(1,$loginid);
$stmt->bindParam(2,$password);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($array_login,$row);
}
$c=count($array_login);
$conn=null;
$msg="";
if($c==0)
{
echo '<script language="javascript">';
echo 'alert("Invalid Login");';
echo 'window.location.href="login.html";';
echo '</script>';

}
 else 
{
     header("Location:ownerhome.html");
}
echo "$msg";
?>


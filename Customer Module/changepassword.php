	<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
  session_start();
 ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
    </head>
    <body>
        <?php
        $currentpwd=$_POST["txtcurrentpassword"];
        $newpwd=$_POST["txtnewpassword"];
        $confpwd=$_POST["txtconfirmpassword"];
        
        $emailid=$_SESSION["emailid"];
        $password=$_SESSION["password"];
        if($password==$currentpwd)
        {
            $username=null;
            $passwd=null;
            $conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);          
            $stmt=$conn->prepare("update customers set password=? where emailid=?");
            
            $stmt->bindParam(1,$newpwd);
            $stmt->bindParam(2,$emailid);
            
            if($stmt->execute())
            {
                echo '<script language="javascript">';
                echo 'alert("password changed succesfully");';
                 echo 'window.location.href="changepassword.html";';
                 echo '</script>';
                
            }
            else
            {
                 echo '<script language="javascript">';
echo 'alert("try again");';
echo 'window.location.href="changepassword.html";';
echo '</script>';
                 
            }
            }
            else
            {echo '<script language="javascript">';
echo 'alert("Invalid Login");';
echo 'window.location.href="changepassword.html";';
echo '</script>';
            }
            echo $msg;
        
        ?>
    </body>
</html>


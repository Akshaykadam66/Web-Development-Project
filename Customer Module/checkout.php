<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Check Out</title>
    </head>
    <body>
        <?php
        $array_cart=array();
        $array_cartrows=array();
        $totalamount=0;
        $tax=0;
        $netamount=0;
        $orderid=0;
        $orderdate=null;
        $status="New Order";
        // fetch custid from session
      
        $custid=$_SESSION["customerid"];
        echo $custid;
        $username=null;
        $passwd=null;
        $conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
        //find totalamount from cart based on custid
        $stmt=$conn->prepare("select sum(amt) as totalamount  from cart where custid=?");
        $stmt->bindParam(1, $custid);
        if($stmt->execute())
        {
          while($row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
            array_push($array_cart,$row);
          }
         //get the amount
         $totalamount=$array_cart[0]["totalamount"];
         $tax=.04*$totalamount;
         $netamount=$tax+$totalamount;
         
         //get system date
         $orderdate=date("y/m/d");
     
         
         echo $totalamount;
         echo $custid;
         echo $tax;
         echo $netamount;
         //insert into orders table
          $stmtorders=$conn->prepare("insert into orders (custid,orderdate,totalamount,tax,netamount,status)values(?,?,?,?,?,?)");
          $stmtorders->bindParam(1, $custid);                                 
          $stmtorders->bindParam(2, $orderdate );  
          $stmtorders->bindParam(3, $totalamount);
          $stmtorders->bindParam(4, $tax);  
          $stmtorders->bindParam(5, $netamount);  
          $stmtorders->bindParam(6, $status);  
          if($stmtorders->execute())
          {
           //insert into orderdetails table
           //get orderid generated
            $orderid=$conn->lastInsertId();
             //get all rows from cart table and store in array
            $stmtcart=$conn->prepare("select * from cart where custid=?");
            $stmtcart->bindParam(1, $custid);
            if($stmtcart->execute())
            {
              while($row=$stmtcart->fetch(PDO::FETCH_ASSOC))
              {
                 array_push($array_cartrows,$row);
              }
             
            //insert into orderdetails using $array_cartrows
            for($i=0;$i<count($array_cartrows);$i++)
            {
              $stmtorderdetails=$conn->prepare("insert into orderdetails (orderno,productcode,qty,price,amount) values(?,?,?,?,?)");
              $stmtorderdetails->bindParam(1,$orderid);
              $stmtorderdetails->bindParam(2,$array_cartrows[$i]["productcode"]);
              $stmtorderdetails->bindParam(3,$array_cartrows[$i]["qty"]);
              $stmtorderdetails->bindParam(4,$array_cartrows[$i]["price"]);
              $stmtorderdetails->bindParam(5,$array_cartrows[$i]["amt"]);
              $stmtorderdetails->execute();      
           }
           //delete all rows from cart based on custid
           $stmtdel=$conn->prepare("delete from cart where custid=?");
           $stmtdel->bindParam(1,$custid);
           if($stmtdel->execute())
           {
              $_SESSION["orderno"]=$orderid;
              header("Location:viewmyorders.php");
           }
           else
           {
              $msg="Order Failed";
              echo $msg;
           }
          }
            else 
            { 
            $msg="Order Failed";
            echo $msg;
 }
          }
          
 else 
{
     $msg="Order Failed";
     echo $msg;
 }
          }
        
 
      ?>
    </body>
</html>


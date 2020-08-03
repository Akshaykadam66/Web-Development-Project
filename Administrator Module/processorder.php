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
        <title>Process Order</title>
    </head>
    <body>
        <?php
        $orderno=$_REQUEST["param_orderno"];
        $username=null;
        $passwd=null;
        $conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
        $stmt=$conn->prepare("update orders set status='Processed' where orderno=?");
        $stmt->bindParam(1,$orderno);
        if($stmt->execute())
        {
            //fetch order details and store in array
            $array_orderdetails=array();
            $stmtorderdetails=$conn->prepare("select * from orderdetails where  orderno=?");
            $stmtorderdetails->bindParam(1, $orderno);
            $stmtorderdetails->execute();
            while($row=$stmtorderdetails->fetch(PDO::FETCH_ASSOC))
            {
                array_push($array_orderdetails, $row);
            }
            $c=count($array_orderdetails);
            // echo $c;
            for($i=0;$i<$c;$i++)
            {
                $stmtproducts=$conn->prepare("update products set stock=stock-? where productcode=?");
                $stmtproducts->bindParam(1, $array_orderdetails[$i]["qty"]);
                $stmtproducts->bindParam(2, $array_orderdetails[$i]["productcode"]);
                $stmtproducts->execute();
            }
            $conn=null;
            $msg="Order Processed";
        }
        else
        {
            $msg="Process Failed";
        }
        echo $msg;
        ?>
    </body>
</html>




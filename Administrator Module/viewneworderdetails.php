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
        <title>New Order Details</title>
    </head>
    <body>
        <?php
        $orderno=$_REQUEST["param_orderno"];
        $username=null;
        $passwd=null;
        // echo $orderno;
        echo "<br>";
        $conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
        
        $array_orderdetails=array();
        
        $stmt=$conn->prepare("select * from orderdetails where orderno=?");
        $stmt->bindParam(1,$orderno);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            array_push($array_orderdetails,$row);
        }
        $conn=null;
        
        echo "<table border=1>";
        echo "<tr>";
        echo "<td>orderno</td>";
        echo "<td>productcode</td>";
        echo "<td>qty</td>";
        echo "<td>price</td>";
        echo "<td>amount</td>";
        echo "</tr>";
        $c=count($array_orderdetails);
        // echo $c;
        for($i=0;$i<$c;$i++)
        {
            echo "<tr>";
            echo "<td>".$array_orderdetails[$i]["orderno"]."</td>";
            echo "<td>".$array_orderdetails[$i]["productcode"]."</td>";
            echo "<td>".$array_orderdetails[$i]["qty"]."</td>";
            echo "<td>".$array_orderdetails[$i]["price"]."</td>";
            echo "<td>".$array_orderdetails[$i]["amount"]."</td>";
            echo "</tr>";
         }
         echo "</table>";
         echo "<br/>";
         echo "<br/>";
         echo "<a href=processorder.php?param_orderno=$orderno>Process This Order</a>";
        ?>
    </body>
</html>


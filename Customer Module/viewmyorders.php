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
        <title>View Products</title>
    </head>
    <body>
        <?php
        // fetch orders and orderdetails tables based on ordernumber and display
        
        $orderid=$_SESSION["orderno"];
        $array_orders=array();
        $array_orderdetails=array();
        $username=null;
        $passwd=null;
        $conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
        $stmtorders=$conn->prepare("select * from orders where orderno=?");
        $stmtorders->bindParam(1,$orderid);
        
        if($stmtorders->execute())
        {
             while($row=$stmtorders->fetch(PDO::FETCH_ASSOC))
                    
             {
                  array_push($array_orders,$row);
                 
             }
        //fetch order details
             $stmtorderdetails=$conn->prepare("select * from orderdetails where orderno=?");
             
             $stmtorderdetails->bindParam(1,$orderid);
             
             if($stmtorderdetails->execute())
             {
                  while($row=$stmtorderdetails->fetch(PDO::FETCH_ASSOC))
                  {
                      array_push($array_orderdetails,$row);
                  }
             
        
        //display
        echo "Order";
        echo "<table border=1>";
        echo "<tr>";
        echo "<td>ordernumber</td>";
        echo "<td>".$array_orders[0]["orderno"]."</td>";
        echo "</tr>";
        
            echo "<tr>";
        echo "<td>orderdate</td>";
        echo "<td>".$array_orders[0]["orderdate"]."</td>";
        echo "</tr>";
            echo "<tr>";
        echo "<td>customerid</td>";
        echo "<td>".$array_orders[0]["custid"]."</td>";
        echo "</tr>";
        
            echo "<tr>";
        echo "<td>totalamount</td>";
        echo "<td>".$array_orders[0]["totalamount"]."</td>";
        echo "</tr>";
            echo "<tr>";
        echo "<td>tax</td>";
        echo "<td>".$array_orders[0]["tax"]."</td>";
        echo "</tr>";  
        echo "<tr>";
        echo "<td>netamount</td>";
        echo "<td>".$array_orders[0]["netamount"]."</td>";
        echo "</tr>";
        
            echo "<tr>";
        echo "<td>orderstatus</td>";
        echo "<td>".$array_orders[0]["status"]."</td>";
        echo "</tr>";
        echo "</table>";
        //display order details using loop
        echo "<br/>";
        echo "<br/>";
        echo "Order Details";
        echo "<table border=1>";
        echo "<tr>";
        echo "<td>productcode</td>";
        echo "<td>price</td>";
        echo "<td>qty</td>";
        echo "<td>amount</td>";
        echo "</tr>";
        
        for($i=0;$i<count($array_orderdetails);$i++)
        {
           echo "<tr>";
            echo "<td>".$array_orderdetails[$i]["productcode"]."</td>";
           
            echo "<td>".$array_orderdetails[$i]["price"]."</td>";
        
            echo "<td>".$array_orderdetails[$i]["qty"]."</td>";
        
            echo "<td>".$array_orderdetails[$i]["amount"]."</td>";
              echo "</tr>";
           }
         echo "</table>";
        }
        }
         ?>
    </body>
</html>






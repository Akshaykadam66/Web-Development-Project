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
        <title>New Orders</title>
    </head>
    <body>
        <?php
        $array_neworders=array();
        $username=null;
        $passwd=null;
        $conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
        $stmt=$conn->prepare("select orderno,orderdate,orders.custid,name,area,city,pincode,mobile,totalamount,tax,netamount from orders,customers where orders.custid=customers.custid and orders.status='new order'");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            array_push($array_neworders, $row);
        }
        $conn=null;
        $c=count($array_neworders);
  
        echo "<style>
        td, th {
  width: 8rem;
  height: 3rem;
  border: 1px solid #ccc;
  text-align: center;
   
}
td {
  background: lightblue;
  border-color: red;
   
}
body {
  padding: 1rem;
  
}
        </style>";
        echo "<table>";
        echo "<tr>";
        echo "<td><h3>Order Number</h3></td>";
        echo "<td><h3>Order Date</h3></td>";
        echo "<td><h3>Customer ID</h3></td>";
        echo "<td><h3>Customer Name</h3></td>";
        echo "<td><h3>Area</h3></td>";
        echo "<td><h3>City</h3></td>";
        echo "<td><h3>Pin Code</h3></td>";
        echo "<td><h3>Mobile No</h3></td>";
        echo "<td><h3>Total Amount</h3></td>";
        echo "<td><h3>Tax</h3></td>";
        echo "<td><h3>Net Amount</h3>	</td>";
        echo "</tr>";
        for($i=0;$i<$c;$i++)
        {
            $orderno=$array_neworders[$i]["orderno"];
            echo "<tr>";
            echo "<td><a href=viewneworderdetails.php?param_orderno=$orderno>$orderno</a></td>";
            echo "<td>".$array_neworders[$i]["orderdate"]."</td>";
            echo "<td>".$array_neworders[$i]["custid"]."</td>";
            echo "<td>".$array_neworders[$i]["name"]."</td>";
            echo "<td>".$array_neworders[$i]["area"]."</td>";
            echo "<td>".$array_neworders[$i]["city"]."</td>";
            echo "<td>".$array_neworders[$i]["pincode"]."</td>";
            echo "<td>".$array_neworders[$i]["mobile"]."</td>";
            echo "<td>".$array_neworders[$i]["totalamount"]."</td>";
            echo "<td>".$array_neworders[$i]["tax"]."</td>";
            echo "<td>".$array_neworders[$i]["netamount"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        
        ?>
    </body>
</html>


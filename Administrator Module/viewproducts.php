<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$arr_products=array();
$username=null;
$passwd=null;
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("select * from products");
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($arr_products,$row);
}
$conn=null;
$row=count($arr_products);
echo "<style>

table {  
    border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}

td, th {  
    order: 2px solid #AAAAAA;
  padding: 16px 12px;
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
}

td {  
    background: #D0E4F5;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #D0E4F5; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
/* Hover cell effect! */


</style>";
echo "<table border=1>";
echo "<tr>";
echo "<th align=center>Product Code </th>";
echo "<th align=center>Product Name</th>";
echo "<th align=center>Price</th>";
echo "<th align=center>Stocks</th>";
echo "</tr>";
for($i=0;$i<$row;$i++)
{
    echo "<tr>";
    echo "<td>".$arr_products[$i]["productcode"]."</td>";
    echo "<td>".$arr_products[$i]["productname"]."</td>";
    echo "<td>".$arr_products[$i]["price"]."</td>";
    echo "<td>".$arr_products[$i]["stock"]."</td>";	
    echo "</tr>";
}
echo "</table>";
?>





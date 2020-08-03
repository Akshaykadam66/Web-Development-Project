<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$arr_customers=array();
$username=null;
$passwd=null;
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("select * from customers");
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($arr_customers,$row);
}
$conn=null;
$row=count($arr_customers);
echo "<style>

table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 1200px; 
    border-collapse: 
    collapse; border-spacing: 0; 
}

td, th {  
    border: 5px solid transparent; /* No more visible border */
    height: 50px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
}

td {  
    background: #FAFAFA;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
/* Hover cell effect! */


</style>";
echo "<table border=1>";
echo "<tr>";
echo "<th>Customer ID</th>";
echo "<th>Customer Name</th>";
echo "<th>Area</th>";
echo "<th>City</th>";
echo "<th>Pin Code</th>";
echo "<th>E-Mail ID</th>";
echo "<th>Mobile No</th>";
echo "</tr>";
for($i=0;$i<$row;$i++)
{
    echo "<tr>";
    echo "<td>".$arr_customers[$i]["custid"]."</td>";
    echo "<td>".$arr_customers[$i]["name"]."</td>";
    echo "<td>".$arr_customers[$i]["area"]."</td>";
    echo "<td>".$arr_customers[$i]["city"]."</td>";
    echo "<td>".$arr_customers[$i]["pincode"]."</td>";
    echo "<td>".$arr_customers[$i]["emailid"]."</td>";
    echo "<td>".$arr_customers[$i]["mobile"]."</td>";
    echo "</tr>";
}
echo "</table>";
?>




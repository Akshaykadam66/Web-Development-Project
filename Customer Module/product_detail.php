<?php
extract($_GET);
$username=null;
$passwd=null;
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
//The PHP Data Objects (PDO) extension defines a lightweight, 
//consistent interface for accessing databases in PHP.
$array_products=array();
$stmt=$conn->prepare("select * from products where productname = ?");
$stmt->bindParam(1,$search_key_value);
$stmt->execute();
//The parameter PDO::FETCH_ASSOC tells PDO to return the result as an associative array.
//Associative arrays are arrays that use named keys that you assign to them.
//$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
//echo "Peter is " . $age['Peter'] . " years old.";
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
//    The array_push() function inserts one or more elements to the end of an array.
     array_push($array_products,$row);
}
$conn=null;
////echo $array_products;
//foreach($array_products as $x => $x_value) {
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
//}
//The count() function returns the number of elements in an array.

echo "<style>
 #customer {
  font-family: TrebuchetMS, Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customer td, #customer th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customer tr:nth-child(even){background-color: #f2f2f2;}

#customer tr:hover {background-color: #ddd;}

#customer th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>";

$c=count($array_products);

echo "<table border=0 align=center width=80% cellspacing=10 id=customer>";
echo "<tr>";
echo "<th align=left>";
echo "product_code";
echo "</th>";
echo "<th align=left>";
echo "product_name";
echo "</th>";
echo "<th align=left>";
echo "price";
echo "</th>";
echo "<th align=left>";
echo "click here";
echo "</th align=left>";
echo "<th align=left>";
echo "stock";
echo "</th>";
echo "</tr>";
for($i=0;$i<$c;$i++)
{
    $pcode=$array_products[$i]["productcode"];
    $pname=$array_products[$i]["productname"];
    $price=$array_products[$i]["price"];
    $stock=$array_products[$i]["stock"];
    
    echo "<tr>";
    
    echo "<td>";
    echo $pcode;
    echo "</td>";
    
    echo "<td>";
    echo $pname;
    echo "</td>";
    
    echo "<td>";
    echo $price;
    echo "</td>";
    
    echo "<td>";
    echo "<a href='buy.php?param_pcode=$pcode&param_pname=$pname&param_price=$price'>Buy This</a>";
    echo "</td>";
    
    echo "<td>";
    if($stock <=0)
        echo "No Stock Available";
    else
        echo "Stock Available";
    echo "</td>";
    
    
    echo "</tr>";
}
echo "</table>";
?>





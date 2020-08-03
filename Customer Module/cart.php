<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$productcode=$_POST["txtproductcode"];
$price=$_POST["txtprice"];
$qty=$_POST["txtqty"];
$customerid=$_SESSION["customerid"];
$amt=$qty*$price;
$username=null;
$passwd=null;
$conn=new PDO("mysql:host=localhost;dbname=test",$username,$passwd);
$stmt=$conn->prepare("select stock from products where productcode=?");
$stmt->bindParam(1, $productcode);
$stmt->execute();
$stock_data=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    array_push($stock_data, $row);
}
$c=count($stock_data);
echo "the stock left is ";
echo $stock_data[0]["stock"];

$current_stock = $stock_data[0]["stock"];

if($current_stock >= $qty){
		$stmt=$conn->prepare("insert into cart(custid,productcode,price,qty,amt)values(?,?,?,?,?)");
		$stmt->bindParam(1, $customerid);
		$stmt->bindParam(2, $productcode);
		$stmt->bindParam(3, $price);
		$stmt->bindParam(4, $qty);
		$stmt->bindParam(5, $amt);
		if($stmt->execute())
		{
		    $msg="Added To Cart";
		}
		 else 
		{
		     $msg="Failed in Adding to Cart";
		}
		echo "<br>";
		echo "Product Code=$productcode";
		echo"<br/>";
		echo "Amount=$amt";
		echo"<br/>";
		echo "Price=$price";
		echo"<br/>";
		echo "Quantity=$qty";
		echo"<br/>";
		echo"<br/>";
		echo "$msg";
		echo"<br/>";
		echo"<br/>";
		$conn=null;
		echo  "<a href=browse.php> Continue Shopping </a>";
		echo "<br/>";
		echo  "<a href=checkout.php> Check Out </a>";
}else{
	echo '<script language="javascript">';
	echo 'alert("Not Enough Stock!");';
	echo 'window.location.href="browse.php";';
	echo '</script>';
}
?>

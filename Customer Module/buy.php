<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>BUY ITEMS</title>
    </head>
    <body>
        <?php
            $productcode=$_REQUEST["param_pcode"];
            $productname=$_REQUEST["param_pname"];
            $price=$_REQUEST["param_price"];
        ?>
        <form method="POST" action="cart.php">
<style>
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 640px; 
    border-collapse: 
    collapse; border-spacing: 0; 
}

td, th {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
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
</style>
            <table border="0" align="">

                <tr>
                    <td>Product Code</td>
                    <td><input type="text" name="txtproductcode" value="<?php echo $productcode;?>"
                    readonly="true"/>
                    </td>
                </tr>
                
                
                <tr>
                    <td>Product Name</td>
                    <td><input type="text" name="txtproductname" value="<?php echo $productname;?>"
                    readonly="true"/>
                    </td>
                </tr>
               
                <tr>
                    <td>Price</td>
                    <td><input type="text" name="txtprice" value="<?php echo $price;?>"
                    readonly="true"/>
                    </td>
                </tr>
              
                
                <tr>
                    <td>Quantity</td>
                    <td><input type="text" name="txtqty"/></td>
                </tr>
               
                <tr>
                    <td><input type="submit" name="btnsubmit" value="BUY"/></td>
                </tr>  
            </table>
        </form>
    </body>
</html>


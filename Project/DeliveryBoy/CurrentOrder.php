<?php
ob_start();
include("Head.php");
session_start();
include("../Assets/Connection/Connection.php");
$selQry="select *from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_shop s on s.shop_id=p.shop_id where deliveryboy_id='".$_SESSION["did"]."' and cart_status>3 and cart_status<7";

$res=$Conn->query($selQry);
if(isset($_GET["cid"]))

	{
		$upQry="update tbl_cart set cart_status='".$_GET["sts"]."' where booking_id='".$_GET["cid"]."' ";
		if($Conn->query($upQry))
		{
			?>
            <script>
				window.location="CurrentOrder.php";
			</script>
            <?php
		}
	}
	?>
    
            	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CurrentOrder</title>
</head>


<body>
	<br><br><br><br><br>
<h1 align="center">Order Details</h1>
<div id="tab" align="center">
<div align="center">
  <table  border="1">
    <tr>
      <td>SlNo</td>
      <td>Name</td>
      <td>Photo</td>
      <td>Quantity</td>
      <td>Price</td>
      <td>Total Amount</td>
      <td>Shop</td>
	  <td>Payment</td>
      <td>Action</td>
    </tr>
    <?php 
	$i=0;
	while($row=$res->fetch_assoc())
	{
		$quantity=$row["cart_quantity"];
		$price=$row["product_price"];
		$totalamount=$quantity*$price;
		$i++;
		?>
        <tr>
            <td><?php echo $i;?></td> 
            <td><?php echo $row["product_name"];?></td> 
            <td><img src="../Assets/Files/Photo/<?php echo $row["product_photo"];?>" width="47" /></td>
            <td><?php echo $row["cart_quantity"];?></td>
            <td><?php echo $row["product_price"];?></td>
            <td><?php echo $row["shop_name"];?></td>
            <td><?php echo $totalamount;?></td>
	        <td>
				<?php 
				if($row["booking_status"]==1)
					{
						?>
							Payment Pending 
						<?php 
					}
					else
						if($row["booking_status"]==2)
					{
						?>
							Payment Completed 
						<?php 
					}
					
				?>
			</td>
			<td>
            <?php 
	     		 if($row["cart_status"]==4)
					{
						?>
                      		Assigned /
							  <a href="CurrentOrder.php?cid=<?php echo $row ["booking_id"];?>&sts=5">Pick Up From Store</a>
                        <?php 
					}
					else if($row["cart_status"]==5)
					{
						?>
                       		Picked /
							  <a href="CurrentOrder.php?cid=<?php echo $row ["booking_id"];?>&sts=6">Start Ride</a>
                        <?php 
					}
					else if($row["cart_status"]==6)
					{
						?>
                       		Ride Started /
							  <a href="CurrentOrder.php?cid=<?php echo $row ["booking_id"];?>&sts=7">Deliver</a>
                        <?php 
					}
                    else if($row["cart_status"]==7)
					{
						?>
                       		Deliverd
                        <?php 
					}
                    ?>
                
			</td>
                                        
				
       </tr>
<?php
	}
	?>
  </table>
</div>
</div>
</body>
<?php 
include("Foot.php");
ob_flush();
?>
</html>
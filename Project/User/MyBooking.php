<?php
ob_start();
include("Head.php");
session_start();
include("../Assets/Connection/Connection.php");
	{
		$selQry="select * from tbl_booking b inner join tbl_cart c on c.booking_id = b.booking_id inner join  tbl_product p on p.product_id = c.product_id inner join tbl_shop k on k.shop_id=p.shop_id where user_id='".$_SESSION["uid"]."' and booking_status>0 and cart_status>0"; 
	$res=$Conn->query($selQry);
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table border="1">
  <tr>
    <td>SlNo</td>
    <td>Name</td>
    <td>Photo</td>
    <td>Quantity</td>
    <td>Total amount</td>
    <td>shop Name</td>
	<td>Payment</td>
    <td>Status</td>
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
    <td><?php echo  "$totalamount";?></td>
    <td><?php echo $row["shop_name"];?></td>
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
	     		 if($row["cart_status"]==1)
					{
						?>
                      		Order Placed
                        <?php 
					}
					else if($row["cart_status"]==2)
					{
						?>
                       		Order Processing
                        <?php 
					}
					else if($row["cart_status"]==3)
					{
						?>
							Order Ready To Deliver
                        <?php 
					}
					else if($row["cart_status"]==4)
					{
						?>
							Delivery Boy Assigned
                        <?php 
					}
					else if($row["cart_status"]==5)
					{
						?>
							Delivery Boy Picked
                        <?php 
					}
					else if($row["cart_status"]==6)
					{
						?>
							Delivery Boy On The Way
                        <?php 
					}
					else if($row["cart_status"]==7)
					{
						?>
                           Order Deliverd /
                           <a href="ProductRating.php?pid=<?php echo $row["product_id"]; ?>">Review</a>/
                           <a href="bill.php?id=<?php echo $row["cart_id"]; ?>">Bill</a>/
                           <a href="Complaint.php?sid=<?php echo $row["shop_id"]; ?>">Complaint</a>
                        <?php 
					}
					?>
                    </td>
                    
					
       </tr>
<?php
	}
	}
	
	?>
    
</table>

</form>
	</div>
</body>
<?php
include("Foot.php");
ob_flush();
?>
</html>
<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btnupdate"]))
 {
	$name=$_POST["txtname"];
	$contact=$_POST["txtcontact"];
	$email=$_POST["txtemail"];
	$address=$_POST["txtaddress"];
	$upQry="update tbl_deliveryboy set deliveryboy_name='".$name."',deliveryboy_contact='".$contact."',deliveryboy_email='".$email."' where deliveryboy_id='".$_SESSION["did"]."'";
	//echo upQry;
	if($Conn->query($upQry))
			{
				 ?>
        		 <script>
		   		 alert('updated');
				 location.href='MyProfile.php';
				 </script>
				 <?php	
			} 
	
	}

$selQry="select * from tbl_deliveryboy where deliveryboy_id='".$_SESSION["did"]."'";
$result=$Conn->query($selQry);
if($row=$result->fetch_assoc())
{
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<h1 align="center">EditProfile</h1>
  <table align="center" border="1">
    <tr>
      <td >Name</td>
      <td ><label for="txtname"></label>
      <input type="text"value="<?php echo $row["deliveryboy_name"];?>"name="txtname" id="txtname"  pattern"[A-Za-z ]{2,}" required="required" autocomplete="off"/></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txtcontact"></label>
      <input type="text"value="<?php echo $row["deliveryboy_contact"];?>" name="txtcontact" id="txtcontact" pattern="[+0-9]{10,13}" required/></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtemail"></label>
      <input type="email" value="<?php echo $row["deliveryboy_email"];?>"name="txtemail" id="txtemail" required autocomplete="off"/></td>
    </tr>
   
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btnupdate" id="btnupdate" value="Update" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
}
include("Foot.php");
ob_flush();
?>

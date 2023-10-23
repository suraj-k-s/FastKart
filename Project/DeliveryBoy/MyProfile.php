<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="436" height="418" border="1">
   <?php
  $sel="select * from tbl_deliveryboy where deliveryboy_id='".$_SESSION['did']."'";
  $data=$Conn->query($sel);
  while($row=$data->fetch_assoc())
  {
  ?>
    <tr>
      <td colspan="2"><img src="../Assets/Files/Deliveryboy/Photo/<?php echo $row['deliveryboy_photo']?>" width="300" height="200"/></td> 
    </tr>
    <tr>
      <td>NAME</td>
      <td><?php echo $row['deliveryboy_name']?></td>
    </tr>
    <tr>
      <td>EMAIL</td>
      <td><?php echo $row['deliveryboy_email']?></td>
    </tr>
    <tr>
      <td>CONTACT</td>
 <td><?php echo $row['deliveryboy_contact']?></td>
    </tr>
    <tr>
      <td>PROOF</td>
     <td><img src="../Assets/Files/Deliveryboy/Proof/<?php echo $row['deliveryboy_proof']?>" width="200" height="200"/></td>
    </tr>
    <tr>
      <td>GENDER</td>
      <td><?php echo $row['deliveryboy_gender']?></td>
    </tr>
    <tr>
      <td>DOB</td>
     <td><?php echo $row['deliveryboy_dob']?></td>
    </tr>
    <?php
  }
  ?>
  </table>
</form>
</body>
<?php 
include("Foot.php");
ob_flush();
?>
</html>
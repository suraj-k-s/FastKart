<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$cp=$_POST['txt_cpassword'];
	
	 $sel=$Conn->query("select deliveryboy_password from tbl_deliveryboy where deliveryboy_id='".$_SESSION['did']."'");
	 $data = $sel->fetch_assoc();
	if($cp==$data['deliveryboy_password'])
	{
	 	$rp=$_POST['txt_rpassword'];
		$np=$_POST['txt_npassword'];
		if($np==$rp)
		{
			$up="update tbl_deliveryboy set deliveryboy_password='".$np."' where deliveryboy_id='".$_SESSION['did']."'";
			$Conn->query($up);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ChangePassword</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="341" height="228" border="1">
    <tr>
      <td width="93">Current Password</td>
      <td width="151"><label for="txt_cpassword"></label>
      <input type="text" name="txt_cpassword" id="txt_cpassword" /></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><label for="txt_npassword"></label>
      <input type="text" name="txt_npassword" id="txt_npassword" />
      <label for="txt_rpassword"></label></td>
    </tr>
    <tr>
      <td>Re-Enter</td>
      <td><label for="txt_rpassword"></label>
      <input type="text" name="txt_rpassword" id="txt_rpassword" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>
</body>
<?php 
include("Foot.php");
ob_flush();
?>
</html>
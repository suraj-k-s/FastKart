<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit']))
{
  $name=$_POST["txt_name"];
  $contact=$_POST["txt_contact"];
  $email=$_POST["txt_email"];
  $password=$_POST["txt_password"];
  $proof=$_FILES["file_proof"]["name"];
  $way=$_FILES["file_proof"]["tmp_name"];
  move_uploaded_file($way,"../Assets/File/Deliveryboy/Proof".$proof);
  
  $gender=$_POST["radio_gender"];
  $photo=$_FILES["file_photo"]["name"];
  $path=$_FILES["file_photo"]["tmp_name"];
  move_uploaded_file($path,"../Assets/File/Deliveryboy/Photo".$photo);
 
  $dob=$_POST["txt_dob"];
  
$insqry="insert into tbl_deliveryboy(deliveryboy_name,deliveryboy_contact,deliveryboy_email,deliveryboy_password,deliveryboy_proof,deliveryboy_gender,deliveryboy_photo,deliveryboy_dob)values('".$name."','".$contact."','".$email."','".$password."','".$proof."','".$gender."','".$photo."','".$dob."')";
   if($Conn->query($insqry))
     {
	  ?>
       <script>
	   alert('inserted');
	   location.href="DeliveryBoy.php";
	   </script>
     <?php
    }
   else
   {
	?>
     <script>
	  alert('failed');
	  location.href="DeliveryBoy.php";
	 </script>
   <?php
  }
	
}
 
 if(isset($_GET['did']))
 {

  $delqry="delete from tbl_deliveryboy where deliveryboyid='".$_GET['did']."'";
    if($Conn->query($delqry))
	{
		?>
        <script>
		alert('deleted');
		location.href="DeliveryBoy.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('failed');
	    location.href="DeliveryBoy.php";
		</script>
        <?php
	}
 }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="484" height="345" border="1">
    <tr>
      <td width="113">Name</td>
      <td width="355"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="file_proof"></label>
      <input type="file" name="file_proof" id="file_proof" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="radio_gender" id="btn_gender" value="m" />
        Male 
          <input type="radio" name="radio_gender" id="btn_gender2" value="f" />
        <label for="btn_gender2"></label>
        Female</td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>DOB</td>
      <td><label for="txt_dob"></label>
      <input type="date" name="txt_dob" id="txt_dob" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
    <tr>
      <td>District</td>
      <td><label for="txt_district"></label>
      <select name="txt_district" id="txt_district" onchange="getplace(this.value)">
    <option value="">--select--</option>
    <?php
   $data=$Conn->query("select * from tbl_district");
   while($row=$data->fetch_assoc())
   {
    ?>
    <option value=<?php echo $row["district_id"]?>>
    <?php echo $row['district_name']?>
   </option>
   <?php
   }
   ?>
   </select>
    </td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
      <select name="sel_place" id="txt_place" onchange="getlocation(this.value)">
      <option value="">--select--</option>
  </select>
  </td> 
    </tr>
    <tr>
      <td>Location</td>
      <td><label for="txt_location"></label>
      <select name="sel_locatione" id="txt_location">
      <option value="">--select--</option>
  </select>
  </td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="880" height="104" border="1">
    <tr>
      <td>SL.No</td>
      <td>Name</td>
      <td>Contact</td>
      <td>Email</td>
      <td>Photo</td>
      <td>Action</td>
    </tr>
    <?php
	$selqry="select * from tbl_deliveryboy";
	$data=$Conn->query($selqry);
	$i=0;
	while($row=$data->fetch_assoc())
	{
      $i++;
     ?> 
   
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $row['deliveryboy_name']?></td>
      <td><?php echo $row['deliveryboy_contact']?></td>
      <td><?php echo $row['deliveryboy_email']?></td>
      <td><?php echo $row['deliveryboy_photo']?></td>
      <td><a href="DeliveryBoy.php?did=<?php echo $row['deliveryboy_id'];?>">Delete</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
function getplace(did)
	{

		$.ajax({url:"../Assets/AjaxPages/Ajaxplace.php?did="+ did,
		success:function(result)
		{
			
			$("#sel_place").html(result);
		}});
	}
 	function getlocation(pid)
	{

		$.ajax({url:"../Assets/AjaxPages/AjaxLocation.php?pid="+ pid,
		success:function(result)
		{
			$("#sel_location").html(result);
		}});
	}
</html>
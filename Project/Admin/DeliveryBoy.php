<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deliveryboy</title>
</head>
<?php
ob_start();
include('../Assets/Connection/Connection.php');
include('Head.php');
if(isset($_POST["btn_save"]))
{
	
	  $name=$_POST["txt_name"];
	  $contact=$_POST["txt_contact"];
	  $email=$_POST["txt_email"];
	  $password=$_POST["txt_password"];
	  $location=$_POST["sel_location"];
	  $proof=$_FILES["file_proof"]["name"];
	  $way=$_FILES["file_proof"]["tmp_name"];
	  move_uploaded_file($way,"../Assets/Files/Deliveryboy/Proof/".$proof);
	  
	  $gender=$_POST["rdo_gender"];
	  $photo=$_FILES["file_photo"]["name"];
	  $path=$_FILES["file_photo"]["tmp_name"];
	  move_uploaded_file($path,"../Assets/Files/Deliveryboy/Photo/".$photo);
	 
	  $dob=$_POST["txt_dob"];
	
		$insqry="INSERT INTO `tbl_deliveryboy`(`deliveryboy_name`, `deliveryboy_contact`, `deliveryboy_email`, `deliveryboy_password`, `deliveryboy_proof`, `deliveryboy_gender`, `deliveryboy_photo`, `deliveryboy_dob`, `location_id`)values('".$name."','".$contact."','".$email."','".$password."','".$proof."','".$gender."','".$photo."','".$dob."','".$location."')";
	   if($Conn->query($insqry))
		 {
		  ?>
		   <script>
		   alert('inserted');
		  // location.href="DeliveryBoy.php";
		   </script>
		 <?php
		}
	   else
	   {
		?>
		 <script>
		  alert('failed');
		  //location.href="DeliveryBoy.php";
		 </script>
	   <?php
	  }
		
}
if(isset($_GET['did']))
 {

  $delqry="delete from tbl_deliveryboy where deliveryboy_id='".$_GET['did']."'";
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
<body>
        <section class="main_content dashboard_part">
            <div class="main_content_iner ">
                <div class="container-fluid p-0">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="QA_section">
                                <!--Form-->
                                <div class="white_box_tittle list_header">
                                    <div class="col-lg-12">
                                        <div class="white_box mb_30">
                                            <div class="box_header ">
                                                <div class="main-title">
                                                    <h3 class="mb-0" >Table Delivery Boy</h3>
                                                </div>
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="txt_name">Name</label>
                                                    <input type="text" class="form-control" required="" name="txt_name" id="txt_name" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Contact</label>
                                                    <input name="txt_contact" type="text" required="" class="form-control" id="txt_contact" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">DOB</label>
                                                    <input name="txt_dob" type="date" required="" class="form-control" id="txt_dob" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Gender</label>
                                                    <input name="rdo_gender" type="radio" required=""  id="rdo_gender" value="Male"/> Male 
                                                    <input name="rdo_gender" type="radio"   id="rdo_gender" value="Female"/> Female
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Email</label>
                                                    <input type="text" required="" class="form-control" name="txt_email" id="txt_email" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Proof</label>
                                                    <input type="file" required="" class="form-control" name="file_proof" id="file_proof" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">District</label>
                                                            <select name="txt_district" required="" class="form-control" id="txt_district" onChange="getplace(this.value)">
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Place</label>
                                                   <select name="sel_place" id="sel_place" required="" class="form-control" onChange="getlocation(this.value)">
      <option value="">--select--</option>
  </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Location</label>
                                                    <select name="sel_location" required="" class="form-control" id="sel_location">
      <option value="">--select--</option>
  </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_name">Photo</label>
                                                    <input type="file" required="" class="form-control" name="file_photo" id="file_photo" />
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="txt_name">Password</label>
                                                    <input type="password" required="" class="form-control" name="txt_password" id="txt_password" />
                                                </div>
                                                <div class="form-group" align="center">
                                                        <input type="submit" class="btn-dark" style="width:100px; border-radius: 10px 5px " name="btn_save" value="Save">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="QA_table mb_30">
                                    <!-- table-responsive -->
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr style="background-color: #74CBF9">
                                                <td align="center" scope="col">Sl.No</td>
                                                <td align="center" scope="col">NAME</td>
                                                <td align="center" scope="col">PRICE</td>
                                                <td align="center" scope="col">IMAGE</td>
                                                <td align="center" scope="col">DETAILS</td>
                                                <td align="center" scope="col">ACTION</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
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

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
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
	
	</script>
        </section>
        <?php
        include('Foot.php');
         ob_end_flush();
        ?>
</body>
</html>
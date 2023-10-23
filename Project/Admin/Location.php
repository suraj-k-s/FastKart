<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Location</title>
</head>
<?php
ob_start();
include('../Assets/Connection/Connection.php');
include('Head.php');


if(isset($_POST['btn_save']))
	{
		$location = $_POST['txt_location'];
		$place = $_POST['sel_place'];
		
		
			$ins = "insert into tbl_location (location_name,place_id) values('".$location."','".$place."')";
		
			if($Conn->query($ins))
			{
				header("location:Location.php");
			}
		
		
		
	}

	
	if(isset($_GET['id']))
	{
		$del = "delete from tbl_location where location_id = '".$_GET['id']."'";
		if($Conn->query($del))
		{
			header("location:Location.php");
		}
	}

?>

<body>
        <section class="main_content dashboard_part">

            <!--/ menu  -->
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
                                                    <h3 class="mb-0" >Table Location</h3>
                                                </div>
                                            </div>
                                            <form method="post">
                                             <div class="form-group">
                                                    <label for="txt_district">District</label>
                                                    <select class="form-control" name="sel_district" id="sel_district" autocomplete="off" required onchange="getplace(this.value)" >
                                                    <option value="">-----Select-----</option>
                                                    <?php
                                                          $sel ="select * from tbl_district";
                                                  $row = $Conn->query($sel);
                                                  while($data = $row->fetch_assoc())
                                                  {
                                                 ?>
                                                     <option value="<?php echo $data['district_id'];?> " 
                                                      ><?php echo $data['district_name']; ?></option >
                                                     
                                                     <?php
                                                     }
                                                     ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_place">Place</label>
                                                    <select class="form-control" name="sel_place" id="sel_place" autocomplete="off" required>
                                                    <option value="">-----Select-----</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_place">Location</label>
                                                    <input type="text" name="txt_location" id="txt_location" class="form-control" autocomplete="off" required/>
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
                                              	<td align="center" scope="col">District</td>
                                                <td align="center" scope="col">Place</td>
                                                <td align="center" scope="col">Location </td>
                                                <td align="center" scope="col">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
	$i=0;
	  $sel = "select * from tbl_location p inner join tbl_place d on d.place_id=p.place_id inner join tbl_district s on s.district_id=d.district_id";
	  $row = $Conn->query($sel);
	  while($data = $row->fetch_assoc())
	  {
		  $i++;
		  ?>  
                                            <tr>
                                               <td align="center"><?php echo $i; 	?></td>
                   
            <td align="center"><?php echo $data['district_name']; ?></td>
            <td align="center"><?php echo $data['place_name']; ?></td>
            <td align="center"><?php echo $data['location_name']; ?></td>
            <td align="center">
            <a class="status_btn"  href="Location.php?id=<?php echo $data['location_id']; ?>">Delete </a>
		
         </td>
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

        </section>
        <?php
		include('Foot.php');
		 ob_end_flush();
		?>
        
         <script src="../Assets/Jq/jQuery.js"></script>
    <script>
      function getplace(sid) {
        $.ajax({
          url: "../Assets/AjaxPages/Ajaxplace.php?did="+sid,
          success: function (result) {
            $("#sel_place").html(result);
          },
        });
      }
	  </script>
</body>
</html>
<?php
ob_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<br /><br /><br /><br /><br />
<div id="tab" align="center">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table  border="1" align="center">
    <tr>
      <td>District</td>
      <td>
        <select name="sel_district" id="sel_district" onChange="getplace(this.value),getShop()" required>
          <option value="">---select---</option>
              <?php
          $districtQry="select * from tbl_district";
          $res=$Conn->Query($districtQry);
          while($row=$res->fetch_assoc())
          {
        ?>
          <option value=<?php echo $row["district_id"]; ?> > <?php echo $row["district_name"]; ?>
          </option>
          <?php
          }?>
        </select>
      </td>
      <td>place</td>
      <td>
        <select name="sel_place" id="sel_place" onChange="getlocation(this.value),getShop()" required>
          <option value="">---select---</option>
        </select>
      </td>
     <td>location</td>
      <td><label for="sel_location"></label>
      <label for="sel_location"></label>
        <select name="sel_location" id="sel_location" onChange="getShop()" required>
        <option value="">---select---</option>
        </select></td>
    </tr>
    </table>
</form>
          <div id="tableData">
            <h2>No Data Found</h2>
          </div>
</div>
</body>
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

		$.ajax({url:"../Assets/AjaxPages/Ajaxlocation.php?pid="+ pid,
		success:function(result)
		{
			$("#sel_location").html(result);
		}});
	}

  function getShop()
	{

    var did = document.getElementById("sel_district").value;
    var pid = document.getElementById("sel_place").value;
    var lid = document.getElementById("sel_location").value;

		$.ajax({url:"../Assets/AjaxPages/AjaxShop.php?did="+ did+"&pid="+pid+"&lid="+lid,
		success:function(result)
		{
			$("#tableData").html(result);
		}});
	}
	
	</script>
    <?php 
	include("Foot.php");
	ob_flush();
	?>
</html>
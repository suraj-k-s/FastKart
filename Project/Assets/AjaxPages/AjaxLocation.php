<option value="">---select---</option>
<?php
include("../Connection/Connection.php");
		$selQry = "select * from tbl_location where place_id='".$_GET["pid"]."'";
		$re = $Conn->query($selQry);
		while($row=$re->fetch_assoc())
		{
			?>
				<option value="<?php echo $row["location_id"]?>"><?php echo $row["location_name"]?></option>
                <?php
		}
?>
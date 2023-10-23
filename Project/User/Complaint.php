<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_POST["btnsubmit"]))
{
		$content=$_POST["txtcontent"];
    $title=$_POST["txttitle"];
		$insQry="insert into tbl_complaint(complaint_title,complaint_date,complaint_content,user_id,shop_id)values('".$title."',curdate(),'".$content."','".$_SESSION["uid"]."','".$_GET["sid"]."')";
		echo $insQry;
			if($Conn->query($insQry))
			{	?>
            	<script>
					alert('Inserted');
					location.href='Complaint.php?sid='+<?php echo $_GET["sid"] ?>;
				</script>
              <?php
				
			}
			else
			{   
			?>
            	<script>
				alert('Failed');
				location.href='Complaint.php?sid='+<?php echo $_GET["sid"] ?>;
				</script>
                <?Php
             }
}
?>
<form id="form1" name="form1" method="post" action="">
 <h1 align="center">Complaint</h1>
 
    <table  align="center" width="449" border="1">
      <tr>
        <td width="60">Title</td>
        <td width="373">
          <input type="text" name="txttitle"/>
      </td>
    </tr>
       
      <tr>
        <td>Content</td>
        <td><label for="txtcontent"></label>
        <textarea name="txtcontent" id="txtcontent" cols="45" rows="5" autocomplete="off" required></textarea></td>
      </tr>
      <tr>
        <td align="center"colspan="2"><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" /></td>
      </tr>
    </table>
<p>&nbsp;</p>
  <?php
  $selQry="select * from tbl_complaint c inner join tbl_shop s on s.shop_id=c.shop_id where user_id='".$_SESSION["uid"]."'";
  $rel=$Conn->query($selQry);
  if($rel->num_rows>0)
  {
?>
  <table align="center" border="1">
    <tr>
      <td>Sl.No</td>
      <td>Title</td>
      <td>Date</td>
      <td>Shop</td>
       <td>Content</td>
      <td>Replay</td>
    </tr>
    <?php
	$i=0;
	
	while($row=$rel->fetch_assoc())
	{
		$i++;
?>
<tr>
	<td><?php echo $i?></td> 
    <td><?php echo $row["complaint_title"]?></td> 
    <td><?php echo $row["complaint_date"]?></td>
    <td><?php echo $row["shop_name"]?></td> 
     <td><?php echo $row["complaint_content"]?></td> 
    <td><?php echo $row["complaint_reply"]?></td> 


</tr>
<?php
	}
   }
   else
   {
	   echo "<h1 align='center'>No Data Found<h1>";
   }

?>   
  </table>
  <p>&nbsp;</p>
</form>
</body>
<?php
include("Foot.php");
ob_flush();
?>
</html>
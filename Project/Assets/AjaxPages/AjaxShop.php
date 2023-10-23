<?php
include("../Connection/Connection.php");

        $sqlQry = "SELECT * from tbl_shop k inner join tbl_location l on l.location_id=k.location_id inner join tbl_place p on p.place_id=l.place_id inner join tbl_district d on d.district_id=p.district_id where shop_status=1 ";
       
        if ($_GET["did"]!=null) {

            $did = $_GET["did"];

            $sqlQry = $sqlQry." AND d.district_id ='".$did."'";
        }
        if ($_GET["pid"]!=null) {

            $pid = $_GET["pid"];

            $sqlQry = $sqlQry." AND p.place_id ='".$pid."'";
        }
        if ($_GET["lid"]!=null) {

            $lid = $_GET["lid"];

            $sqlQry = $sqlQry." AND p.place_id ='".$pid."'";
        }
        $resultS = $Conn->query($sqlQry);

        if ($resultS->num_rows > 0) {
           ?>
            <table>
                <tr>
                    <?php
                    $i=0;
                     while ($rowS = $resultS->fetch_assoc()) {
                        $i++;
                        ?>
                        <td>
                            <table border='1'>
                                <tr>
                                    <td colspan='2'>
                                        <img src="../Assets/Files/Photo/<?php echo $rowS["shop_photo"]?>" width="120" height="120"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                        <?php echo $rowS["shop_name"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Contact
                                    </td>
                                    <td>
                                        <?php echo $rowS["shop_contact"] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2' align="center">
                                        <a href="SearchProduct.php?sid=<?php echo $rowS["shop_id"]; ?>" width="120" height="120">Product</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php
                     }
                    ?>
            </table>
           <?php
            
        } else {
             echo " <h2>No Data Found</h2>";
        }


?>
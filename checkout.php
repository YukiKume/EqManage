<?php
session_start();
if(!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
include ('serverconnect.php');
?>
<!DOCTYPE html>
<html>
<?php
include('header.php');
?>
<body class="form-v8 loggedin" id="fade">

<div id="loader">
<div class="loader"><div></div><div></div><div></div><div></div></div>
</div>

<?php include('navbar.php'); ?>

<div class="content">
    <div>
        <h2>Check Out</h2>

        <p>
            <?php

            $resultset = mysqli_query($db, "select * from equipment where leftQuantity >= 1");
            ?>
        <div class="select-style" style="width:500px; margin: auto;" align="center">
            <form action="checkout-process.php" style="width: 100%;" align="center" method="POST">
<!--                //old select-->
<!--                <select name="equipment" class="select-picker" >-->
<!--                    <option value="" disabled selected>Select the Equipment</option>-->
<!--                    --><?php
//                        while ($row = mysqli_fetch_array($resultset)) {
//                            $Equipment = $row['equipment'];
//                            $equip_id = $row['id'];
//
//
//                            if (isset($_GET['selected']) && $_GET['selected'] == $equip_id) {
//                                echo "<option value='$Equipment' selected='selected'>$Equipment</option>";
//                            } else echo "<option value='$Equipment' >$Equipment</option>";
//                    }
//                    ?>
<!--                </select>-->

                <?php
                $sql="SELECT C.categoryName, E.id, E.equipment
      FROM EqManage.categories C
      LEFT JOIN EqManage.equipment E ON C.id=E.category
      GROUP BY C.id,E.id
      ORDER BY C.categoryName,E.equipment;";
                if($result=mysqli_query($db,$sql)){
                    if(mysqli_num_rows($result)){
                        $last_group=null;
                        $select="<select name=\"equipments\"> <option value=\"\" disabled selected>Select the Equipment</option>";

                        while($row=mysqli_fetch_assoc($result)){
                            if($row["categoryName"]!=$last_group){
                                $select.=($last_group!=null?"</optgroup>":"")."<optgroup label=\"{$row["categoryName"]}\">";
                                $last_group=$row["categoryName"];
                            }
                            if($row["id"]==null){
                                $select.="<option disabled>No Available Equipment From This Category</option>";
                            }else{
                                $select.="<option value=\"{$row["equipment"]}\">{$row["equipment"]}</option>";
                            }
                        }
                        $select.="</optgroup></select>";

                        echo $select;
                        mysqli_free_result($result);
                    }else{
                        echo "Empty Resultset From Query";
                    }
                }else{
                    echo mysqli_error($db);
                }

//                $sql="SELECT M.manufacturer_name,P.product_id,P.model_number
//      FROM manufacturer M
//      LEFT JOIN product P ON M.manufacturer_id=P.manufacturer_id
//      GROUP BY M.manufacturer_id,P.product_id
//      ORDER BY M.manufacturer_name,P.model_number;";
//                if($result=mysqli_query($con,$sql)){
//                    if(mysqli_num_rows($result)){
//                        $last_group=null;
//                        $select="<select name=\"products\">";
//                        while($row=mysqli_fetch_assoc($result)){
//                            if($row["manufacturer_name"]!=$last_group){
//                                $select.=($last_group!=null?"</optgroup>":"")."<optgroup label=\"{$row["manufacturer_name"]}\">";
//                                $last_group=$row["manufacturer_name"];
//                            }
//                            if($row["product_id"]==null){
//                                $select.="<option disabled>No Products</option>";
//                            }else{
//                                $select.="<option value=\"{$row["product_id"]}\">{$row["model_number"]}</option>";
//                            }
//                        }
//                        $select.="</optgroup></select>";
//                        echo $select;
//                        mysqli_free_result($result);
//                    }else{
//                        echo "Empty Resultset From Query";
//                    }
//                }else{
//                    echo mysqli_error($con);
//                }

                ?>




                <textarea type="text" id="purpose" name="purpose" placeholder="Purpose/Location/Date to be returned" style="padding: 10px 15px; border: 1px solid #ccc;
  border-radius: 4px; margin-top: 10px"></textarea>
                <input name="request" type="submit" value="Check Out" style="width: 100%;">
            </form>
        </div>
        </p>

    </div>
</div>


</body>


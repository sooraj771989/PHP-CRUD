<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
    
    
    $connect = mysqli_connect("localhost", "", "", "");
    $messsage = '';
    if(isset($_POST["submit"]))
    {
        if(!empty($_POST["product_serial_number"]))
        {
            $sql = "
            INSERT INTO product_serial_number (product_serial_number)
            SELECT '".$_POST["product_serial_number"]."' FROM online_product_registration
            WHERE NOT EXIST(
                            SELECT online_product_registration FROM online_product_registration WHERE product_serial_number = '".$_POST["product_serial_number"]."'
                            ) LIMIT 1
            ";
            if(mysqli_query($connect, $sql))
            {
                $insert_id = mysqli_insert_id($connect);
                if($insert_id != '')
                {
                    header("location:add.php?inserted=1");
                }
                else
                {
                    header("location:add.php?already=1");
                }
            }
        }
        else
        {
            header("location:add.php?required=1");
        }
    }
    if(isset($_GET["inserted"]))
    {
        $message = "Brand inserted";
    }
    if(isset($_GET["already"]))
    {
        $message = "Brand Already inserted";
    }
    if(isset($_GET["required"]))
    {
        $message = "Brand Name Required";
    }
    
    
    
if(!empty($_POST["submit"])) {
    
    $url_id = mysql_real_escape_string($_POST["product_serial_number"]);
    $sql = "SELECT product_serial_number FROM online_product_registration WHERE product_serial_number='$url_id'";
    $exist_result = mysql_query($sql);
    
    $count = $db_handle->executeQuery($sql);
    
    echo $count;
    
    if(mysql_num_rows($exist_result) >0){
        $message="Problem in Adding to database. Please Retry.";
    }else{
        
        $query = "INSERT INTO online_product_registration(product_name, product_serial_number, invoice_number, purchase_date, dealer_reseller,contact_name,email,phone_number,organisation_name) VALUES('".$_POST["product_name"]."','".$_POST["product_serial_number"]."','".$_POST["invoice_number"]."','".$_POST["purchase_date"]."','".$_POST["	dealer_reseller"]."','".$_POST["contact_name"]."','".$_POST["email"]."','".$_POST["phone_number"]."','".$_POST["organisation_name"]."')";
		echo $query;
		$result = $db_handle->executeQuery($query);
        if(!$result){
            $message="Problem in Adding to database. Please Retry.";
        } else {
            header("Location:index.php");
        }
        
    }
    
    
    
//    $query = "INSERT INTO toy(name, code, category, price, stock_count) VALUES('".$_POST["name"]."','".$_POST["code"]."','".$_POST["category"]."','".$_POST["price"]."','".$_POST["stock_count"]."')";
//        $result = $db_handle->executeQuery($query);
//    if(!$result){
//            $message="Problem in Adding to database. Please Retry.";
//    } else {
//        header("Location:index.php");
//    }
}
 
?>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function validate() {
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".info").html('');
	
	if(!$("#product_name").val()) {
		$("#product_name-info").html("(required)");
		$("#product_name").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#product_serial_number").val()) {
		$("#product_serial_number-info").html("(required)");
		$("#product_serial_number").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#invoice_number").val()) {
		$("#invoice_number-info").html("(required)");
		$("#invoice_number").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#purchase_date").val()) {
		$("#purchase_date-info").html("(required)");
		$("#purchase_date").css('background-color','#FFFFDF');
		valid = false;
	}	
	if(!$("#dealer_reseller").val()) {
		$("#dealer_reseller-info").html("(required)");
		$("#dealer_reseller").css('background-color','#FFFFDF');
		valid = false;
	}	
	if(!$("#contact_name").val()) {
		$("#contact_name-info").html("(required)");
		$("#contact_name").css('background-color','#FFFFDF');
		valid = false;
	}	

	if(!$("#email").val()) {
		$("#email-info").html("(required)");
		$("#email").css('background-color','#FFFFDF');
		valid = false;
	}	

	if(!$("#phone_number").val()) {
		$("#phone_number-info").html("(required)");
		$("#phone_number").css('background-color','#FFFFDF');
		valid = false;
	}	
	if(!$("#organisation_name").val()) {
		$("#organisation_name-info").html("(required)");
		$("#organisation_name").css('background-color','#FFFFDF');
		valid = false;
	}
	return valid;
}
</script>
<form name="frmToy" method="post" action="" id="frmToy" onClick="return validate();">
<div id="mail-status"></div>
<div>
<label style="padding-top:20px;">product_name</label>
<span id="product_name-info" class="info"></span><br/>
<input type="text" name="product_name" id="product_name" class="demoInputBox">
</div>
<div>
<label>product_serial_number</label>
<span id="product_serial_number-info" class="info"></span><br/>
<input type="text" name="product_serial_number" id="product_serial_number" class="demoInputBox">
</div>
<div>
<label>invoice_number</label> 
<span id="invoice_number-info" class="info"></span><br/>
<input type="text" name="invoice_number" id="invoice_number" class="demoInputBox">
</div>
<div>
<label>purchase_date</label> 
<span id="purchase_date-info" class="info"></span><br/>
<input type="text" name="purchase_date" id="purchase_date" class="demoInputBox">
</div>
<div>
<label>dealer_reseller</label> 
<span id="dealer_reseller-info" class="info"></span><br/>
<input type="text" name="dealer_reseller" id="dealer_reseller" class="demoInputBox">
</div>


<div>
<label>contact_name</label> 
<span id="contact_name-info" class="info"></span><br/>
<input type="text" name="contact_name" id="contact_name" class="demoInputBox">
</div>


<div>
<label>email</label> 
<span id="email-info" class="info"></span><br/>
<input type="text" name="email" id="email" class="demoInputBox">
</div>


<div>
<label>phone_number</label> 
<span id="phone_number-info" class="info"></span><br/>
<input type="text" name="phone_number" id="phone_number" class="demoInputBox">
</div>


<div>
<label>organisation_name</label> 
<span id="organisation_name-info" class="info"></span><br/>
<input type="text" name="organisation_name" id="organisation_name" class="demoInputBox">
</div>

<div>
<input type="submit" name="submit" id="btnAddAction" value="Add" />
</div>
</div>








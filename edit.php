<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {

	$rawdate = htmlentities($_POST['purchase_date']);
	$date = date('Y-m-d', strtotime($rawdate));


    $query = "UPDATE online_product_registration set product_name = '".$_POST["product_name"]."', product_serial_number = '".$_POST["product_serial_number"]."', invoice_number = '".$_POST["invoice_number"]."', purchase_date = '".$date."', dealer_reseller = '".$_POST["dealer_reseller"]."', contact_name = '".$_POST["contact_name"]."', email = '".$_POST["email"]."', phone_number = '".$_POST["phone_number"]."', organisation_name = '".$_POST["organisation_name"]."' WHERE  id=".$_GET["id"];
    $result = $db_handle->executeQuery($query);
	if(!$result){
		$message = "Problem in Editing! Please Retry!";
	} else {
		header("Location:index.php");
	}
}
$result = $db_handle->runQuery("SELECT * FROM online_product_registration WHERE id='" . $_GET["id"] . "'");
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
<input type="text" name="product_name" id="product_name" class="demoInputBox" value="<?php echo $result[0]["product_name"]; ?>">
</div>
<div>
<label>Product Serial Number</label>
<span id="product_serial_number-info" class="info"></span><br/>
<input type="text" name="product_serial_number" id="product_serial_number" class="demoInputBox" value="<?php echo $result[0]["product_serial_number"]; ?>">
</div>
<div>
<label>Invoice Number</label> 
<span id="invoice_number-info" class="info"></span><br/>
<input type="text" name="invoice_number" id="invoice_number" class="demoInputBox" value="<?php echo $result[0]["invoice_number"]; ?>">
</div>
<div>
<label>Purchase Date</label> 
<span id="purchase_date-info" class="info"></span><br/>
<input type="text" name="purchase_date" id="purchase_date" class="demoInputBox" value="<?php echo $result[0]["purchase_date"]; ?>">
</div>
<div>
<label>Dealer/Reseller</label> 
<span id="dealer_reseller-info" class="info"></span><br/>
<input type="text" name="dealer_reseller" id="dealer_reseller" class="demoInputBox" value="<?php echo $result[0]["dealer_reseller"]; ?>">
</div>

<div>
<label>Stock Count</label> 
<span id="dealer_reseller-info" class="info"></span><br/>
<input type="text" name="dealer_reseller" id="dealer_reseller" class="demoInputBox" value="<?php echo $result[0]["dealer_reseller"]; ?>">
</div>

<div>
<label>contact_name</label> 
<span id="contact_name-info" class="info"></span><br/>
<input type="text" name="contact_name" id="contact_name" class="demoInputBox" value="<?php echo $result[0]["contact_name"]; ?>">
</div>

<div>
<label>email</label> 
<span id="email-info" class="info"></span><br/>
<input type="text" name="email" id="email" class="demoInputBox" value="<?php echo $result[0]["email"]; ?>">
</div>

<div>
<label>phone_number</label> 
<span id="phone_number-info" class="info"></span><br/>
<input type="text" name="phone_number" id="phone_number" class="demoInputBox" value="<?php echo $result[0]["phone_number"]; ?>">
</div>

<div>
<label>organisation_name</label> 
<span id="organisation_name-info" class="info"></span><br/>
<input type="text" name="organisation_name" id="organisation_name" class="demoInputBox" value="<?php echo $result[0]["organisation_name"]; ?>">
</div>



<div>
<input type="submit" name="submit" id="btnAddAction" value="Save" />
</div>
</div>
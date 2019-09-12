<?php
	require_once("perpage.php");	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	$product_name = "";
	$product_serial_number = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"])) {
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("product_name","product_serial_number");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "product_name":
						$product_name = $v;
						$queryCondition .= "product_name LIKE '" . $v . "%'";
						break;
					case "product_serial_number":
						$product_serial_number = $v;
						$queryCondition .= "product_serial_number LIKE '" . $v . "%'";
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY id desc"; 
	$sql = "SELECT * FROM online_product_registration " . $queryCondition;
	$href = 'index.php';					
		
	$perPage = 2; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
	$result = $db_handle->runQuery($query);
	
	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage, $href);
	}
?>
<html>
	<head>
	<title>Online Product Registration</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<h2>Online Product Registration</h2>
		<div style="text-align:right;margin:20px 0px 10px;">
		<a id="btnAddAction" href="add.php">Add New</a>
		</div>
    <div id="toys-grid">      
			<form name="frmSearch" method="post" action="index.php">
			<div class="search-box">
			<p><input type="text" placeholder="Name" name="search[product_name]" class="demoInputBox" value="<?php echo $product_name; ?>"	/>
					<input type="text" placeholder="Code" name="search[product_serial_number]" class="demoInputBox" value="<?php echo $product_serial_number; ?>"	/>
					<input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='index.php'"></p>
			</div>
			
			<table cellpadding="10" cellspacing="1">
        <thead>
					<tr>
          <th><strong>Product Name</strong></th>
          <th><strong>Product Serial Number</strong></th>          
          <th><strong>Invoice Number</strong></th>
					<th><strong>Purchase Date</strong></th>
					<th><strong>Dealer Reseller</strong></th>
					<th><strong>Contact Name</strong></th>
					<th><strong>Email</strong></th>
					<th><strong>Phone Number</strong></th>
					<th><strong>Organisation Name</strong></th>
					<th><strong>Registrated Date</strong></th>
					<th><strong>Action</strong></th>
					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($result)) {
						foreach($result as $k=>$v) {
						  if(is_numeric($k)) {
					?>
          <tr>
					<td><?php echo $result[$k]["product_name"]; ?></td>
          <td><?php echo $result[$k]["product_serial_number"]; ?></td>
					<td><?php echo $result[$k]["invoice_number"]; ?></td>
					<td><?php echo $result[$k]["purchase_date"]; ?></td>
					<td><?php echo $result[$k]["dealer_reseller"]; ?></td>
					<td><?php echo $result[$k]["contact_name"]; ?></td> 
					<td><?php echo $result[$k]["email"]; ?></td> 
					<td><?php echo $result[$k]["phone_number"]; ?></td> 
					<td><?php echo $result[$k]["organisation_name"]; ?></td> 
					<td><?php echo $result[$k]["registrated_date"]; ?></td> 
					<td>
					<a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["id"]; ?>">Edit</a> <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["id"]; ?>">Delete</a>
					</td>
					</tr>
					<?php
						  }
					   }
                    }
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table>
			</form>	
		</div>
	</body>
</html>
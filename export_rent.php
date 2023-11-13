<?php
	session_start();
    $email = $_SESSION['email1'];
    if(!$_SESSION['email1']){
        header('Location: indexlog.html');
    }
	include_once("db.php");
	$sql = "SELECT * FROM building_details WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        if($row['email']==$email){
            $b_name = $row['building_name'];
        }
    }
    $abc = strval($email);
    $mail = str_replace( array("@", "."), '', $abc);
    $tenantrec = $mail."_".$b_name."_rent";
    $tenantrec = strtolower($tenantrec);
	$sql_query = "SELECT * FROM $tenantrec LIMIT 50";
	$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
	$developer_records = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$developer_records[] = $rows;
	}	
	if(isset($_POST["export_data"])) {	
		$filename = "rent_record_".date('Ymd') . ".xls";			
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");	
		$show_coloumn = false;
		if(!empty($developer_records)) {
		  foreach($developer_records as $record) {
			if(!$show_coloumn) {
			  echo implode("\t", array_keys($record)) . "\n";
			  $show_coloumn = true;
			}
			echo implode("\t", array_values($record)) . "\n";
		  }
		}
		exit;  
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="top.css">
		<style>
			th, td {
  				text-align: center;
  				padding: 8px;
			}
			table {
    			max-height: 300px;
    			display: inline-block;
				width: 100%;
    			overflow: auto;
				border-collapse: collapse;
				border: 1px solid #002a529c;
			}
			body{
        		background-color: #1f48af2f;
    		}
			#export_data{
				cursor: pointer;
        		border: 2px solid grey;
        		width: 10%;
        		height: 8%;
        		background: transparent;
        		font-size: 1em;
        		font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        		 position: absolute;
        		left: 15cm;
    		}
			.center{
				width: 50%;
				margin: auto;
			}
			table {
			  	font-family: Arial, Helvetica, sans-serif;
			  	border-collapse: collapse;
			}
			table tr:hover {
				background-color: #002a520c;
				border-radius: 50%;
			}
			table th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #002a522c;
			  color: #002a52f6;
			}
			tr, td{
				border: 1px solid #002a520c;
			}
		</style>
	</head>
<body>
<br><br><br>
    <div class="o_name">
	Export  Rent Data to Excel
    </div><br><br>
<div class="container">		
	<div class="center">
	<table>
		<tr id="table-headings">
			<th>Room</th>
			<th>Tenant</th>
			<th>Rent start</th>
			<th>Rent end</th>
			<th>Rent</th>			
			<th>Bill</th>
			<th>Total</th> 	
			<th>Paid amount</th>
			<th>Balance amount</th>
		</tr>
		<tbody>
			<?php foreach($developer_records as $developer) { ?>
			   <tr>
			   <td><?php echo $developer ['rname']; ?></td>
			   <td><?php echo $developer ['tname']; ?></td>
			   <td><?php echo date("d-m-Y", strtotime($developer ['from_date'])); ?></td>  
			   <td><?php echo date("d-m-Y", strtotime($developer ['to_date'])); ?></td> 
			   <td><?php echo $developer ['rent']; ?></td>   		   
			   <td><?php echo $developer ['bills']; ?></td>
			   <td><?php echo $developer ['rent']+$developer ['bills']; ?></td>	
			   <td><?php echo $developer ['paid']; ?></td>  
			   <td><?php echo $developer ['balance']; ?></td> 
			   </tr>
			<?php } ?>
		</tbody>
    </table>
	<div class="btn-group pull-right">	
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
			</form>
		</div>	
	</div>
</div>
<form method="post" action="logout.php">
    <input type="submit" value="log out" name="SubmitButton" id="logout_btn">
</form>
<a href="owner_building.html"><button id="home_btn">Home</button></a>
<a href="tenantpage.html"><img src="images/back2.png" id="back_btn"></a>
</body>
</html>
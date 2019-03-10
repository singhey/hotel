<!DOCTYPE html>
<html>
<head>
	<title>hotel | User</title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/common.php"); ?>
	
	<link rel="stylesheet" type="text/css" href="/hotel/assets/css/tickets.css">
	<style type="text/css">
		.tbl-content{
			height:350px;
		}
		input, textarea, select{
			display: block;
			width:100%;
			padding:8px 16px;
			background:rgba(255, 255,255, .6);
			border:0;
			outline:0;
			transition: .2s linear;
			color:#444;
		}
		input:focus{
			box-shadow: 0px 0px 10px #ccc;
		}
	</style>
</head>
<body>
	<?php
		if(!isset($_SESSION['username']))header('Location: /hotel/account/login.php?error=2'); 
	?>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/nav.php"); ?>
	<div class="all-wrapper">
		<form action="./user-update.php" method="POST">
			<?php
				#establish connection
				require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/connection.php");
				function selectQuery($sql){
	                global $con;
	                $result = mysqli_query($con, $sql);
	                if(!$result){
	                    echo "Error "."sql query <b>".$sql."</b> ".mysqli_error($con);
	                }
	                if(mysqli_num_rows($result) == 0){
	                    echo "0 rows selected";
	                }
	                return $result;
	            }
			?>
			<section>
  <!--for demo wrap-->
			<h1>User details</h1>
			
				<h2 class="error" style="color:#444; font-weight:400;font-size:16px;text-align: center;">
					<?php
						$error = isset($_GET['code'])?$_GET['code']:9999;
						if($error == 1){
							echo "User name is taken";
						}else if($error == 2){
							echo "Error occured";
						} else if($error == 3){
							echo "Data update";
						}
					?>
				</h2>
			
			<div class="tbl-header">
    			<table cellpadding="0" cellspacing="0" border="0">
    				<thead>
        				<tr>
							<th>Row</th>
							<th>Data</th>
        				</tr>
					</thead>
				</table>
  			</div>
			<div class="tbl-content">
 		   		<table cellpadding="0" cellspacing="0" border="0">
    				<tbody>
    					<?php
                	#get column data types
                    $sql = "DESC  customer";
                    $rows = selectQuery($sql);
                    $identifierValue = $_SESSION['username'];
                    $_data = selectQuery("select * from customer where username = '$identifierValue'");
                    $data = $_data->fetch_assoc();
                    while($r = $rows->fetch_assoc()):
                ?>
                    <tr>
                        <?php
                            #col Name
                            $fieldName= $r['Field'];
                            #echo "<td>".$r['Type']."</td>";

                            $_data = preg_split("/\(|\)|,/", $r['Type']);
                            $dataType = $_data[0];
                            $maxLength = isset($_data[1])?$_data[1]: '';
                            $el = ($maxLength<80)?'input':'textarea';
                            $attr = '';
                            switch ($dataType) {
                                case 'varchar':
                                    $dataType = "text";
                                    break;
                                case 'time':
                                    $attr = "step='1'";
                                    break;

                                case 'int':
                                    $dataType = "number";
                                    break;

                                case 'float':
                                    $dataType = "number";
                                    $attr = "step='0.01'";
                                default:
                                    
                                    break;
                            }
                            $_tdattr = '';
                        	if($fieldName == 'password' || $fieldName == 'userId' || $fieldName == 'marked'){
                        		$_tdattr = "style='display:none;'";
                        	}
                            echo "<td $_tdattr>$fieldName</td>";
                        	if($fieldName == 'city'){
                        		$_city = selectQuery('select * from city');
                        		echo "<td><select name='city'>";
                        		while($city = $_city->fetch_assoc()){
                        			echo "<option value='".$city['cityId']."'>".$city['cityName']."</option>";
                        		}
                        		echo "<select></select></td>";
                        		continue;
                        	}
                            if($el=='input'){
                                $element = "<input type='$dataType' name='$fieldName' maxLength='$maxLength' class='input-field' $attr/ value='".$data["$fieldName"]."'>";
                            }else{
                                $element = "<textarea rows='5' name='$fieldName' maxLength='$maxLength'>".$data["$fieldName"]."</textarea>";
                            }
                            echo "<td $_tdattr>$element</td>";
                        ?>
                    </tr>
                    <?php
                        endwhile;
                    ?>
                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn"/></td>
                    </tr>
				</tbody>
    			</table>
			</div>
		</section>
		</form>
	</div>
</body>
</html>
<?php

function callback($buffer){
	// replace all the apples with oranges
	return (str_replace("apples", "oranges", $buffer));
}

ob_start("callback");

session_start();

include("connection.php");include ('lang/lang_engine.php');
if(!isset($_SESSION['lang'])) { 
	$lang = 'en';		//default language English} else {	$lang = $_SESSION['lang'];}	
if(isset($_REQUEST['lang'])) {
	$lang = $_REQUEST['lang'];
	$_SESSION['lang'] = $lang;}	

	
if(isset($_POST['update'])) {
	$newMessage		= $_POST['msgformat'];	if($lang == 'en')
		$query = "UPDATE APP_PARAMS SET P_VALUE='$newMessage' WHERE P_NAME='txtmsgen'" ;
	else		$query = "UPDATE APP_PARAMS SET P_VALUE='$newMessage' WHERE P_NAME='txtmsgfr'" ;	$result = mysql_query($query)or die("Text message format DB update failed.");
	header('Location:index.php');
}
/*
 * If a new mer is inserted, then check if there is already a customer with the same
 * cell phone number. If not, insert the customer in the queue else show an error.
 */
$currentDate= date("Y/m/d");

if(isset($_POST['submit'])) {
	$guestName		= 	$_POST['txtName'];
	$cell			= 	$_POST['txtCell'];
	$tableFor 		= 	$_POST['txtTableFor'];
	$telco			=	strtolower($_POST['txtPhone']);
	$telco_code		=   0; //initializing
	$priorReservn 	= 	'false' ;
	if ($_POST['cboxPrior'] == 'true')
		$priorReservn	= 'true' ;

/*
 * Get all the telco providers from the database
 */		
	$query = "SELECT TELCO_ID, TEL_NAME, MAIL_SUFFIX FROM TELCOS ORDER BY TELCO_ID" ;
	$telco_result = mysql_query($query)or die("Error: application is unable to fetch telecom provider information. Contact your admin.");
	
	while($row = mysql_fetch_array($telco_result)) {
		if (strtolower($row[1]) == $telco) {
			$smsto = $cell.$row[2] ;
			$telco_code = $row[0] ;
		}
	}
		

	// QUERY THE TABLE
	$query1 = "SELECT RES_ID FROM RESERVATIONS WHERE ENTEREDDATE='$currentDate' AND WAITSTATUS <> 2"; //Today's unserved guests
	$result1 = mysql_query($query1) or die("query failed one");
	$num = mysql_num_rows($result1);

//	if($num<30)	{	
		$currentDateTime = time();		$currentTime 		=  $currentDateTime;		$enteredDate		=	date("Y/m/d");
		if ($guestName == "" && $cell == "")	{
				echo "<br><font size='4' color='red'>" . Translator::translate('val_nameno',$lang). "</font>";
		} else {
			if ($guestName == "" || $cell == ""){
				echo "<br><font size='4' color='red'>" . Translator::translate('val_nameno',$lang). "</font>";
			} else {
				$query9 = "SELECT RES_ID FROM RESERVATIONS WHERE GUEST='$guestName' AND CELL='$cell' AND ENTEREDDATE='$currentDate' AND WAITSTATUS <> 2";
				$result9 = mysql_query($query9) or die("query failed nine");
				$num1 = mysql_num_rows($result9);
				if($num1==0){	
					$query = "INSERT INTO RESERVATIONS VALUES('','$guestName', $cell, $tableFor, '$telco_code','$currentTime',0,'$enteredDate','$smsto',$priorReservn)";
					$result = mysql_query($query) or die("query failed");
				} else {
					//echo "<br>" ;
				}
			} // end else - if
		}}
$reservation=array("hiddenID" => "","name" => "","cell" => "","tableFor" => "","priorReservn"=>"");	


/*
 * The format of the text message sent the the guest is configuration. It is stored in APP_PARAMS table.
 */
$query1 = "SELECT P_VALUE, P_NAME FROM APP_PARAMS WHERE P_NAME='txtmsgen' OR P_NAME='txtmsgfr'";
$result = mysql_query($query1) or die("query failed one");
while($row = mysql_fetch_array($result)) {	if ($row[1] == 'txtmsgen')
		$smsMessage_en = $row[0];	else if ($row[1] == 'txtmsgfr')		$smsMessage_fr = $row[0];	else {		$smsMessage_en = '';		$smsMessage_fr = '';	}
}if ($lang == 'en')	$smsMessage = 	$smsMessage_en;else if ($lang == 'fr')	$smsMessage = 	$smsMessage_fr;
/*
 * If the user clicks on one of the customer entries then this part of the program executes.
 * Every entry is clicked 2 times - 
 * (0) customer is waiting 
 * (1) a text message has been sent to the customer
 * (2) the customer has come and entry is hidden
 * 
 */
if($_GET['name'] == "sms") {
	$id = $_GET['id'];	
	$query6 = "SELECT GUEST, WAITSTATUS, SMSTO FROM RESERVATIONS WHERE RES_ID=$id";	
	$result6 = mysql_query($query6) or die("query failed six");
	
	while($row6 = mysql_fetch_array($result6)) {	
		$guestName	=	$row6[0];
		$status		=	$row6[1];
		$smsto		=	$row6[2];
	}
	if ($status == 0) {
		$status++ ;
		$query5 = "UPDATE RESERVATIONS SET WAITSTATUS=$status WHERE RES_ID=$id";
		$result5 = mysql_query($query5) or die("query failed five"); 
	}

	$smsto = str_replace(")", "", $smsto);
	$smsto = str_replace("-", "", $smsto);
	$smsto = str_replace(" ", "", $smsto);
//	$smsto = eregi_replace("^[a-zA-Z]$", "", $smsto);
	$message = Translator::translate('txt_title',$lang) . ' ' . $guestName . ', ' . $smsMessage;
	mail($smsto, $subject, $message, "- Elecmicrotech.com") or die("Unable to send your message. Please try again later.");	mail('hana.shinnin@gmail.com', $subject, $message, "- Elecmicrotech.com") or die("Unable to send your message. Please try again later.");/*	echo 'reservation id ' . $id . '<br>' ;	echo 'Sent to ' . $smsto . '<br>' ;	echo 'Subject ' . $subject . '<br>' ;	echo 'Message ' . $message . '<br>' ;	exit();
*/	
//	echo 'value of smsto - ' . $smsto . '<br/>';
	header('Location:index.php');
} else if ($_GET['name'] == "delete") {
		
	$lang=$_SESSION['lang'];

	$id = $_GET['id'];	
	$status = 2 ;
	$query5 = "UPDATE RESERVATIONS SET WAITSTATUS=$status WHERE RES_ID=$id";
	$result5 = mysql_query($query5) or die("query failed five"); 
//	header('Location:index.php');
}


if($_GET['name']=='deleteAll')
{
	$query2 = "UPDATE RESERVATIONS SET WAITSTATUS=3 WHERE WAITSTATUS<2" ;
	$result2 = mysql_query($query2)or die("Text message format DB update failed.");
	header('Location:index.php');	
	
}

?>

<html>

<?php 
	header('Refresh:60');
	ob_end_flush() ;
?>

<head><script type="text/javascript">	var err_valid_name 		= '<?php echo Translator::translate('err_name', $lang)?>' ;	var err_valid_number	= '<?php echo Translator::translate('err_number', $lang)?>' ;	err_max_number			= '<?php echo Translator::translate('err_max_number', $lang)?>';	var err_valid_cellno	= '<?php echo Translator::translate('err_cellno', $lang)?>' ;	var err_valid_cell_len	= '<?php echo Translator::translate('err_cell_len', $lang)?>' ;	err_select_provider		= '<?php echo Translator::translate('err_sel_prov', $lang)?>';</script>
	<script type="text/javascript" src="js/index.js"></script>
	<title>Reservation Calling System</title>
	<link href="css/reset.css" rel="stylesheet" type="text/css"/>
	<link href="css/layout.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class='outermost'>

<!-- Header Panel Start -->
<div class="header">
<table style='height:120px;background:url(images/120_table_bg.png) no repeat;'>
  <tr>	
		<td style='text-align:center'>
			<img src="./images/elecmicrotech.jpg"></img>		
		</td>
  </tr>
</table>
</div>	
<!-- Header Panel End -->


<!-- Middle Panel Start -->
<div class="main_menu">
<table>	<tr>		<td style='float:left;font-size:12px;'><a href="index.php?lang=en">English</a> | <a href="index.php?lang=fr">French</a>		</td>		<td><font style='color:black;font-size:24px;'><?php echo Translator::translate('men_main',$lang);?></font>		</td>		<td>		</td>	</tr></table>
		
<!--   <div style="overflow: scroll; height:210px">   
<div style="width:800px;height:220px;overflow-x:auto;overflow-y:auto;overflow;background-color:#000000">  -->	


<div style="border:1px solid #005C88;width:800px;height:238px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">
<table style='height:237px;width:790px;'>
	<tr> 
<?php for ($i=0;$i<2;$i++){ ?>
  
		<th><?php echo Translator::translate('col_serial',$lang)?><hr></th> 
		<th><?php echo Translator::translate('col_cname',$lang)?><hr></th> 
		<th><?php echo Translator::translate('col_party',$lang)?><hr></th>  
		<th><?php echo Translator::translate('col_wtime1',$lang)?><hr></th> 
		<th><?php echo Translator::translate('col_resvd',$lang)?><hr></th>
		<th style='border-right:1px solid #005C88'><?php echo Translator::translate('col_action',$lang)?><hr></th>      
<?php }?>
 	</tr>
<?php 
$n=1;

$query1		= "SELECT RES_ID, GUEST, ENTEREDTIME, TABLEFOR, ENTEREDDATE, WAITSTATUS, PRIOR_RESRV FROM RESERVATIONS WHERE  WAITSTATUS < 2 ORDER BY RES_ID ASC";
$result1	= mysql_query($query1) or die("query failed one");
$num		= mysql_num_rows($result1);

for($i=1;$i<=$num;$i++){
		$row = mysql_fetch_array($result1);		

		$id = $row[0];
		//$guestName = $row[1] ;
		$enteredTime = $row[2];
		//$tableFor = $row[3];	
		$enteredDate = $row[4];
		$status = $row[5];
		if ($row[6] == true)
			$isReserved = 'checked';
		else
			$isReserved = '';
		
		
		
//GETTING THE WAITING TIME
		$currentTime = time();
		$finalTime=$currentTime-$enteredTime;		
		$finalTime=(int)($finalTime/60);		
		$k=$i%2;	
		if ($k == 1) {?>
		<tr><?php 
		}
		
		if(($finalTime>30) || ($status==1))
			$color = 'red' ;
		else 
			$color = 'black';

?>			
		<td align="center"> <font color="<?php echo $color;?>"> <?php echo  $i; ?> </font>  </td>
		<td style='width:100px;'><font color="<?php echo $color;?>">   <?php echo $row[1]; ?> </font>	</td>
		<td align="center"><font color="<?php echo $color;?>"> <?php echo $row[3]; ?> </font> 		</td>
		<td align="center"><font color="<?php echo $color;?>">  <?php echo $finalTime; ?> </font>  </td>		
		<td align="center"> <input type="checkbox" name="reservation" <?php echo $isReserved;?>>  </td>
		<td style='border-right:1px solid #005C88'>

			<a href="index.php?name=sms&id=<?php echo $row[0]; ?>" onclick="return confirm('<?php echo Translator::translate('alrt_msg_pre',$lang). ' ' . $row[1] . " " . Translator::translate('alrt_msg_suf',$lang)?>...')" >SMS</a>    
			| <a href="index.php?name=delete&id=<?php echo $row[0]; ?>" onclick="return confirm('<?php echo Translator::translate('alrt_del',$lang). ' ' . $row[1]; ?> ...')" ><?php echo Translator::translate('lnk_delete', $lang);?></a>

		</td>			
<?php 			
		if ($k == 0) {
			echo '</tr>' ;
		}
}//for()
		
//Fill rest of the space with empty rows.	
	for($i=$num+1;$i<=16;$i++) {
		if ($i%2 == 1) { // left column
			echo '<tr>' ;
		}
		echo "<td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td style='border-right:1px solid #005C88'> &nbsp; </td>"; 
		if ($i%2 == 0) { // right column
			echo '</tr>' ;
		}
	}	
?>
</table>
</div>
<div style='width:800px;border:1px;font-size:12px;text-align:left'>
	  <a href="index.php?name=deleteAll"
	  	onmouseover="this.style.color='red', this.style.fontWeight=''" 
	  	onmouseout="this.style.color='blue',this.style.fontWeight='normal' "> Delete All </a> <hr>
</div>

<?php 

	$query1		= "SELECT RES_ID FROM RESERVATIONS WHERE  WAITSTATUS < 2 ORDER BY RES_ID ASC";
	$result1	= mysql_query($query1) or die("query failed one");
	$num		= mysql_num_rows($result1);

		
	if ($num>='30') {
		$view="disabled";
	} else  {
		$view="";
	}
?>

<div id="cform" style="display:block;margin:1px auto;border:1px ">
	<form action="index.php" method="POST" enctype="multipart/form-data" name="contactform" id="contactform" >
		<div class='admin_menu'> 
	

		<font style='color:black;font-size:24px;'><?php echo Translator::translate('men_admin',$lang)?></font>
		
		
			<table style='height:120px;border:1px solid #005C88'>
		        <tr>
		        	   
		        	<td><?php echo Translator::translate('lbl_name',$lang)?> : </td>
		        	<td>
		        		<input name="txtName" id="txtName" class="textfield" 
		        				value="<?php echo $reservation["name"]; ?>" <?php echo $view; ?>  
				          		onkeyup="validateName()" >
			        </td>
		          	<td style=""> <?php echo Translator::translate('lbl_party',$lang)?>:</td>
		        	<td>
			        	<input name="txtTableFor" id="txtTableFor"  class="textfield" 
			        			value="<?php echo $reservation["tableFor"]; ?>"  <?php echo $view; ?>
			          			onkeyup="validateTableFor()" >
		          	</td>
			       	<td style=""> <?php echo Translator::translate('col_resvd',$lang)?>:</td>
		        	<td>
			        	<input name="cboxPrior" id="cboxPrior"  type="checkbox" value="true"  <?php echo $view; ?> >
		          	</td>
	          </tr>
	          
	          <tr><td colspan='2'><span id="name_hidden">&nbsp;
 <?php 
		         if(isset($_POST['submit'])) 
		         	if ($num1>0) 
			         	echo "<font color='red'>  The customer is already in the queue </font>" ;
?>
		        	</span></td><td colspan='2'><span id="member_hidden">&nbsp;</span></td>
		        	<td colspan='2'><span id="reservation_hidden">&nbsp;</span></td>
		      </tr>
		        	
	          <tr>
	          		<td><?php echo Translator::translate('lbl_cell',$lang)?>. :</td>
		        	<td>
			         	 <input name="txtCell" id="txtCell" class="textfield" value="<?php echo $reservation["cell"]; ?>"  <?php echo $view; ?>
			          	onclick="changecolor('txtCell','')" onkeyup="validateCell()" >
		          	</td>
		  
		  
		  
		        <td colspan='4'><?php echo Translator::translate('lbl_telco',$lang)?>:
<?php 		
				$query = "SELECT TELCO_ID, TEL_NAME, MAIL_SUFFIX FROM TELCOS ORDER BY TELCO_ID" ;
				$telco_result = mysql_query($query)or die("Error: application is unable to fetch telecom provider information. Contact your admin.");

		        while ($row = mysql_fetch_array($telco_result)) {
?>		        	
		        	<span><input name="txtPhone" type='radio' id="txtPhone" value="<?php echo $row[1];?>" 	<?php echo $view; ?> >
		        	<?php echo $row[1];?> &nbsp;</span>
<?php		    }
?>					
				</td>
		        </tr>
		        
		        <tr> <td colspan='2' ><span id="cell_hidden">&nbsp;</span></td>
		        	<td colspan='4' ><span id="provider_hidden">&nbsp;</span></td></tr>
		        <tr> <td colspan='6' style='text-align: center;'>
		        
							<input class="submit" name="submit"  value="<?php echo Translator::translate('btn_submit',$lang)?>" onclick='return validateForm()' type="submit" ></input>
					    <input class="reset" value="<?php echo Translator::translate('btn_reset',$lang)?>" onclick="" type="reset" ></input> 
					  	</td>
		        </tr>
		</table>
	</div>
</form>
</div> <!-- cform div End -->



</div>  <!-- Middle Panel End -->
<div id='xzsy1' style='display:block;'>
<img src='images/twisty2.png' onclick="showhide('xzsy','xzsy1');">
</div>
<div id='xzsy' style='display:none'>
<img src='images/twisty.png' onclick="showhide('xzsy1','xzsy');">
<form action="index.php" method="POST" enctype="multipart/form-data" name="messageform" id="messageform" >
<?php echo Translator::translate('lbl_msgupd',$lang);?> : <input name='msgformat' id='msgformat' style='width:320px' value='<?php echo $smsMessage;?>'>
<input type='submit' value='<?php echo Translator::translate('btn_update',$lang)?>' name='update' onclick='return validateTextMessage();'>
</form>
</div>

<!-- Footer Panel Start -->
<div class="footer">
<?php 
	mysql_close();
?>
	(c) 2012 Electronique Microtech Canada Inc.
</div>
</div>

</body>
</html>


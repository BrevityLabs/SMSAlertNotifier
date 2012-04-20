
<?php 
include("connection.php");
if(isset($_POST['submit']))
{	
	$name = $_POST['txtName'];
	$cell = $_POST['txtCell'];	
	
	if(isset($_POST['txtPhone']))
	{		
		$serviceProvider=$_POST['txtPhone'];			

	
// INSERT INTO TABLE
		
	$query1 = "select * from customerDetails";
	$result1 = mysql_query($query1) or die("query failed one");
	$num = mysql_num_rows($result1);
	
	if($num<15)
	{	
		$period = 30;
		$query2 = "select max(waitTime) from customerDetails";
		$result2 = mysql_query($query2) or die("query failed");	
		$row2 = mysql_fetch_array($result2);	
		$waitTime = $row2[0]+$period;	
		
		if ($name == "" && $cell == "")
		{		?>
		<br>	
		<font size="4" color="red"> Enter valid name ane cell No </font>
		<?php			
			
		}
		
		else if ($name == "" || $cell == "")
		{  ?>
			<br>
			<font size="4" color="red"> Enter valid name ane cell No </font>
			<?php				
		}
		else 
		{
			$query9 = "select * from customerDetails where name='$name' and cell=$cell";
			
			$result9 = mysql_query($query9) or die("query failed nine");
			$num = mysql_num_rows($result9);
			if($num=='0')
			{			
				$query = "insert into customerDetails values('','$name',$cell,'$serviceProvider',$waitTime)";
				$result = mysql_query($query) or die("query failed");
			}
			else 
			{  ?>
			<br>
			<font size="4" color="red"> You are already in the queue </font>
			<?php				
				
			}
		}
	}
	else 
	{
		?>
		<br>	
		<font size="4" color="red"> Already 15 people are there in queue </font>
		<?php
	}

	}// if(isset(check))
		else 
		{
			?>
			<br>
			<font size="4" color="red"> Select any service provider ! </font>
			<?php
			
		}
			
			
	$reservation=array("hiddenID" => "","name" => "","cell" => "");	
}
else 
{
	
	$reservation=array("hiddenID" => "","name" => "","cell" => "");
}

//DELETE A CUSTOMER

if($_GET['name'] == "delete")
	
{
	$id = $_GET['id'];	
	
//GETTING CELL NO
	
	$query6 = "select * from customerDetails where id=$id";	
	$result6 = mysql_query($query6) or die("query failed six");
	
	while($row6 = mysql_fetch_array($result6))
	{	
		$cellNo=  $row6[2];
		$serviceProvider=$row6[3];	
	}		
	
	
//UPDATING WAIT TIME	

	$query10 = "select * from customerDetails where id=$id";	
	$result10 = mysql_query($query10) or die("query failed two");
	$num = mysql_num_rows($result10);
	
	if($num=='1')
	{
		$period = 30;
	
		$query4 = "select * from customerDetails where id>$id";	
		$result4 = mysql_query($query4) or die("query failed two");	
		while($row4 = mysql_fetch_array($result4))
		{		
			$waitTime=$row4[4];
			$newWaitTime=$waitTime-$period; 
			$query5 = "update customerDetails set waitTime=$newWaitTime where id=$row4[0]";
			$result5 = mysql_query($query5) or die("query failed two");
		}	

	}//if()
	
//DELETING DATA	
	
	$query3 = "delete from customerDetails where id=$id";
	$result3 = mysql_query($query3) or die("query failed two");
	
/***????????????????????SENDING MESSAGE??????????????????????????????????****/
			
	$ch = curl_init();
	$user="mohanagnes@gmail.com:smsapp";
	$receipientno=$cellNo;
	
	$senderID="TEST SMS";
	$msgtxt=" present your self at the main desk";
	curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
	$buffer = curl_exec($ch);
	if(empty ($buffer))
	{
		// echo " buffer is empty ";
	}
	else
	{
		//echo $buffer;
	}
	curl_close($ch);
/****?????????????????????????????????????????????????????????????????????***/

}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<?php 

/*
$query7 = "select * from customerDetails";
$result7 = mysql_query($query7) or die("query failed seven");
while($row7 = mysql_fetch_array($result7))
{
	$t=$row7[4];
	$time = $t-1;
	$query8 = "update customerDetails set waitTime=$time where id=$row7[0]";
	$result8 = mysql_query($query8) or die("query failed eight");

}
header('Refresh: 60');
*/


?>
<head>


 <script type="text/javascript" src="/reservation/js/index.js"></script>

  <title>Customer Comment Center&#153</title>
	  
	
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class='outermost'>

<!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	
<!-- 	<td><div class='logo'>&nbsp;</div></td>   -->
	
	<td><div class="title" style="text-align: center">
	
	
	<?php 
	
	if ($_GET['name']=='view')  {
	
		$viewID = $_GET['id'];		

		
		
		$query11 = "select * from admin where id=$viewID";
		$result3 = mysql_query($query11) or die("query failed two");
		$row3=mysql_fetch_array($result3);
		
		
		$title = $row3[1];
		$ext = $row3[2];
		$imgName = $viewID . $ext;
		
	
	}  
	
	
	?>
	
	
	
	
	
	<br><br>
		
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
				
	<img width="80px" src="./logo/<?php echo $imgName;?>"></img>		
			
	
	
	<font size="6"><?php echo $title;?>  </font>
				
	
	
	<td><div class="advert"> <i></i> </div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->
<!-- div class="banner">
	<i>< ?php echo Translator::translate('all_banner',$lang);? ></i>
</div-->

<!-- Middle Panel Start -->
<div class="middle" style="text-align:center">

&nbsp;
<h1 style="color:black">Main Menu</h1>

<table><tr><th>SI No:</th> <th>Customer Name</th><th>Wait Time</th> <th>SI No:</th> <th>Customer Name</th><th>Wait Time</th>
<tr><td colspan=3><hr/></td><td colspan=3><hr/></td></tr>

<?php 
$n=1;

$query1 = "select * from customerDetails order by id asc";
$result1 = mysql_query($query1) or die("query failed one");
$num = mysql_num_rows($result1);

for($i=1;$i<=$num;$i++)
	{
		$row = mysql_fetch_array($result1);
		$k=$i%2;	

		if ($k=='1')
		{
	?>			
			<tr>
			<td> <?php echo  $n; ?></td>
			
			<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?name=delete&id=<?php echo $row[0]; ?>" onclick="return confirm('Sending message......')" > <?php echo $row[1]; ?>  </a>
			</td>
			<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php"> <?php echo $row[4]; ?>  </a>
			</td>	
	
	<?php 	
		}//if()	
			
		else 
		{
	?>			
			<td> <?php echo  $n; ?></td>
			<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php?name=delete&id=<?php echo $row[0]; ?>" onclick="return confirm('Sending message......')" > <?php echo $row[1]; ?>  </a>
			</td>
			<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="index.php"> <?php echo $row[4]; ?>  </a>
			</td>	
			</tr>
	<?php 		
		  }//else	
		  	++$n;	
	}//for()
?>
</table>


<?php 

$query1 = "select * from customerDetails order by id asc";
$result1 = mysql_query($query1) or die("query failed one");
$num = mysql_num_rows($result1);
if ($num=='15')
{
	$view="disabled";
}
else 
{
	$view="";
}
?>

<ul class="footerContact">

<div id="cform" style="display:block;margin:10px 0 auto">
<form action="index.php" method="POST" enctype="multipart/form-data" name="index" id="contactform" >
	<input name="uniqueid" id="uniqueid" type="hidden" value="">

	<hr/ width=800px>
	
	<div class='menu'> 

<br>

<font size="5"> <b>Admin Menu  </b> </font>
    <table style="width:800px;border:1px ;margin:0 0 auto;">
      <tbody>
        <tr>
        	<td style="width:45px;border:1px ;padding:10px 0px 13px 10px;">Name :  </td>
        	<td style="border:1px ;"> 
				<input name="txtName" id="txtName" class="textfield" value="<?php echo $reservation["name"]; ?>" <?php echo $view; ?>  
          	onclick="changecolor('txtName','')" onkeyup="validateName()" ></input>
         
         <br>
         <span id="name_hidden"></span>
          	</td>
        <td style="border:1px ;padding:10px 0px 13px 10px;">Cell No. :</td>
          <td  style="border:1px ;"><input name="txtCell" id="txtCell" class="textfield" value="<?php echo $reservation["cell"]; ?>"  <?php echo $view; ?>
          	onclick="changecolor('txtCell','')" onkeyup="validateCell()" ></input>
          	
          	<br>
          	<span id="cell_hidden"></span>
          	
          	</td>
        <td style="border:1px ;padding:10px 0px 13px 10px;"> Provider: </td>
		<td style="border:1px ;">
		<br>
		<input name="txtPhone" type='radio' id="txtPhone"  value="Telus" <?php echo $view; ?> >Telus</input> &nbsp;
		<input name="txtPhone" type='radio' id="txtPhone" value="Bell" <?php echo $view; ?> >Bell</input> &nbsp;
		<input name="txtPhone" type='radio' id="txtPhone" value="Koodo" <?php echo $view; ?>>Koodo</input> &nbsp;
		<input name="txtPhone" type='radio' id="txtPhone" value="Nextel" <?php echo $view; ?> >Nextel</input> &nbsp;
		
			<input name="txtPhone" type='radio' id="txtPhone" value="Fido" <?php echo $view; ?> >Fido</input> &nbsp;
	
		
		</td>
        </tr>
      </tbody>
</table>


<br>

<div style="text-align:center;width:802px;margin:20px 30px auto;padding-bottom:4px;border:0px;">
	<input class="send" name="submit"  value="Submit" onclick='return validateForm()' type="submit" ></input>
    <input class="reset" value="Reset" onclick="" type="reset" ></input> 
</div>
</div>

</form>
</div> <!-- cform div End -->
<div style="width:802px;height:10px;margin:5px 50px auto;border:0px;font-size:18px;display:none" id="cformafter">
</div>
</ul>





</div>

<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class="footer">
</div>
<!-- Footer Panel End -->

<!-- Copyright Start 
<?php 
	include('inc_copyright.php');
	mysql_close();
	
	
?>
	 Copyright End -->

</div>
</body>
</html>

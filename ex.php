


<html xmlns="http://www.w3.org/1999/xhtml">


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Customer Comment Center&#153</title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
</head>



<body>

<div class='outermost'>
<div class='outermost'>

<!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	
<!-- 	<td><div class='logo'>&nbsp;</div></td>   -->
	
	<td><div class="title" style="text-align: center">
	
		<br><br>
		
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<img src="images/logo.jpg" width=100px height=45px><br/>		
				
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;
				
	<font size="6"> Hospital Management </font>
	
	
	 </div></td>
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
<br>
<h1 style="color:black">Availability of Beds</h1>

<br>

<table align="center" bgcolor="meroon" height="45%" width="45%">



<tr>
		<td colspan="2" align="center">
			<h2><font color="white"> <u>Patient Registration </font></h2>	
		</td>
	<tr>	
		
	<tr>
		<td align="right">
			<font color="white"><b>Name:</font>
		</td>
		<td>
		<input type="textbox" name="userName" value="<?php echo $userRegistration["userName"]; ?>" onkeyup="validateUserName()" onblur="checkAvailability()">		
		<!--</br> align="left"<input type="submit" name="avail" style="height: 30px; width: 150px" value="check availability"> -->	

		<?php
			if (isset($_POST['register']))
			{
				$f=0;
				$query="select * from login where role=0";
				$result=mysql_query($query) or  die ("query failed");
				while($row=mysql_fetch_array($result))		
				{

					//if($userName==$row[1])	
					if (strcasecmp($userName, $row[1]) == 0)					
					{
						$f=$f+1;
					}
					
				}
				if($f!=0)
				{
		?>
				<br><span id="userNameID" style=" background-color:red	; "><font color="white"><b>&nbsp;Username already exist </font></span>
		<?php
				}	

			}


			else
			{
		?>
				<br><span id="userNameID"><b></span>
		<?php

			}


		
/*****************************availability checking****************************************/

if (isset($_POST['avail']))
{
	$f=0;
	//$userName=$_POST["userName"]; 
	$userName = mysql_real_escape_string($_POST['userName']);
	$len=strlen($userName);

	if($len>=4)
	{
		$query="select * from login where role=0";
		$result=mysql_query($query) or  die ("query failed");
		while($row=mysql_fetch_array($result))		
		{
			if (strcasecmp($userName, $row[1]) == 0)					
			{
			$f=$f+1;
			}
		}

		if($f!=0)
		{?>
		    <br><span id="userNameID" style=" background-color:red;"><font color="white"><b>&nbsp;Not available </font></span>
		<?php 
		}
		else
		{ ?>
	     <br><span id="userNameID" style=" background-color:red;"><font color="white"><b>&nbsp;OK </font></span>
		<?php 

		}
	}
	else
	{?>
	     <br><span id="userNameID" style=" background-color:red;"><font color="white"><b>&nbsp;minimum 4 characters </font></span>
		<?php 
	}
}
/*************************************************************************************************************/

		?>
		</td>
	
	<tr>
	<tr>
		<td align="right">
			<font color="white"><b> Address:</font>
		</td>
		<td>
<textarea rows="3" cols="29"></textarea>
		<br><span id="passwordID"></span>
		</td>
	<tr>
	<tr>
		<td align="right">
			<font color="white"><b>Mobile:</font>
		</td>
		<td>
		<input type="text" name="conformPassword" value="" onkeyup="validateConformPassword()" onKeyPress="return submitenter(this,event)">
		<br><span id="conformPasswordID"></span>
		</td>
	<tr>
	
		<tr>
		<td align="right">
			<font color="white"><b> Avail Bed:</font>
		</td>
		<td>
		<select>
		<option>Bed 1</option>
		<option>Bed 2</option>
		<option>Bed 4</option>
		<option>Bed 7</option>
		<option>Bed 8</option>
		<option>Bed 10</option>
		
		
		</select>
		</td>
	<tr>
		
	<tr>
		<td>
		</td>
		<td align="right">
		<input id="enter" type="submit" name="register" value="Register" />		
		<input type="reset" name="reset" value="Reset" />
		</td>		
	<tr>
	
	
	
</table>





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
</div>

</body>
</html>

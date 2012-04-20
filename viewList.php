<?php

include("connection.php");
session_start();

if(isset($_POST['submit']))
{
	
	$title = $_POST['txtDisplayTitle'];
	$lang = $_POST['lang'];
	
	
	$filename = 'logo/';
	if (is_writable($filename)) {
		//echo 'The file is writable';
	} else {
		echo 'The file is not writable';
	}
	
	$logoFileName = $_FILES["file"]["name"];
	
// CHECKING IF TITLE IS BLANK OR NOT

	if ($title != "") {
		
		
	if ($logoFileName != NULL) {
	
		$ext = explode(".",$logoFileName);
		$ext = end($ext);
		$ext = "." . $ext;
	}
	
		$query4 = "select * from admin where title='$title' and logoext='$ext'and lang='$lang'";
		$result14 = mysql_query($query4) or die("query failed");
		$num = mysql_num_rows($result14);
		if ($num=='0')
		{	
	
		$query = "insert into admin values('','$title','$ext','$lang')";
		$result = mysql_query($query) or die("query failed one");
		
	
		$query1 = "select id from admin where title='$title' and logoext='$ext'and lang='$lang'";
		$result1 = mysql_query($query1) or die("query failed");
		
		$row = mysql_fetch_array($result1);
		$id =  $row[0];
	
	
		$_SESSION['id']=$id;	
	
		$imgName = $id . $ext;

		if ($_FILES["file"]["error"] > 0)
		{
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			//echo "upload: " . $_FILES["file"]["name"] . "<br />";
			//echo "Type: " . $_FILES["file"]["type"] . "<br />";
			//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	
		
				move_uploaded_file($_FILES["file"]["tmp_name"],
						"logo/" . $imgName);
				//echo "Stored in: " . "logo/" . $_FILES["file"]["name"];
			
		}		
		$viewList = array("viewListID" => "$id");		
		}//if($num)
		else 
		{
			?>
			<font size="5" color="red"> Already exists</font>
			<?php 
			
		}
		
	}
	else
	{
		?>
	<font size="5" color="red"> Enter valid Title  </font>
	<?php
	
	}
}

// EDIT
else if(isset($_POST['save']))  {
	
	$editID = $_POST['viewListID'];
	
	
	$title = $_POST['txtDisplayTitle'];
	
	
	
	
	$lang = $_POST['lang'];
	
	$_SESSION['id']=$editID;
	
	
	$filename = 'logo/';
	if (is_writable($filename)) {
		//echo 'The file is writable';
	} else {
		echo 'The file is not writable';
	}
	
	$logoFileName = $_FILES["file"]["name"];
	
	
	if ($logoFileName != NULL) {
	
		$ext = explode(".",$logoFileName);
		$ext = end($ext);
		$ext = "." . $ext;
	}
	
	if($logoFileName==NULL)
	{		
		$query = "update admin set title='$title',lang='$lang' where id=$editID";
		$result = mysql_query($query) or die("query failed two");		
	}
	
	else 
	{				
		$query = "update admin set title='$title',logoext='$ext',lang='$lang' where id=$editID";		
		$result = mysql_query($query) or die("query failed two");
	
	}
	
	
	$imgName = $editID . $ext;
	
	if ($_FILES["file"]["error"] > 0)
	{
		//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{
		//echo "upload: " . $_FILES["file"]["name"] . "<br />";
		//echo "Type: " . $_FILES["file"]["type"] . "<br />";
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
				
		move_uploaded_file($_FILES["file"]["tmp_name"],
		"logo/" . $imgName);
		//echo "Stored in: " . "logo/" . $_FILES["file"]["name"];
		
	}			
	$viewList = array("viewListID" => "$editID");	

}



/*****%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%********/

//  DELETE

	if ($_GET['name']=='delete')  {

	$deleteID = $_GET['id'];


	$query5 = "delete from admin where id=$deleteID";
	$result5 = mysql_query($query5) or die("query failed two");

}

/*****%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%********/



if ($_GET['name']=='edit')  {
		
	
	$editID = $_GET['id'];
	$query2 = "select * from admin where id=$editID";		
	
	$result2 = mysql_query($query2) or die("query failed three");
	$row2 = mysql_fetch_array($result2);
	
	$title = $row2[1];
	$ext = $row2[2];
	$lang = $row2[3];
	
	if ($lang=='English')  {
		
	
		$selected1 = "selected";
		$selected2 = "";
		
	}
	else  {
	
		$selected1 = "";
		$selected2 = "selected";
		
	}
	
	$imgName = $editID . $ext;
	
$viewList = array("viewListID" => "$editID");
	


	
	?>
	
<html>
<head>

  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
</head>
		
	<body>
	<div class='edit'>
	
<form action="viewList.php" method="post"enctype="multipart/form-data">
<input type="hidden" name="viewListID" value="<?php echo $viewList["viewListID"]; ?>">
	
	<table>
  <tr>
	
<!-- 	<td><div class='logo'>&nbsp;</div></td>   -->
	
	<td><div class="title" style="text-align: center">
	
	<br><br>
		
	
	<img src="images/logo.jpg" width=100px height=45px><br/>		
			
	<font size="6"> Company Name </font>
	
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
 
		
	
	<td><div class="advert"> <i></i> </div></td>
  <tr>
</table>
	


<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font size="6">  Admin Details  </font>
	
	
	
	<table align="center" bgcolor="#99FFCC" height="40%" width="100%">
	
	<tr>
	<td align="right">Display Title:	</td>
	<td align="left" style='border:0px;'>
	<input name="txtDisplayTitle" id="txtDisplayTitle" class="textfield" value="<?php echo $title;?> " ></input>
	
	
	</td>
	</tr>
	<tr>
	<td align="right" >Logo File Name:	</td>
	<td style='border:0px;'>
	<input type="file" name="file" id="file" value="<?php echo $imgName; ?>" />		
	</td>		
	</tr>
	
	<tr>
	<td colspan="2">
	&nbsp;&nbsp;&nbsp;&nbsp;
	<img width="100px" src="./logo/<?php echo $imgName;?>"></img>
	</td>
	</tr>
	
	
<!-- 	<tr>
	<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'> To Email:	</td>
	<td style='border:0px;'>
	<input name="txtToEmail" id="txtToEmail" class="textfield" value="<?php echo $toEmail;?>" ></input>
	</td>
	</tr>
	<tr>
	<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>CC Email</td>
	<td style='border:0px;'>
	<input name="txtCCEmail" id="txtCCEmail" class="textfield" value="<?php echo $ccEmail;?>" ></input>
	</td>
	</tr>   -->
	
	
	
	<tr>
	<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'> Site Language	</td>
	<td style='border:0px;'>
	<select name='lang' id='cboLanguage' class='combofield' style='width:300px;height:30px'>
	<option value="English" <?php echo $selected1; ?>>  English </option>
	<option value="French" <?php echo  $selected2; ?>>  French </option>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan='2' style='width:500px;border:0px;padding:10px 0px 13px 10px;text-align:center'>
	<input name="save" class="save" value="Save" type="submit" ></input>
	
<!--  	<input name="reset" class="reset" value="Reset" onclick="" type="reset" ></input>
	<input name="cancel" class="cancel" value="Cancel" onclick="history.go(-1);" type="submit" ></input>    -->
	</td>
	</tr>
	
	</table>
	</form>	
	
	<?php
	
}

else
{

?>


<br><br>

<?php 
//$sessionID=$_SESSION['id'];

$i=1;

?>


<form action="viewList.php" method="post"enctype="multipart/form-data">
<input type="hidden" name="viewListID" value="<?php echo $viewList["viewListID"]; ?>">



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<font size="6">  Admin Details  </font>



<table align="center" border="0" bgcolor="#99FFCC"  width="50%">


<tr bgcolor="#009900">
	<td align="center"> <font color="white"> SI No  </font></td>	
	<td align="center"><font color="white"> Logo </font> </td>	
	<td align="center"> <font color="white"> Display Title </font>  </td>	
	
	<td align="center"> <font color="white"> Lang </font> </td>
	<td align="center"> <font color="white"> Action </font> </td>		
</tr>




<?php 

$query3 = "select * from admin order by id ASC";
$result3 = mysql_query($query3) or die("query failed two");
while($row3=mysql_fetch_array($result3))  {
	
	$id = $row3[0];
	$title = $row3[1];
	$ext = $row3[2];
	$lang = $row3[3];
			
	$imgName = $id . $ext;

	
	if ($lang=='English')
	{
		$language="En";
	}
	else
	{
		$language="Fr";
	}
	

?>



<tr>
	<td align="center"> <?php echo $i; ?> </td>
	<td align="center"><img width='100px' src="./logo/<?php echo $imgName;?>"></img> </td>		
	<td align="center"><?php echo $title;?> </td>
	
	<td align="center"> <?php echo $language; ?> </td>
	<td align="center"> <a href="viewList.php?name=edit&id=<?php echo $id; ?> "><img width="20px" src="./images/edit.png"></img> </a>   
	 <a href="viewList.php?name=delete&id=<?php echo $id; ?> "><img width="20px" src="./images/delete.png"></img> </a> 
	 <a href="index.php?name=view&id=<?php echo $id; ?> "><img width="20px" src="./images/view.png"></img> </a>   </td>
	
</tr>



<?php 
$i=$i+1;
	}//while
	
	?>
	
	
</table>
	
	<?php 

}//else
?>

</form>

</div>

</body>

</html>














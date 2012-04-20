
<html>
<head>

<script type="text/javascript" src="/reservation/js/admin.js"></script>    

  <title>Customer Comment Center&#153</title>
	
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<br><br><br><br>
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
	<font size="6"> Company Name </font>
				
	
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
<h1 style="color:black">Admin</h1>

<form name="admin" action="viewList.php" method="post"enctype="multipart/form-data">

<table>
 
     <tr>
     <td align="right">Display Title:	</td>
          	<td align="left" style='border:0px;'>          	
          	<input name="txtDisplayTitle" id="txtDisplayTitle" class="textfield" value="<?php echo $tmp;?>" onkeyup="validateTitle()" ></input>
            <br>
            <br> <span id="name_hidden"></span>
            
            </td>
	</tr>	
	<tr>
   	<td align="right" >Logo File Name:	</td>
    <td style='border:0px;'> 
    <input type="file" name="file" id="file" onblur="validateFile()" />
    <br>
    <span id="file_hidden"></span>
  
    </td>
	</tr>		
		
	
<!-- 	<tr>
		<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'> To Email:	</td>
       	<td style='border:0px;'>  
    	<input name="txtToEmail" id="txtToEmail" class="textfield" value="<?php echo $tmp;?>" ></input>
       	</td>
	</tr>	
 	<tr>
	    <td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>CC Email</td>
	    <td style='border:0px;'>  
	    <input name="txtCCEmail" id="txtCCEmail" class="textfield" value="<?php echo $tmp;?>" ></input>
	    </td>
	</tr>	
	
-->
	
		
	<tr>
    	<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'> Site Language	</td>
      	<td style='border:0px;'>  
	       	<select name='lang' id='cboLanguage' class='combofield' style='width:300px;height:30px'>
	     	<option value="English">  English </option>
	     	<option value="French">  French </option>
	     	</select>
       	</td>
	</tr>		
	<tr>
		<td colspan='2' style='width:500px;border:0px;padding:10px 0px 13px 10px;text-align:center'>	
			<input name="submit" class="save" value="Save" type="submit" onclick="return validateForm()" ></input>
			<input name="reset" class="reset" value="Reset" onclick="" type="reset" ></input>
			<!--  <input name="cancel" class="cancel" value="Cancel" onclick="history.go(-1);" type="submit" ></input>    -->
		</td>
	</tr>

</table>

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

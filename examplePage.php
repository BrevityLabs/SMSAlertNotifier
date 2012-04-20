


if ($_GET['name']=='edit')  {
	

	
	$editID = $_GET['id'];
	$query2 = "select * from admin where id=$id";
	$result2 = mysql_query($query2) or die("query failed");
	$row2 = mysql_fetch_array($result2)
	
	$title = $row2[1];
	$toEmail = $row2[2];
	$ccEmail = $row2[3];
	$lang = $row2[4];
	
	if ($lang=='English')  {
	
		$selected1 = "selected";
		$selected2 = "";
	}
	else  {
	
		$selected1 = "";
		$selected2 = "selected";
	}
	
	
	?>
	
	
	
	<table>
	
	<tr>
	<td align="right">Display Title:	</td>
	<td align="left" style='border:0px;'>
	<input name="txtDisplayTitle" id="txtDisplayTitle" class="textfield" value="<?php echo $title;?>" ></input>
	</td>
	</tr>
	<tr>
	<td align="right" >Logo File Name:	</td>
	<td style='border:0px;'>
	<input type="file" name="file" id="file" />
	
	
	</td>
	</tr>
	
	<tr>
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
	</tr>
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
	<input name="submit" class="save" value="Save" type="submit" ></input>
	<input name="reset" class="reset" value="Reset" onclick="" type="reset" ></input>
	<input name="cancel" class="cancel" value="Cancel" onclick="history.go(-1);" type="submit" ></input>
	</td>
	</tr>
	
	</table>
	
	
	
	<?php
	

	
	
}
	
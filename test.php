

<?php
if(isset($_POST['save']))
{

$filename = 'logo/';
if (is_writable($filename)) {
	echo 'The file is writable';
} else {
	echo 'The file is not writable';
}

$logoFileName = $_FILES["file"]["name"];
echo "ddd = ";
echo $logoFileName;


if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("logo/" . $_FILES["file"]["name"]))
      {
   
      	echo "jjj";
      echo $_FILES["file"]["name"] . " already exists. ";
	      }
	    else
	      {
	      	echo "jjj";

	      move_uploaded_file($_FILES["file"]["tmp_name"],
	      "logo/" . $_FILES["file"]["name"]);
	      echo "Stored in: " . "logo/" . $_FILES["file"]["name"];
	      }
	    }
	  }
	else
	  {
	  echo "Invalid file";
	  }
	  
	  
}  
	  
	?> 



<html>
<body>

<form action="viewList.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html> 


function validateName() {
	

	var name=document.forms["index"]["txtName"].value;
	var ck_name = /^[A-Za-z ]{1,20}$/;
	if (!ck_name.test(name)) 
	{		
		document.getElementById('name_hidden').style.background = "yellow";
		txt="Enter valid name";
		document.getElementById("name_hidden").innerHTML = txt.fontcolor("red");		
		//name.focus();
		return false;
	
	}
	else
	{
	document.getElementById("name_hidden").innerHTML = "";
	return true;
	}

	if(name=="")
	{
		document.getElementById('name_hidden').style.background = "yellow";
		txt="Enter valid name";
		document.getElementById("name_hidden").innerHTML = txt.fontcolor("red");		
		return false;
	}
	 else
	{
		document.getElementById("name_hidden").innerHTML = "";
		return true;

	}
}

function validateCell()  {	
	
	

	var cell=document.forms["index"]["txtCell"].value;
	var numericExpression = /^[0-9]+$/;
	var c=cell.length;

	if(cell.match(numericExpression)){
	
		if(c==10)
		{
			document.getElementById("cell_hidden").innerHTML = " ";
			return true
		}
		else
		{

		document.getElementById('cell_hidden').style.background = "yellow";
		txt="cell number should be 10 numbers";
		document.getElementById("cell_hidden").innerHTML = txt.fontcolor("red");		
		//elem.focus();
		return false;
		}
	
	}
	else
	{
		document.getElementById('cell_hidden').style.background = "yellow";
		txt="Enter valid cell number";
		document.getElementById("cell_hidden").innerHTML = txt.fontcolor("red");		
		//elem.focus();
		return false;
	}

}



function validateForm()
{
	
	if(validateName() && validateCell())
	{			
		return true;
	}
	else
	{		
		return false;
	}

}

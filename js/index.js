function validateName() {

	var name=document.forms["contactform"]["txtName"].value;
	var ck_name = /^[A-Za-z ]{1,20}$/;

	if (!ck_name.test(name)) 
	{		
		document.getElementById('name_hidden').style.background = "yellow";
		txt= err_valid_name;
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
		txt=err_valid_name;
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

	var cell=document.forms["contactform"]["txtCell"].value;
	var numericExpression = /^[0-9]+$/;
	var c=cell.length;

	if(cell.match(numericExpression)){
	
		if(c==10)
		{
			document.getElementById("cell_hidden").innerHTML = "";
			return true;
		}
		else
		{

			document.getElementById('cell_hidden').style.background = "yellow";
			txt=err_valid_cell_len;
			document.getElementById("cell_hidden").innerHTML = txt.fontcolor("red");		
			//elem.focus();
			return false;
		}
	
	}
	else
	{
		document.getElementById('cell_hidden').style.background = "yellow";
		txt=err_valid_cellno;
		document.getElementById("cell_hidden").innerHTML = txt.fontcolor("red");		
		//elem.focus();
		return false;
	}

}


/****************************************************************/


function validateTableFor()  {	

	var member=document.forms["contactform"]["txtTableFor"].value;
	var numericExpression = /^[0-9]+$/;
		

	if(member.match(numericExpression)){
	
		if(member<=99)
		{
			document.getElementById('member_hidden').style.background = "";
			txt="";
			document.getElementById("member_hidden").innerHTML = txt.fontcolor("red");		
			//elem.focus();
			return true;
		}
		else
		{
			document.getElementById('member_hidden').style.background = "yellow";
			txt=err_max_number;
			document.getElementById("member_hidden").innerHTML = txt.fontcolor("red");		
			//elem.focus();
			return false;
		}
	
	}
	else
	{
		document.getElementById('member_hidden').style.background = "yellow";
		txt=err_valid_number;
		document.getElementById("member_hidden").innerHTML = txt.fontcolor("red");		
		//elem.focus();
		return false;
	}

}

function validateProvider() {
	var radioObj = document.forms["contactform"]["txtPhone"] ;
	var radioLength = radioObj.length;
	var radioValue = '' ;
	
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			radioValue = radioObj[i].value;
		}
	}

	if (radioValue == '') {
		document.getElementById('provider_hidden').style.background = "yellow";
		txt=err_select_provider;
		document.getElementById("provider_hidden").innerHTML = txt.fontcolor("red");		
		return false;
	} else {
		return true ;
	}
}

function validateForm() {
	return (validateName() && validateCell() && validateTableFor() && validateProvider()) ;
}

function sendTextMessage(){
	//TODO form URL
	var arr_val = new Array() ;

		arr_val[0]=getVal('txtName');
		arr_val[1]=getVal('txtCell');
		arr_val[2]=getVal('txtPhone');

		var qrstring="";
		for(var x=0;x<arr_val.length;x++) {
			var objN="a"+x;
			qrstring += "&"+objN+"="+arr_val[x];
		}
		var url  =  "submitting.php?act=1"+qrstring;

		//SUBMIT URL using process()
		process(url, contactUpdated);	
}
function validateTextMessage()
{	
	if(document.getElementById('msgformat').value == '')	{
		alert('Text message format cannot be empty.');
		return false;
	} 	else 	{	
		return true;
	}

}

function showhide(divshow, divhide){
	document.getElementById(divshow).style.display='block';
	document.getElementById(divhide).style.display='none';
}

function update_fields()
{
	var inputText=document.getElementById('input-user-name');
	var uname=document.getElementById('name');
	var contact=document.getElementById('contact');
	var icon=document.getElementsByClassName('update-icon');
	var inputContact=document.getElementById('input-contact-number');
	var updateyesno=document.getElementById('UpdateYesNo');
	var editpen=document.getElementById('editpen');
			
	uname.style.display = 'none';
	contact.style.display = 'none';
	inputText.style.display = '';
	inputContact.style.display = '';
	icon[0].style.display = '';
	icon[1].style.display = '';
	updateyesno.style.display = ''
	editpen.style.display = 'none';

}

function closeFields()
{
	var inputText=document.getElementById('input-user-name');
	var uname=document.getElementById('name');
	var contact=document.getElementById('contact');
	var icon=document.getElementsByClassName('update-icon');
	var inputContact=document.getElementById('input-contact-number');
	var updateyesno=document.getElementById('UpdateYesNo');
	var editpen=document.getElementById('editpen');

	uname.style.display = '';
	contact.style.display = '';
	inputText.style.display = 'none';
	inputContact.style.display = 'none';
	icon[0].style.display = 'none';
	icon[1].style.display = 'none';
	updateyesno.style.display = 'none'
	editpen.style.display = '';	


}


function changeUname(event)
{	
	var fname=document.getElementById('fname').value;
	var lname=document.getElementById('lname').value;	
	var xmlhttp= new XMLHttpRequest()
	if(event.keyCode=='13' || event.button==0)
	{	
		
		if (fname.length==0 || lname.length==0)
		{
			document.getElementsByClassName('update-icon')[0].style.color = 'red';
			document.getElementsByClassName('update-icon')[0].title = 'Fields Expty!';

			return false;
		}

		else
		{	
			document.getElementsByClassName('update-icon')[0].style.color = 'lightgreen';
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					//window.location.reload(true);
				}
			}

			xmlhttp.open('GET','AccountSettingsProcess.php?fname='+fname+'&lname='+lname);
			xmlhttp.send();

			changeNumber(event);
		}
	}
}

function changeNumber(event)
{
	var inputValue=document.getElementById('contactNo').value;
	var inputbox=document.getElementById('contactNo');
	
	inputValue=inputValue.replace(/[^0-9]/gi,"");
	inputbox.value=inputValue;

	var xmlhttp= new XMLHttpRequest();
	var exp=/^[1-9]{1}\d{9}$/;
	var flag=0;
	//validating if no already exist in database or not and matches reglular expression or not
	if (inputValue.match(exp))
	{ 
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{	

				if(xmlhttp.responseText=='duplicate')
				{
					document.getElementsByClassName('update-icon')[1].style.color = 'gold';
					document.getElementsByClassName('update-icon')[1].title = 'Number Already Exists !';	
					flag=1;
					alert('Number already exists');
					return false;
					//updateNumber(event,flag);
				}

				else
				{
					document.getElementsByClassName('update-icon')[1].style.color = 'lightgreen';
					document.getElementsByClassName('update-icon')[1].title = 'Validated Successfully :)';
					updateNumber(event,flag);
					//alert('Updated Successfully!');
				}
				
			}
		}

		xmlhttp.open('GET','AccountSettingsProcess.php?contactCheck='+inputValue, true);
		xmlhttp.send();
	}	
	
	else
	{
		document.getElementsByClassName('update-icon')[1].style.color = 'red';
		document.getElementsByClassName('update-icon')[1].title = 'Incorrect Phone Number';
		//alert('Incorrect Phone Number');
		return false;
	}

}

function updateNumber(event,flag)
{
	//updating number in database

	var xmlhttp=new XMLHttpRequest();
	var inputValue=document.getElementById('contactNo').value;
	var exp=/^[1-9]{1}\d{9}$/gi;
	if(event.keyCode=='13' || event.button==0)
	{
		if (inputValue.match(exp) && flag==0)
		{	
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					window.location.reload(true);
					alert('Updated Successfully!');
				}
			}

			xmlhttp.open('GET','AccountSettingsProcess.php?contact='+inputValue, true);
			xmlhttp.send();	
		}

		else
		{	
			document.getElementsByClassName('update-icon')[1].style.color = 'red';
			return false;
		}
	}
}

function checkPassword(pass)
{	
	var xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{	
			document.getElementById('passStatus').innerHTML=xmlhttp.responseText;
		}
	}

	xmlhttp.open('GET','AccountSettingsProcess.php?password='+pass, true);
	xmlhttp.send();
}

function MatchNewCurrentPass(confirm)
{	

	var newpass=document.getElementById('newPass');
	var confirmpass=document.getElementById('confirmPass');
	var newpasstick=document.getElementById('NewPassTick');
	var confirmpasstick=document.getElementById('ConfirmPassTick');

	var newpassval=newpass.value;

	if (newpassval==confirm) 
	{
		newpass.style.color = 'lightgreen';
		confirmpass.style.color = 'lightgreen';
		newpasstick.innerHTML="<i class='fas fa-check small text-success'></i>";
		confirmpasstick.innerHTML="<i class='fas fa-check small text-success'></i>";


	}

	else
	{
		newpass.style.color = '';
		confirmpass.style.color = 'red';
		newpasstick.innerHTML="";
		confirmpasstick.innerHTML="";
	}
}


function toggle_settings()
{	
	var main=document.getElementById('main');
	var settings=document.getElementById('settings');

	if (settings.style.display == 'none') 
	{
		settings.style.display = '';
		main.style.display = 'none';
	}

}

function close_settings()
{
	var main=document.getElementById('main');
	var settings=document.getElementById('settings');
	
	settings.style.display = 'none';
	main.style.display = '';
	//window.location.reload(true);	
}
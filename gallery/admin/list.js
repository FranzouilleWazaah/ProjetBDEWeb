////////////////// Ajax starts ///////////////////////////////

function ajaxFunction(email_id,todo,status)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateChanged() 
{
if(httpxml.readyState==4)
{
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//alert(httpxml.responseText);

var myObject = eval('(' + httpxml.responseText + ')');

var email_id=myObject.data.email_id;
document.getElementById('msg').style.display='inline';
//alert(myObject.data.status);
////////////////////
if(myObject.data.todo_return =='status_updated')
{document.getElementById("msg").style.background='#ffff00';
var status=myObject.data.status;
document.getElementById("msg").innerHTML=myObject.data.message;
var str="<a href=# onClick=ajaxFunction(" + email_id +",'change_status','" + status + "')>" + status + "</a>";

document.getElementById(email_id).innerHTML=str;
}
else{document.getElementById("msg").style.display='none';}
////////////////////
if(myObject.data.todo_return =='status_deleted')
{
document.getElementById("msg").style.background='#ffff00';
document.getElementById("msg").innerHTML=myObject.data.message;
var rid='r'+email_id;
var sid='s'+email_id;
document.getElementById(rid).style.display='none'
document.getElementById(sid).style.display='none'
document.getElementById(email_id).style.display='none'

}
///////////////////
setTimeout("document.getElementById('msg').style.display='none'",5000)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
}
var url="listck-ajax.php";
url=url+"?email_id="+email_id;
url=url+"&todo="+todo;
url=url+"&status="+status;
url=url+"&sid="+Math.random();
//alert(url);
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
document.getElementById('msg').style.display='inline';
document.getElementById("msg").style.background='#ff00ff';
document.getElementById("msg").innerHTML="Please Wait... ";
}
////////////////////////////////////////


/////////////////  Ajax ends ///////////////////////////



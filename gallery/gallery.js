function ajaxFunction(todo)
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
///////////////////////
//alert(httpxml.responseText); 
var myObject = JSON.parse(httpxml.responseText); 
//alert(myObject.value[0].msg);
switch(myObject.value[0].status_form)
{ // status of form if notok
case 'NOTOK':
document.getElementById("msgDsp").innerHTML=myObject.value[0].msg;
document.getElementById("msgDsp").setAttribute("style","display:block;width:550px;background:'#f0f0c0';borderColor:'red';");
//document.getElementById('msgDsp').style.width='200px';
document.getElementById("msgDsp").style.display='inline';
document.getElementById("msgDsp").style.background='#f0f0c0';
document.getElementById("msgDsp").style.borderColor='red';
break;

case 'ADDED':
document.getElementById("msgDsp").style.borderColor='blue';
document.getElementById("msgDsp").style.background='#2CFC90';
document.getElementById("msgDsp").innerHTML=myObject.value[0].msg;
document.getElementById("msgDsp").style.display='inline';
document.f1.gallery.value='';
break;
} // end of if else if status form notok
setTimeout("document.getElementById('msgDsp').style.display='none'",500)
///////////////////// Start displaying gallery list /////////
var str="<table class='t1'><tr><th>ID</th><th>Gallery</th><th>Visit</th></tr>";
for(i=0;i<myObject.data.length;i++)
{ 
var m=i%2;

str = str + "<tr class='r"+m+ "'><td>" + myObject.data[i].gal_id +  " </td><td>" + myObject.data[i].gallery + "("+ myObject.data[i].no + ") </td><td><a href=gallery-photo.php?gal_id=" + myObject.data[i].gal_id +  ">Visit</a> </td></tr>"
}
str = str + "</table>";
document.getElementById("record-display").innerHTML=str;
//alert(str);
//////////////
}
}

/////////////////////////////////
function getFormData(myForm) { 
var myParameters = new Array(); 
myParameters.push("todo=" + todo);
myParameters.push("gallery=" + f1.gallery.value); 
return myParameters.join("&"); 
} 
////////////////////////////////////////////


var url="galleryck.php";
var myForm = document.forms[0]; 
var parameters=getFormData(myForm);
httpxml.onreadystatechange=stateChanged;
httpxml.open("POST", url, true)
httpxml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
//alert(parameters);
httpxml.send(parameters) 
document.getElementById("msgDsp").innerHTML="<img src=wait.gif>";
document.getElementById("msgDsp").style.display='inline';

////////////////////////////////


}

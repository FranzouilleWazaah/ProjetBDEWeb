<?Php
session_start();
session_unset();
session_destroy();

echo "
<!doctype html public \"-//w3c//dtd html 3.2//en\">
<html>
<head>
<title>Logout from newsletter script</title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\">
</head>

<body>";
//////////////////////////////////////////////
////////////////////////////////////////////


echo "
<table>
<tr class='r1'><td>Successfully Logged out , <a href=login.php>Login</a> </td></tr>
</table>

";





//////////////////////////////////////////////




///////////////////////////////////////////Common part for all pages /////////






echo "</body></html>";

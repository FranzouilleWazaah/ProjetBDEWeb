<?
require "../../session.php";
$auth_user = new USER();
  $id = $_SESSION['user_session'];


if($_SESSION['permissions'] == 'cesiMember'){

echo "<br><a href=manage-photos.php>Manage Photos</a> . <a href=manage-gallery.php>Manage gallery</a>.
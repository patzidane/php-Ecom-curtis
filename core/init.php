<?
$db = mysqli_connect('127.0.0.1', 'pattana', '1234qwer', 'testDB');
if(mysqli_connect_errno()){
  echo "Database connection failed with following errors:".mysqli_connect_error();
  die();
}
require $_SERVER['DOCUMENT_ROOT'].'/tutorial/config.php';
require_once BASEURL.'helpers/helpers.php';
?>

<?php ob_start();
include('header.php');
$user_name = $_POST['user_name'];
$password = hash('sha512', $_POST['password']);

require('db.php');
$sql = "SELECT user_id FROM users_db WHERE user_name = :user_name AND password = :password";


$cmd = $conn->prepare($sql);

$cmd->bindParam(':user_name', $user_name, PDO::PARAM_STR, 50);
$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
$cmd->execute();
$users_db = $cmd->fetchAll();
$count = $cmd->rowCount();
$conn = null;

if ($count == 0) {
	echo 'Invalid Login';
	echo "<h1><a href=\"reg-log.php\">try again</a></h1>";
	//exit();
}
else { session_start(); 
	foreach  ($users_db as $user) {
		$_SESSION['user_id'] = $user['user_id'];
		header('location:home.php');
	}
}
include('footer.php');
ob_flush(); ?>

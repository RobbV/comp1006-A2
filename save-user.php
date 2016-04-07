<?php
$page_title = 'Processing you Registration!';
// linking the head page.
require('header.php');

$user_name = $_POST['user_name'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

//validation
if (empty($user_name)) {
    echo 'Username is required />';
    $ok = false;
}
if (empty($full_name)) {
    echo 'full name is required />';
    $ok = false;
}
if (empty($email)) {
    echo 'email is required />';
    $ok = false;
}
if (empty($password)) {
    echo 'Password required! />';
    $ok = false;
}
if (empty($confirm)) {
    echo 'Confirm is requied! />';
    $ok = false;
}
if ($password !== $confirm) {
  echo 'Passwords do not match />';
  $ok = false;
}
// save if the form is ok
if ($ok == true){
    require('db.php'); // database connection

    $sql = "INSERT INTO users_db (user_name, full_name, email, password) VALUES (:user_name, :full_name, :email, :password)";
    // SQL query to check for duplicate emails
    $sql_emailcheck = "SELECT COUNT(*) FROM users_db WHERE email = $email";
    $cmd = $conn ->prepare($sql_emailcheck);
    $cmd ->bindParam(':email', $email,PDO::PARAM_STR, 50);
    $cmd->execute();
    if ($sql_emailcheck >= 1){
      echo 'Email already in use Please LogIn or use an alternate email';
      $ok = false;
    }
    // hash the password
        $hashed_password = hash('sha512', $password);

        $cmd = $conn ->prepare($sql);
        $cmd ->bindParam(':user_name', $user_name, PDO::PARAM_STR, 50);
        $cmd ->bindParam(':full_name', $full_name, PDO::PARAM_STR, 50);
        $cmd ->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $cmd ->bindParam(':password', $hashed_password, PDO::PARAM_STR, 128);
        $cmd ->execute();

    $conn = null;
}
?>
  <h1><a href="reg-log.php">LogIn</a></h1>
<?php
require('footer.php');
?>

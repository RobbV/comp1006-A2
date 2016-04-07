<?php ob_start();
// header and auth
$page_title = 'Deleting....';
require_once ('header.php');
require_once ('auth.php');
try {
    // identity the record the user wants to delete
    $car_id = null;
    $car_id = $_GET['car_id'];
    if (is_numeric($car_id)) {
        // connect
        require('db.php');
        // delete the image from the table
        $sql = "SELECT image FROM cars WHERE car_id = :car_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        $cmd->execute();
        $image = $cmd->fetchColumn();
        // delete the image file if one is found in our query
        if (!empty($image)) {
            unlink("images/$image");
        }
        // prepare and execute the SQL DELETE command
        $sql = "DELETE FROM cars WHERE car_id = :car_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        $cmd->execute();
        // disconnect
        $conn = null;
        // redirect back to view cars
        header('location:view_cars.php');
    }
}
catch (Exception $e) {
    mail('rob.vdg.14@gmail.com','thers an error!');
    header('location:error.php');
}
ob_flush(); ?>

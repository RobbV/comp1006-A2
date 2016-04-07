<?php ob_start();
// header and auth
$page_title = 'Deleting....';
require_once ('header.php');
require_once ('auth.php');
try {
    // identity the record the user wants to delete
    $page_id = null;
    $page_id = $_GET['page_id'];
    if (is_numeric($page_id)) {
        // connect
        require('db.php');
        // delete the image from the table
        $sql = "SELECT page_image FROM pages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $image = $cmd->fetchColumn();
        // delete the image file if one is found in our query
        if (!empty($image)) {
            unlink("images/$image");
        }
        // prepare and execute the SQL DELETE command
        $sql = "DELETE FROM pages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        // disconnect
        $conn = null;
        // redirect to CMS tools
        header('location:cms_tools.php');
    }
}
catch (Exception $e) {
    mail('rob.vdg.14@gmail.com','thers an error!');
    header('location:error.php');
}
ob_flush();?>

<?php ob_start();
// header and auth
$page_title = 'Saving....';
require_once ('header.php');
require_once ('auth.php');
    // store the form inputs in variables
    $page_title = $_POST['page_title'];
    $page_image = $_POST['page_image'];
    $page_content = $_POST['page_content'];
    // validate our inputs individually
    $ok = true;
 try {
    if (empty($page_title)) {
        echo 'your page needs a title!<br />';
        $ok = false;
    }
    if (empty($page_content)) {
        echo 'content is required!<br />';
        $ok = false;
    }

    // validate and process photo upload if we have one
    if (!empty($_FILES['page_image']['page_title'])) {
        $logo = $_FILES['page_image']['page_title'];
        // get and check type
        $type = $_FILES['page_image']['type'];
        if (($type == 'image/png') || ($type == 'image/jpeg')) {
            // save the file - valid type
            $final_name = session_id() . "-" . $page_image;
            $tmp_name = $_FILES['page_image']['tmp_name'];
            move_uploaded_file($tmp_name, "image/$final_name");
        }
        else {
            echo 'Logo must be a JPG or PNG<br >';
            $ok = false;
        }
    }
    else {
        
        if (!empty($_POST['current_image'])) {
            $final_name = $_POST['current_image'];
        }
    }
    // check if the form is ok to save or not
    if ($ok == true) {
        // connect to the db
        require('db.php');
        // set up the SQL command to save the data
        if (empty($page_id)) {
            $sql = "INSERT INTO pages (page_title, page_image, page_content)
          VALUES (:page_title, :page_image, :page_content)";
        } else {
            $sql = "UPDATE pages SET page_title = :page_title, page_image = :page_image,
          page_content = :page_content
           WHERE page_id = :page_id";
        }
        // create a command object
        $cmd = $conn->prepare($sql);
        // put each input value into the proper field
        $cmd->bindParam(':page_title', $page_title, PDO::PARAM_STR);
        $cmd->bindParam(':page_image', $page_image, PDO::PARAM_INT);
        $cmd->bindParam(':page_content', $page_content, PDO::PARAM_BOOL);
        if (!empty($page_id)) {
            $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        }
        // execute the save
        $cmd->execute();
        // disconnect
        $conn = null;

        // redirect
        header('location:cms_tools.php');
    }
 }
  catch (Exception $e) {
      mail('rob.vdg.14@gmail.com', 'Oops!', $e);
      header('location:error.php');
  }
?>
</body>
</html>

<?php ob_flush(); ?>

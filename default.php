<?php ob_start();
// pull cotent from database to fill the page
// check for page id
if ((!empty($_GET['page_id'])) && (is_numeric($_GET['page_id']))) {

    $page_id = $_GET['page_id'];
    //connect
    require('db.php');
    // fetch the data for the database
    $sql = "SELECT * FROM pages WHERE page_id = :page_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    $cmd->execute();
    $pages = $cmd->fetchAll();
    //disconnect
    $conn = null;
    // store values in to variable to be used my the page
    //store each value from the database into a variable
    foreach ($pages as $page) {
      $title = $page['page_title'];
      $image = $page['page_image'];
      $content = $page['page_content'];
    }
  }
// set title and show header
$page_title = $title;
require('header.php');
// auth
require('auth.php');
?>
<h2><?php echo $page_title ?></h2>
    <p>
        <?php echo $content ?>
    </p>
<!-- include footer -->
<?php require('footer.php');?>

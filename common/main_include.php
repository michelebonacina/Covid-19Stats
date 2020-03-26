<!-- main include -->
<?php
$page = !empty($_GET['page']) ? $_GET['page'] : 'main';
$pageFile = "view/" . $page . ".php";
if (!file_exists($pageFile)) {
    $pageFile = "error/404.html";
}
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php
        require_once("view/side_bar.php");
        ?>
    </div>
    <div id="layoutSidenav_content">
        <?php
        require_once($pageFile);
        require_once("view/bottom_bar.php");
        ?>
    </div>
</div>
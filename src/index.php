<?php
  require_once('./template/page.php');
  $page = new Page('Main page');
  $page->start();
?>

<h1> Hi, <?php echo $page->getUser()->getUsername(); ?> </h1>

<?php $page->end(); ?>
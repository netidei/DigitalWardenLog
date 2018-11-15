<?php
  require_once('./includes/page.php');
  require_once('./components/timeline.php');
  
  $page = new Page();
  $page->init('Main page');
?>

<h1>Roadmap</h1>

<div class="timeline">
  <?php Timeline($page->getDatabase()) ?>
</div>

<?php $page->build(); ?>
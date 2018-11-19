<?php
  require_once(realpath('./includes/page.php'));
  require_once(realpath('./components/timeline.php'));
  
  $page = new Page();
  $page->init('Main page');
?>

<h1>Roadmap</h1>

<div class="timeline">
  <?php Timeline($page->getDatabase()) ?>
</div>

<?php $page->build(); ?>
<form method="POST">
  <?php 
    foreach ($inputs as $input) {
      $label = $input['label'];
      $type = $input['type'];
      $name = $input['name'];
      require(__DIR__ . '\\formInput.php');
    }
  ?>
  <input type="submit" class="btn btn-primary" value="<?php echo $submit ?>" />
</form>
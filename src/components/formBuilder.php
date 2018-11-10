<?php function formBuilder ($inputs, $submit) { ?>
    <form method="POST">
      <?php foreach ($inputs as $input) { ?>
        <div class="form-group">
          <label class="form-label"><?php echo $input['label'] ?></label>
          <input class="form-input" type="<?php echo $input['type'] ?>" name="<?php echo $input['name'] ?>" placeholder="<?php echo $input['label'] ?>">
        </div>
      <?php } ?>
      <input type="submit" class="btn btn-primary" value="<?php echo $submit ?>" />
    </form>
<?php } ?>
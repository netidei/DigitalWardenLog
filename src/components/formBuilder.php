<?php function FormBuilder ($inputs, $submit) { ?>
    <form method="POST">
      <?php foreach ($inputs as $input) { ?>
        <div class="form-group">
          <label class="form-label"><?php echo $input['label'] ?></label>
          <?php
            $type = $input['type'];
            switch ($type) {
            case 'select':
              $options = $input['options']; ?>
              <select class="form-select" name="<?php echo $input['name'] ?>">
                <?php foreach ($options as $text=>$value) { ?>
                <option value="<?php echo $value ?>"><?php echo $text ?></option>
                <?php } ?>
              </select>
              <?php break;
            default: ?>
              <input class="form-input" type="<?php echo $type ?>" name="<?php echo $input['name'] ?>" placeholder="<?php echo $input['label'] ?>">
              <?php break;
            }
          ?>
          
        </div>
      <?php } ?>
      <input type="submit" class="btn btn-primary" value="<?php echo $submit ?>" />
    </form>
<?php } ?>
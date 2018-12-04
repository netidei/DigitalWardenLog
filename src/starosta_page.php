<?php
  require_once(realpath('./includes/page.php'));
  require_once(realpath('./components/timeline.php'));
  
  $page = new Page();
  $page->init('Main page');
  //$page->getDatebase();
?>
  <div class="columns">
    <div class="column col-3">
      <label class="form-label" for="validationDefault01">Дата</label>
      <input type="date" class="form-input" id="validationDefault01"  required>
    </div>
    <div class="column col-1">
      <label class="form-label"  for="validationDefault02">№ пары</label>
      <select name="date" class="form-select form-input" required> <!--Supplement an id here instead of using 'name'-->
        <option disabled value="" selected="">Выбрать..</option> 
        <option value="value1">1</option> 
        <option value="value2">2</option>
        <option value="value3">3</option>
        <option value="value4">4</option>
        <option value="value5">5</option>
        <option value="value6">6</option>
        <option value="value7">7</option>
    </select> 
    </div>
    <div class="column col-5">
      <label class="form-label"  for="validationDefaultUsername">Предмет</label>
      <select name="subject" class="form-select form-input" required> <!--Supplement an id here instead of using 'name'-->
        <option disabled value="" selected="">Выбрать..</option> 
        <option value="value1">Проетирование информационных систем</option> 
        <option value="value2">Психология и педагогика</option>
      </select>
    </div>
    <div class="column col-3">
      <label class="form-label"  for="validationDefaultUsername">Преподаватель</label>
      <select name="subject" class="form-select form-input" required> <!--Supplement an id here instead of using 'name'-->
      <option disabled value="" selected="">Выбрать..</option> 
        <option value="value1">Ермоленко А.В.</option> 
        <option value="value2">Бабенко В.В.</option>
    </select>
  </div>
  </div>
  <div class="columns">
    <div class="column col-2">
      <label class="form-label"  for="validationDefaultUsername">Тип пары</label>
      <select name="subject" class="form-select form-input" required> <!--Supplement an id here instead of using 'name'-->
      <option disabled value="" selected="">Выбрать..</option> 
        <option value="value1">Лекция</option> 
        <option value="value2">Практика</option>
        <option value="value3">Лабораторная</option>
    </select>
  </div>
    <div class="column col-10">
      <label class="form-label"  for="validationDefault04">Тема</label>
      <input type="text" class="form-input" id="validationDefault04"  required>
    </div>
  </div>
  <div class="form-group">
    <table  class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">№</th>
          <th scope="col">Студент</th>
          <th scope="col">Посещение</th>
          
         </tr>
      </thead>
      <tbody>
        <tr>
          <th width="100" scope="row">1</th>
          <td>Иван Иванов</td>
          <td><input type="checkbox" checked onclick="if(this.checked){this.nextSibling.style.display='none' }else {this.nextSibling.style.display='';  this.nextSibling.value='';}"><select  style="display: none"> 
            <option value="" disabled selected="">Причина отсутсвия</option> 
              <option value="value1">Уважительная</option> 
              <option value="value2">Неуважительная</option>
          </select></td>
          
        </tr>
                <tr>
          <th width="100" scope="row">2</th>
          <td>Петр Петров</td>
          <td width="250"><input type="checkbox" checked onclick="if(this.checked){this.nextSibling.style.display='none' }else {this.nextSibling.style.display='';  this.nextSibling.value='';}"><select style="display: none"> 
            <option value="" disabled selected="">Причина отсутсвия</option> 
              <option value="value1">Уважительная</option> 
              <option value="value2">Неуважительная</option>
          </select></td>
          
        </tr>
      </tbody>
    </table>
  </div>
  <div align="center">
    <a href="javascript:close_window();"  id="cancel" name="cancel" class="btn btn-default">Отмена</a>
  <button class="btn btn-primary" type="submit">Добавить</button>
  </div>
  </div>
<?php $page->build(); ?>
<?php

require_once realpath(__DIR__ . '/page.php');

class TeacherPage extends Page
{
    protected function content($props, $db, $user)
    { ?>
  
  <div class="form-group">
  <script>
	function revertButtonHandler(element){
		var selElement = element.parentNode.childNodes[3];
		selElement.style.display='';
		selElement.style.value='';
	};
  </script>
  
    <table  class="table table-bordered">
      <thead>
        <tr>
                    <th scope="col">№</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Время пары</th>
                    <th scope="col">Группа</th>
                    <th scope="col">Название пары</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Проведена</th>
                    <th scope="col">На доработку</th>          
                    <th scope="col">Подпись</th>
          
         </tr>
      </thead>
      <tbody>
           <tr>
                    <th>1</th>
                    <td>20.11.2018</td>
                    <td>4 - 13:50-15:20</td>
                    <td>147а</td>
                    <td>Педагогика и Психология</td>
                    <td>Личность человека и прочая лабуда</td>
                    <td>Да</td>
					<td class="text-center">
                        <button class="btn btn-error" type="submit" onclick="revertButtonHandler(this)">Отправить</button>
						<select style="display: none"> 
							<option value="" disabled selected="">Причина отсутсвия</option> 
							<option value="value1">Уважительная</option> 
							<option value="value2">Неуважительная</option>
						</select>
                    </td>

                    <td class="text-center">
                        <button disabled class="btn btn-primary" type="submit">Подписать</button>
                    </td>

                </tr>
                <tr>
                    <th>2</th>
                    <td>18.11.2018</td>
                    <td>3 - 11:20-12:50</td>
                    <td>147б</td>
                    <td>ООП</td>
                    <td>C++</td>
                    <td>Нет</td>
					<td class="text-center">
                        <button class="btn btn-error" type="submit" onclick="revertButtonHandler(this)">Отправить</button>
						<select style="display: none"> 
							<option value="" disabled selected="">Причина отсутсвия</option> 
							<option value="value1">Уважительная</option> 
							<option value="value2">Неуважительная</option>
						</select>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-primary center" type="submit">Подписать</button>
                    </td>

                </tr>
          
      </tbody>
    </table>
  </div>
  </div>
  <?php
    }
}

return new TeacherPage($db, $user, $data);
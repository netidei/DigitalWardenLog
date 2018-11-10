<?php
  require_once('./includes/page.php');
  $page = new Page();
  $page->init('Main page');
?>

<h1>Roadmap</h1>

<div class="timeline">
  <div class="timeline-item">
    <div class="timeline-left">
      <a class="timeline-icon"></a>
    </div>
    <div class="timeline-content">
      <div class="tile">
        <div class="tile-content">
          <p class="tile-title"><b>6 Ноября</b> Sprint 0</p>
          <p class="tile-subtitle"><a>UseCase</a>: Анализ вариантов использования</p>
          <p class="tile-subtitle"><a>Product backlog</a>: Список требований к функциональности продукта</p>
          <p class="tile-subtitle"><a>ERD</a>: Схема базы данных</p>
          <p class="tile-subtitle">Система авторизации</p>
        </div>
      </div>
    </div>
  </div>

  <div class="timeline-item">
    <div class="timeline-left">
      <a class="timeline-icon icon-lg">
        <i class="icon icon-check"></i>
      </a>
    </div>
    <div class="timeline-content">
      <div class="tile">
        <div class="tile-content">
          <p class="tile-title"><b>8 Ноября</b> Sprint 1</p>
          <p class="tile-subtitle"><a>Страница старосты</a>: регистрация записи о проведенном занятии</p>
          <p class="tile-subtitle"><a>Страница директрата</a>: добавлении нового пользователя</p>
          <p class="tile-subtitle">Создание базы данных</p>
          <p class="tile-subtitle">Система шаблонов</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $page->build(); ?>
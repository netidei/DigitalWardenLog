<?php
  require_once('./includes/page.php');
  require_once('./components/timelineItem.php');
  
  $page = new Page();
  $page->init('Main page');
?>

<h1>Roadmap</h1>

<div class="timeline">
  <?php
    TimelineItem(null, "<b>6 Ноября</b> Sprint 0", array(
      "<a>UseCase</a>: Анализ вариантов использования</p>",
      "<a>Product backlog</a>: Список требований к функциональности продукта",
      "<a>ERD</a>: Схема базы данных",
      "Система авторизации"));
    TimelineItem("icon-check", "<b>8 Ноября</b> Sprint 1", array(
      "<a>Страница старосты</a>: регистрация записи о проведенном занятии",
      "<a>Страница директрата</a>: добавлении нового пользователя",
      "Создание базы данных",
      "Система шаблонов"));
    TimelineItem("icon-check", "<b>13 Ноября</b> Немного теории", array(
        "<a>Стандарты</a>: инструкции и ссылки к используемому обеспечения",
        "Закрепление алгоритма равзорачивания среды разработки",
        "Пример создания компонента TimelineItem"));
  ?>
</div>

<?php $page->build(); ?>
<?php
  require_once realpath('./includes/page.php');
  require_once realpath('./components/tile.php');
  require_once realpath('./components/timelineItem.php');
  require_once realpath('./components/timeline.php');
  
  $page = new Page();
  $page->init('Main page');
  $db = $page->getDatabase();
  // Events
  $eventsData = $db->select('roadmap_event', '*', null, 'ORDER BY `date` DESC');
  $events = array();
while ($event = $eventsData->row()) {
    // Title
    $id = $event[0];
    $date = date('d F', strtotime($event[1]));
    $text = $event[2];
    $title = "<b>$text</b> $date";
    // Subtitles
    $subtitles = array();
    $subtitlesData = $db->select('event_subtitle', 'subtitle', "`event` = $id");
    while ($subtitle = $subtitlesData->row()) {
        array_push($subtitles, $subtitle[0]);
    }
    // Add Event
    array_push($events, new TimelineItem(new Tile($title, $subtitles)));
}
  $timeline = new Timeline($events);

?>

<h1>Roadmap</h1>

<div class="timeline">
    <?php $timeline->build() ?>
</div>

<?php $page->build();

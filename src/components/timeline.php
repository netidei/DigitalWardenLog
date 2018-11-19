<?php
  require_once(realpath(__DIR__ . '/timelineItem.php'));

  function Timeline($db) {
    $events = $db->select('roadmap_event', '*', null, 'ORDER BY `date` DESC');
    $icon = null;
    while ($event = $events->row()) {
      $id = $event[0];
      $date = date('d F', strtotime($event[1]));
      $text = $event[2];
      $title = "<b>$text</b> $date";
      $items = array();
      $subtitles = $db->select('event_subtitle', 'subtitle', "`event` = $id");
      while ($subtitle = $subtitles->row()) {
        array_push($items, $subtitle[0]);
      }
      TimelineItem($icon, $title, $items);
      if (!$icon) {
        $icon = "icon-check";
      }
    }
  }
?>
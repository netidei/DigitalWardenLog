<?php

require_once realpath(__DIR__ . '/page.php');
require_once realpath(__DIR__ . '/elements/timeline/tile.php');
require_once realpath(__DIR__ . '/elements/timeline/timelineItem.php');
require_once realpath(__DIR__ . '/elements/timeline/timeline.php');

class MainPage extends Page
{

    protected function content($props, $db, $user)
    {
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
            array_push($events, ['title'=>$title, 'subtitles'=>$subtitles]);
        }
        ?>
        <h1>Roadmap</h1>
        <div class="timeline">
            <?php self::print('Timeline', ['element'=>'TimelineItem', 'items'=>$events, 'elementProps'=>['element'=>'Tile']]); ?>
        </div>
        <?php
    }
}

return new MainPage($db, $user, $data);

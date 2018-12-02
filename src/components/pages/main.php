<?php

require_once realpath(__DIR__ . '/page.php');
require_once realpath(__DIR__ . '/../elements/layout/tile.php');
require_once realpath(__DIR__ . '/../elements/timeline/timelineItem.php');
require_once realpath(__DIR__ . '/../elements/timeline/timeline.php');

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
            $tile = new Tile(['title'=>$title, 'subtitles'=>$subtitles]);
            array_push($events, new TimelineItem(['content'=>$tile]));
        }
        $timeline = new Timeline(['items'=>$events]);
        ?>
        <h1>Roadmap</h1>
        <div class="timeline">
            <?php self::print($timeline) ?>
        </div>
        <?php
    }
}

return new MainPage($db, $user, 'Home page');

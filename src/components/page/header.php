<?php

require_once realpath(__DIR__ . '/../component.php');

class PageHeader extends Component
{

    private const DATA = ['title', 'content'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        ?>
        <html>
            <head>
                <meta charset="utf-8">
                <title><?= $title ?></title>
                <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
                <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
                <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
                <link rel="stylesheet" type="text/css" href="./styles/main.css">
            </head>
        <body>
            <div class="container">
                <?php
                    self::print($content);
    }
}
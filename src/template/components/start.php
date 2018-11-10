<html>
<head>
  <meta charset="utf-8">
  <title><?php $page->Title(); ?></title>
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
  <link rel="stylesheet" type="text/css" href="./pages/styles/main.css">
</head>
<body>
  <div class="container">
    <header class="navbar">
        <section class="navbar-section">
          <a href="/" class="navbar-brand mr-2">Digital Journal</a>
          <?php $page->MenuItems(); ?>
        </section>
        <?php $page->MenuSections(); ?>
        <?php $page->ProfileSection(); ?>
    </header>
    <div class="columns">
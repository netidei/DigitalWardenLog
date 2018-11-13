<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
  <link rel="stylesheet" type="text/css" href="./styles/main.css">
</head>
<body>
  <div class="container">
    <header class="navbar">
        <section class="navbar-section">
          <a href="index.php" class="navbar-brand text-bold mr-2">Digital Journal</a>
          <?php Page::showMenu($menuItems); ?>
        </section>
        <?php Page::printList($menuSections); ?>
        <?php if ($username) { ?>
          <section class="navbar-section">
            <a href="/" class="text-bold"><?php echo $username ?></a>
            <a href="logout.php" class="btn btn-link">Выход</a>
          </section>
        <?php } ?>
    </header>
<?php include 'backend/data.php'; ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lista zadań do zrobienia">
    <meta name="author" content="Szymon Bakonis">
    <meta name="robots" content="noindex, follow">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel='stylesheet' href='frontend/style.css'>
    <title>To do list</title>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <div class="to-do-list">
    <ul class="list">
      <h1><span class="vertical-bars"></span>ToDoList</h1>
      <?php 
        for ($i = 0; $i < count($id); $i++) { ?>
        <li id="<?php echo $id[$i]; ?>" <?php if ($done[$i] == true) { echo 'class="checked"'; } ?>>
          <input class="checkbox" type="checkbox" <?php if ($done[$i] == true) { echo 'checked'; } ?>>
          <span class="vertical-bars"></span>
          <h2><?php echo $name[$i]; ?></h2>
          <img src="/to-do-list/frontend/trash.png" class="trash">
        </li><?php } ?>
      <li id="li_button"><button id="button_click">+</button><span class="vertical-bars"></span><input id="button_text" type="text" maxlength="30"></li>
    </ul>
  </div>

  <script src='frontend/scripts.js'></script>

</body>

</html>
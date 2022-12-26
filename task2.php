<?php
include_once './TaskTwo.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Task One</title>
</head>
<body>

<header>
    <?php include_once 'header.php';?>
</header>

<div class="main">
    <h1>Task 2</h1>
    <hr>

    <div class="category-tree">
        <?php
            $categories = $db->table('category')->get(["Id AS categoryId", "Name"]);
            $category = new TaskTwo($categories);
            dd($category->tree());
        ?>
    </div>
</div>
</body>
</html>
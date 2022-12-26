<?php
include_once './TaskOne.php';
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
        <h1>Task 1</h1>
        <hr>

        <?php $task_one = new TaskOne(); ?>

        <table border="1" style="border-collapse: collapse; width: 100%">
            <thead>
            <tr>
                <th>Category Name</th>
                <th>Total Items</th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($task_one->getCategoriesWithItemCount() as $categoryCount) : ?>
                <tr>
                    <td><?php echo $categoryCount['Name'] ?></td>
                    <td><?php echo $categoryCount['count'] ?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>
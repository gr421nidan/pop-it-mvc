<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/pop-it-mvc/public/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <title>Деканат</title>
</head>
<body>
<?php
if (!app()->auth::check()):
    ?>
    <header>
        <nav>
            <div class="nav">
                <h3><a href="<?= app()->route->getUrl('/hello') ?>" class="logo">Деканат</a></h3>
                <button class="button_nav"><a href="<?= app()->route->getUrl('/login') ?>" class="button_nav_link">Вход</a></button>
            </div>

        </nav>
    </header>
    <main>
        <?= $content ?? '' ?>

    </main>
<?php
else:
    if (app()->auth::checkRole()):
        ?>
        <header>
            <nav>
                <div class="nav">
                    <h3><a href="<?= app()->route->getUrl('/hello') ?>" class="logo">Деканат</a></h3>
                    <button class="button_nav"><a href="<?= app()->route->getUrl('/logout') ?>" class="button_nav_link">Выход</a></button>
                </div>

            </nav>
        </header>
        <main>
            <?= $content ?? '' ?>
        </main>
    <?php
    else:
        ?>
        <header>
            <nav class="nav_employees">
                <h3><a href="<?= app()->route->getUrl('/hello') ?>" class="logo">Деканат</a></h3>
                <a href="<?= app()->route->getUrl('/gradeStudents') ?>" class="nav_link">Успеваемость</a>
                <a href="<?= app()->route->getUrl('/cabinet') ?>" class="nav_link">Личный кабинет</a>
                <a href="<?= app()->route->getUrl('/groups') ?>" class="nav_link">Группы</a>
                <a href="<?= app()->route->getUrl('/disciplines') ?>" class="nav_link">Дисциплины</a>
                <a href="<?= app()->route->getUrl('/students') ?>" class="nav_link">Студенты</a>
                <button class="button_nav"><a href="<?= app()->route->getUrl('/logout') ?>" class="button_nav_link">Выход</a></button>
            </nav>
        </header>
        <main>
            <?= $content ?? '' ?>
        </main>
    <?php
    endif;
    ?>

<?php
endif;
?>

</body>
</html>

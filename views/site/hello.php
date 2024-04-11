<?php
if (!app()->auth::check()):
    ?>
    <div class="content_main_guest">
        <img src="/pop-it-mvc/public/image/main_guest.jpg" class="image" alt="Изображение">
        <div class="text_info">
            <h2 class="text">Вы наш сотрудник?</h2>
            <p class="text">Авторизовывайтесь!</p>
        </div>

    </div>
<?php
else:
    if (app()->auth::checkRole()):
        ?>
        <div class="content_main_admin">
            <div class="add_employee">
                <h1>Добавьте новые данные</h1>
                <div class="add_employee_info">
                    <p>Добавьте нового сотрудника</p>
                    <button class="button_add"><a href="<?= app()->route->getUrl('/addEmployees') ?>" class="button_add_link">Добавить</a></button>
                </div>
            </div>
            <img src="/pop-it-mvc/public/image/main_admin.jpg" class="image" alt="Изображение">
        </div>
    <?php
    else:
        ?>
        <main>
            <div class="content_main_admin">
                <div class="add_new_data">
                    <h1>Добавьте новые данные</h1>
                    <div class="add_new_data_info">
                        <p>Добавьте нового студента</p>
                        <button class="button_add"><a href="<?= app()->route->getUrl('') ?>" class="button_add_link">Добавить</a></button>
                    </div>
                    <div class="add_new_data_info">
                        <p>Добавьте новую группу</p>
                        <button class="button_add"><a href="<?= app()->route->getUrl('') ?>" class="button_add_link">Добавить</a></button>
                    </div>
                    <div class="add_new_data_info">
                        <p>Добавьте новую дисциплину</p>
                        <button class="button_add"><a href="<?= app()->route->getUrl('') ?>" class="button_add_link">Добавить</a></button>
                    </div>
                </div>
                <img src="/pop-it-mvc/public/image/main_employees.jpg" class="image" alt="Изображение">
            </div>
        </main>
    <?php
    endif;
    ?>

<?php
endif;
?>


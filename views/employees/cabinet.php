<div class="content_cabinet">
    <div class="employee_cabinet_content">
        <h1>Мой профиль</h1>
        <form  method="post" enctype="multipart/form-data">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="file" name="image">
            <button type="submit">Загрузить изображение</button>
        </form>
        <div class="employee_cabinet">
            <div class="info_employees">
                <p class="text_info">Логин: <?= app()->auth::user()->login ?></p>
                <p class="text_info">Пароль: <?= app()->auth::user()->password ?></p>
            </div>
            <div class="list_img">
                <?php if ($images->isNotEmpty()): ?>
                    <?php foreach ($images as $image): ?>
                        <img src="/pop-it-mvc/public/image/<?= $image->name ?>" class="image_cabinet" alt="Изображение">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
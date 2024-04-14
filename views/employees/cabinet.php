<div class="content_cabinet">
    <div class="employee_cabinet_content">
        <h1>Мой профиль</h1>
        <h3><a href="">Загрузить фото</a></h3>
        <div class="employee_cabinet">
            <div class="info_employees">
                <p class="text_info">Логин: <?= app()->auth::user()->login ?></p>
                <p class="text_info">Пароль: <?= app()->auth::user()->password ?></p>
            </div>
            <div class="list_img">
                <?php if ($image->isNotEmpty()): ?>
                    <?php foreach ($image as $images): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($images->image) ?>" class="image_cabinet" alt="Изображение">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
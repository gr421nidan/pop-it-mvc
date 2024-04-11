<div class="content_cabinet">
    <div class="employee_cabinet_content">
        <h1>Мой профиль</h1>
        <div class="employee_cabinet">
            <div class="info_employees">
                <p class="text_info">Логин: <?= app()->auth::user()->login ?></p>
                <p class="text_info">Пароль:<?= app()->auth::user()->password ?></p>
            </div>
            <img src="/pop-it-mvc/public/image/cabinet.jpg" class="image_cabinet" alt="Изображение">
        </div>
    </div>
</div>
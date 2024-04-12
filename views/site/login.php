<div class="login_content">
    <div class="login_content_block">
        <h2>Войдите в свою учетную запись</h2>
        <?php
        if (!app()->auth::check()):
            ?>
            <form method="post" class="form_login">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input class="field_login" type="text" name="login" placeholder="Логин">
                <input class="field_login" type="password" name="password" placeholder="Пароль">
                <button class="button_login">Войти</button>
            </form>
        <?php endif;
        ?>
    </div>
</div>
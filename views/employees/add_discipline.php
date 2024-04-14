<?= $message ?? '';?>
<div class="add_discipline_content">
    <div class="add_discipline_content_block">
        <h2>Добавление новой дисциплины</h2>
        <form method="post" class="form_add_discipline">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input class="field_add_discipline" type="text" name="name" placeholder="Название">
            <button class="button_add_discipline">Добавить</button>
        </form>
    </div>
</div>
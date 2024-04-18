<h3><?= $message ?? '';?></h3>
<div class="add_students_content">
    <div class="add_students_content_block">
        <h2>Добавление нового студента</h2>
        <form method="post" class="form_add_students">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <div class="fields_form_add_students">
                <input class="field_add_student" type="text" name="last_name" placeholder="Фамилия">
                <input class="field_add_student" type="text" name="name" placeholder="Имя">
                <input class="field_add_student" type="text" name="patronymic" placeholder="Отчество">
                <div class="small_fields_row">
                    <select name="gender" class="field_add_student_small">
                        <option value="">Пол</option>
                        <option value="Мужской">Мужской</option>
                        <option value="Женский">Женский</option>
                    </select>
                    <input name="date" class="field_add_student_small" type="date" placeholder="Дата">
                </div>
                <input class="field_add_student" type="text" name="address" placeholder="Адрес прописки">
                <select name="group_id" class="field_add_student">
                    <option value="">Группа</option>
                    <?php
                    foreach ($select_groups as $select_group){
                        echo "<option value=\"$select_group->id\">$select_group->name</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="button_add_student">Добавить</button>
        </form>
    </div>
</div>

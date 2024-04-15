<div class="content_evaluations">
    <h2>Выставить оценку - <?= $studentName ?> <?= $groupName ?></h2>
    <div class="column_in_evaluations">
        <div class="row_in_evaluations">
            <form method="post" class="evaluations_form">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <select name="disciplineGroupId" class="discipline_student">
                    <option value="">Дисциплины</option>
                    <?php foreach ($disciplinesGroup as $disciplineGroup) : ?>
                        <?php $discipline = $disciplineGroup->discipline->name; ?>
                        <option value="<?= $disciplineGroup->id ?>"><?= $discipline ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="evaluationName" class="evaluations_number">
                    <option value=""></option>
                    <?php foreach ($evaluations as $evaluation) : ?>
                        <option value="<?= $evaluation->evaluation ?>"><?= $evaluation->evaluation ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="evaluations_button">
                    <button type="submit" class="btn">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
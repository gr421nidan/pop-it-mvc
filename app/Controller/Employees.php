<?php

namespace Controller;

use Model\Control;
use Model\Discipline;
use Model\DisciplinesGroup;
use Model\Evaluations;
use Model\Grade;
use Model\Group;
use Model\Image;
use Model\Student;
use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;
use DateTime;



class Employees
{
    public function addStudents(Request $request): string
    {
        $select_groups = Group::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'last_name' => ['cyrillic','required:students,last_name'],
                'name'=>['cyrillic','required:students,first_name'],
                'date' => ['required','currentDate'],
                'gender' => ['required'],
                'address' => ['cyrillic','required'],
                'patronymic'=>['cyrillic:students,patronymic']
            ], [
                'required' => 'Поле :field пусто',
                'currentDate'=>'Поле :field некорректно',
                'cyrillic' => 'Поле :field должно содержать только кириллические буквы',
            ]);
            if ($validator->fails()) {
                return new View('employees.add_students',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            $data = $request->all();
            $group = Group::find($data['group_id']);
            if ($group) {
                Student::create([
                    'last_name' => $data['last_name'],
                    'first_name' => $data['name'],
                    'patronymic' => $data['patronymic'],
                    'gender' => $data['gender'],
                    'date' => $data['date'],
                    'address' => $data['address'],
                    'id_group' => $group->id
                ]);
                app()->route->redirect('/students');
            }
        }

        return new View('employees.add_students', ['select_groups' => $select_groups]);
    }

    public function addGroup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:groups_students,name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if ($validator->fails()) {
                return new View('employees.add_group',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if (Group::create($request->all())) {
                app()->route->redirect('/groups');
            }
        }
        return new View('employees.add_group');
    }

    public function addDiscipline(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'cyrillic','unique:disciplines,name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'cyrillic' => 'Поле :field должно содержать только кириллические буквы',
            ]);
            if ($validator->fails()) {
                return new View('employees.add_discipline',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Discipline::create($request->all())) {
                app()->route->redirect('/disciplines');
            }
        }
        return new View('employees.add_discipline');
    }

    public function cabinet(Request $request): string
    {
        $images=Image::all();
        if ($request->method === 'POST') {
            $image = $_FILES['image']['name'];
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/pop-it-mvc/public/image/";
            $uploaded_file = $imagePath . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file);

            if (Image::create([
                'image' => $uploaded_file,
                'name'=>$image])) {
                app()->route->redirect('/cabinet');
            }
        }
        return new View('employees.cabinet',['images'=>$images]);
    }

    public function students(Request $request): string
    {
        $students=Student::all();
        return new View('employees.students', ['students'=>$students]);
    }
    public function groups(Request $request): string
    {
        $groups=Group::all();
        return new View('employees.groups', ['groups'=>$groups]);
    }

    public function disciplines(Request $request): string
    {
        $message = null;
        $disciplines = [];
        if($request->method==='POST'){
            if ($request->get('search')) {
                // Получаем параметр поиска из запроса
                $searchTerm = $request->get('search');

                // Если есть параметр поиска, выполняем поиск
                if ($searchTerm) {
                    // Выполняем поиск дисциплин по имени
                    $disciplines = Discipline::where('name', 'like', '%' . $searchTerm . '%')->get();
                }
                if ($disciplines->isEmpty()) {
                    $message = 'Дисциплины с таким названием отсутствуют';
                }

            }
        }
        else {
            $disciplines = Discipline::all();
        }


        return new View('employees.disciplines', ['disciplines' => $disciplines, 'message' => $message ?? null]);
    }

    public function gradeStudents(Request $request): string
    {
        $groupsGrades = Group::all();
        $disciplinesGrades = Discipline::all();
        // Получаем все оценки со связанными моделями группы, студента и дисциплины
        $gradesQuery = Grade::with('disciplinesGroup.info_group', 'student', 'evaluations');
        if ($request->method === 'POST') {
            if ($request->get('groups')) {
                $groupId = $request->get('groups');
                // Добавляем условие фильтрации по выбранной группе
                $gradesQuery->whereHas('disciplinesGroup.info_group', function ($query) use ($groupId) {
                    $query->where('id', $groupId);
                });
            }
            if ($request->get('disciplines')) {
                $disciplineId = $request->get('disciplines');
                // Добавляем условие фильтрации по выбранной дисциплине
                $gradesQuery->whereHas('disciplinesGroup', function ($query) use ($disciplineId) {
                    $query->where('id_disciplines', $disciplineId);
                });
            }
        }
        $grades = $gradesQuery->get();
        $gradeList = [];
        $notEmpty=false;
        foreach ($grades as $grade) {
            // Если есть оценка, добавляем информацию о студенте, группе, дисциплине и оценке
            if ($grade->evaluations) {
                $studentName = $grade->student->last_name . ' ' . $grade->student->first_name . ' ' . $grade->student->patronymic;
                $groupName = $grade->disciplinesGroup->info_group->name;
                $disciplineName = $grade->disciplinesGroup->discipline->name;
                $evaluation = $grade->evaluations->evaluation;

                $gradeList[] = [
                    'student' => $studentName,
                    'group' => $groupName,
                    'discipline' => $disciplineName,
                    'evaluation' => $evaluation
                ];
                $notEmpty=true;
            }
        }
        if (empty($gradeList)) {
            return new View('employees.gradeStudents', [
                'groupsGrades' => $groupsGrades,
                'disciplinesGrades' => $disciplinesGrades,
                'notEmpty'=>$notEmpty
            ]);
        }
        return new View('employees.gradeStudents', [
            'gradeList' => $gradeList,
            'groupsGrades' => $groupsGrades,
            'disciplinesGrades' => $disciplinesGrades,
            'notEmpty'=>$notEmpty
        ]);
    }
    public function addDisciplineInGroup(Request $request):string
    {
        $groupId = $request->id;
        $discipline_name=Discipline::all();
        $control_name=Control::all();
        $group = DisciplinesGroup::where('id_group', $request->id)->get();
        if ($request->method === 'POST') {
            $data = $request->all();
            $group = Group::find($data['group_id']);
            $id_discipline = Discipline::where('name', $data['discipline_names'])->first();
            $id_control = Control::where('name', $data['control_names'])->first();
            if ($group && $id_control && $id_discipline) {
                DisciplinesGroup::create([
                    'id_group' => $group->id,
                    'id_disciplines' => $id_discipline->id,
                    'id_control' => $id_control->id,
                    'number_hours' => $data['num_hours'],
                    'course' => $data['course'],
                    'semester' => $data['semester']
                ]);
                app()->route->redirect('/groups/group?id='.$group->id);
            }
        }
        $groupName = Group::find($groupId)->name;
        return new View('employees.add_discipline_in_group', ['group' => $group, 'discipline_name'=>$discipline_name,'control_name'=>$control_name, 'groupName' => $groupName, 'groupId' => $groupId, ]);
    }

    public function group(Request $request): string
    {
        $groupId = $request->id;
        $groupName = Group::find($groupId)->name;

        // Запрос на получение списка дисциплин группы с учетом фильтрации
        $group = DisciplinesGroup::where('id_group', $request->id);

        if($request->method === 'POST'){
            $semester = $request->get('semester');
            $course = $request->get('course');
            if (!empty($semester)) {
                $group->where('semester', $semester);
            }
            if (!empty($course)) {
                $group->where('course', $course);
            }

        }
        $group = $group->get();

        return new View('employees.group', [
            'group' => $group,
            'groupName' => $groupName,
            'groupId' => $groupId,
        ]);
    }

    public function studentGrade(Request $request): string
    {
        $studentId = $request->id;
        $studentInfo = Student::find($studentId);
        $studentName = $studentInfo->last_name . ' ' . $studentInfo->first_name . ' ' . $studentInfo->patronymic;
        if ($request->method === 'POST') {

            $controlId = $request->get('control_id');
            $hours = $request->get('hours');

            // Формируем запрос с учетом выбранных фильтров
            $query = Grade::where('id_student', $request->id)
                ->with('student', 'evaluations', 'disciplinesGroup');

            if (!empty($controlId)) {
                $query->whereHas('disciplinesGroup', function ($query) use ($controlId) {
                    $query->where('id_control', $controlId);
                });
            }

            if (!empty($hours)) {
                $query->whereHas('disciplinesGroup', function ($query) use ($hours) {
                    $query->where('number_hours', $hours);
                });
            }
            $studentGrades = $query->get();
            $controls = Control::all();

            if ($studentGrades->isEmpty()) {
                return new View('employees.gradeStudent', [
                    'controls' => $controls,
                    'studentId' => $studentId,
                    'studentName'=>$studentName]);
            }
        } else {
            $studentGrades = Grade::where('id_student', $request->id)
                ->with('student', 'evaluations', 'disciplinesGroup')
                ->get();
        }
        $controls = Control::all();

        return new View('employees.gradeStudent', [
            'studentGrade' => $studentGrades,
            'controls' => $controls,
            'studentId' => $studentId,
            'studentName'=>$studentName
        ]);
    }

    public function evaluations(Request $request): string
    {
        $evaluations = Evaluations::all();
        $studentId = $request->id;
        $studentInfo = Student::find($studentId);
        $studentName = $studentInfo->last_name . ' ' . $studentInfo->first_name . ' ' . $studentInfo->patronymic;
        $groupName = $studentInfo->group->name;
        $groupId = $studentInfo->group->id;
        $disciplinesGroup = DisciplinesGroup::where('id_group', $groupId)->get();

        // Получение оценок студента
        $grades = Grade::where('id_student', $studentId)->get();

        // Проверка наличия оценки у студента по каждой дисциплине
        $hasGrade = [];
        foreach ($disciplinesGroup as $disciplineGroup) {
            $hasGrade[$disciplineGroup->id] = $grades->where('id_disciplines_group', $disciplineGroup->id)->isNotEmpty();
        }

        $date = new DateTime();
        if ($request->method === 'POST') {
            $disciplineGroupId = $request->get('disciplineGroupId');
            $evaluationName = $request->get('evaluationName');
            $selectedEvaluation = Evaluations::where('evaluation', $evaluationName)->first();

            if ($selectedEvaluation) {
                $evaluationId = $selectedEvaluation->id;

                // Проверка, существует ли уже оценка у студента по выбранной дисциплине
                $existingGrade = Grade::where('id_disciplines_group', $disciplineGroupId)
                    ->where('id_student', $studentId);

                if ($existingGrade->exists()) {
                    // Обновление существующей оценки
                    $existingGrade->update([
                        'id_evaluations' => $evaluationId,
                        'date' => $date
                    ]);
                } else {
                    // Создание новой оценки
                    Grade::create([
                        'id_disciplines_group' => $disciplineGroupId,
                        'id_student' => $studentId,
                        'id_evaluations' => $evaluationId,
                        'date' => $date
                    ]);
                }
            }

            app()->route->redirect('/student/grade?id=' . $studentId);
        }

        return new View('employees.evaluations', [
            'disciplinesGroup' => $disciplinesGroup,
            'studentName' => $studentName,
            'groupName' => $groupName,
            'evaluations' => $evaluations,
        ]);
    }


}
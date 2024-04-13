<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id_disciplines_group',
        'id_evaluations',
        'date',
        'id_student',
    ];

    public $table = 'grade';

    public function disciplinesGroup() {
        return $this->belongsTo(DisciplinesGroup::class, 'id_disciplines_group');
    }

    public function student() {
        return $this->belongsTo(Student::class, 'id_student');
    }

    public function evaluations() {
        return $this->belongsTo(Evaluations::class, 'id_evaluations');
    }


}
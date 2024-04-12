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
        'id_control',
        'date',
        'id_student',
    ];

    public $table = 'grade';

}
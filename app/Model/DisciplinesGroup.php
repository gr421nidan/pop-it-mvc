<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinesGroup  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id_group',
        'id_discipline',
        'id_control',
        'number_hours',
        'course',
        'semester'
    ];

    public $table = 'disciplines_group';

}
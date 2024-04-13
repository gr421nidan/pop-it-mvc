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
        'id_disciplines',
        'id_control',
        'number_hours',
        'course',
        'semester'
    ];

    public $table = 'disciplines_group';
    public function discipline() {
        return $this->belongsTo(Discipline::class, 'id_disciplines');
    }

    public function control() {
        return $this->belongsTo(Control::class, 'id_control');
    }

    public function info_group() {
        return $this->belongsTo(Group::class, 'id_group');
    }

}
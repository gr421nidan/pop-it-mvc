<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'evaluations'
    ];

    public $table = 'evaluations';

}
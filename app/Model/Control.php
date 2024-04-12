<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control  extends Model
{
    use HasFactory;

    public $timestamps = false;


    public $table = 'control';

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use function Illuminate\Support\Facades\Request;

class Take extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'takes';



    protected $fillable = [
        'user', 'list', 'exam_shift', 'score', 'status'
    ];
}

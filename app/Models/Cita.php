<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    public $primaryKey='id';

    public function user(){
        return $this->belongsTo('App\models\User');
    }

    public function post(){
        return $this->belongsTo('App\models\Post');
    }
}
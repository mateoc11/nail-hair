<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'likes';

    public $primaryKey='id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\models\User');
    }

    public function post(){
        return $this->belongsTo('App\models\Post');
    }
}

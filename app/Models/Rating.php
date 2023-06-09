<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    public $primaryKey='id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\models\User');
    }

}

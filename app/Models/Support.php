<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $table = 'supports';

    public $primaryKey='id';

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\models\User');
    }

    
}

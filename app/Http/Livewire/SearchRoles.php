<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use App\models\Post;
use App\models\User;
use App\models\Rating;
use App\models\Like;
use App\models\Cita;
use Auth;
use Image;
use Carbon\Carbon;

class SearchRoles extends Component
{
    public $search; 

 
    public function render()
    {
        $search= '%'.$this->search.'%';
        $users=User::where('email', 'like', $search)->orderBy('created_at','desc')->get();
        return view('livewire.search-roles', ['users' => $users]);
    }
}

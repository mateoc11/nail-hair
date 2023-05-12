<?php

namespace App\Http\Livewire;

use Livewire\Component;
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

class SearchUsers extends Component
{
    public $search; 
    public $badReviews=0;
    public $inactive=0;

    public function render()
    {
        $search= '%'.$this->search.'%';
        if($this->inactive == 0){
            $users=User::where('username', 'like', $search)->where('active','yes')->orderBy('created_at','desc')->get();
        }else{
            $users=User::where('username', 'like', $search)->orderBy('created_at','desc')->get();
        }
        if($this->badReviews == 1){
            $users=$users->reject(function ($value) {
                $rating= Rating::select('estrellas')->where('user_id',$value -> id)->where('active','yes')->avg('estrellas'); 
                if($rating > 3 || $rating == 0){
                    return true;
                }
                return false;
            });
        }
        foreach($users as $user){
            $rating= Rating::select('estrellas')->where('user_id',$user -> id)->where('active','yes')->avg('estrellas'); 
            $rating=round($rating,2);
            $user->rating=$rating;
        }
        return view('livewire.search-users', ['users' => $users]);
    }
}

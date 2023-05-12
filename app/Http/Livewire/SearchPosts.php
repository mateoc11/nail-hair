<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\models\Post;
use Carbon\Carbon;


class SearchPosts extends Component
{
    public $search; 
    public $selectedStatus;
    public $selectedOrder;
    public $unactive;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';



    public function updatingSearch()
    {
        $this->resetPage();
    }
 
    public function render()
    {
        $search= '%'.$this->search.'%';
        if($this->unactive==1){
            $posts = Post::where('title', 'like', $search)->where('active','no')
            ->when($this->selectedStatus, function ($query, $selectedStatus) {
                if($this->selectedStatus=='1'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(8), Carbon::now()]);
                }
                if($this->selectedStatus=='2'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(30), Carbon::now()]);
                }
                if($this->selectedStatus=='3'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(15), Carbon::now()]);
                }
                if($this->selectedStatus=='4'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(1), Carbon::now()]);
                }
            })->when($this->selectedOrder, function ($query, $selectedOrder) {
                if($this->selectedOrder=='1'){
                    return $query->orderBy('created_at','asc');
                }
                if($this->selectedOrder=='2'){
                    return $query->orderBy('created_at','desc');
                }
                if($this->selectedOrder=='3'){
                    return $query->orderBy('likes','desc');
                }
                if($this->selectedOrder=='4'){
                    return $query->orderBy('created_at','desc');
                }
            })->paginate(9);
        }

        if($this->unactive==null){
            $posts = Post::where('title', 'like', $search)->where('active','yes')
            ->when($this->selectedStatus, function ($query, $selectedStatus) {
                if($this->selectedStatus=='1'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(8), Carbon::now()]);
                }
                if($this->selectedStatus=='2'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(30), Carbon::now()]);
                }
                if($this->selectedStatus=='3'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(15), Carbon::now()]);
                }
                if($this->selectedStatus=='4'){
                    return $query->whereBetween('created_at', [Carbon::now()->subdays(1), Carbon::now()]);
                }
            })->when($this->selectedOrder, function ($query, $selectedOrder) {
                if($this->selectedOrder=='1'){
                    return $query->orderBy('created_at','asc');
                }
                if($this->selectedOrder=='2'){
                    return $query->orderBy('created_at','desc');
                }
                if($this->selectedOrder=='3'){
                    return $query->orderBy('likes','desc');
                }
                if($this->selectedOrder=='4'){
                    return $query->orderBy('created_at','desc');
                }
            })->paginate(9);
        }


        /*return view('livewire.search-posts', [
            'posts' => Post::where('title', $this->search)->paginate(1),
        ]);*/
        return view('livewire.search-posts', ['posts' => $posts]);   
        /*return view('livewire.search-posts', [
            'posts' => Post::where('active', 'yes')->paginate(2),
        ]);*/

    }
}

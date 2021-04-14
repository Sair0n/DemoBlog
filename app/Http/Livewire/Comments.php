<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class Comments extends Component
{
    public $post_id;
    public $comments;
    public $newComment;

    public function addComment(){
        Comment::create([
            'text' => $this->newComment,
            'user_id' => auth()->user()->id,
            'post_id' => $this->post_id,
        ]);
    }

    public function render(){
        $this->comments = Comment::where('post_id', $this->post_id)->with('user')->get();
        return view('livewire.comments');
    }
}

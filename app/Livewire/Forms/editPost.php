<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class editPost extends Form
{
    public $Id;
    #[Validate('required',message:'Ta vacio wey')]
    public $title;
    #[Validate('required',message:'Ta vacio wey')]
    public $content;
    public $image ;
    public function updatePost()
    {
        $post = Post::find($this->Id);
        $post->update([
            "title"=>$this->title,
            "content"=>$this->content,
            "image"=>$this->image,
        ]);
    }
}

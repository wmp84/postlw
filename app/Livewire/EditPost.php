<?php

namespace App\Livewire;

use App\Livewire\Forms\editPost as FormsEditPost;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $post, $image, $identificador;
    public FormsEditPost $postEdit;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->postEdit->Id = $this->post->id;
        $this->postEdit->title = $this->post->title;
        $this->postEdit->content = $this->post->content;
        $this->postEdit->image = $this->post->image;
    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function save()
    {
        if ($this->image) {
            if (Storage::disk('public')->exists($this->postEdit->image)) {
                Storage::disk('public')->delete($this->postEdit->image);
            }
            $this->postEdit->image = $this->image->store('posts', 'public');
        }
        $this->validate();
        $this->postEdit->updatePost();
        $this->reset('open','image');
        $this->dispatch('sav');
        $this->dispatch('alert', 'Post actualizado');
    }
}

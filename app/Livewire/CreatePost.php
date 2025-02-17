<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $title, $content, $image, $identificador;

    public function mount()
    {
        $this->identificador = rand();
    }

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];

    public function save()
    {

        $this->validate();
        $image = $this->image->store('posts', 'public');
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);
        $this->reset(['open', 'title', 'content', 'image']);
        $this->dispatch('sav');
        $this->dispatch('alert', 'Post creado');
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function updatingOpen()
    {
        if ($this->open) {
            $this->reset(['content', 'title', 'image']);
        }
    }
}

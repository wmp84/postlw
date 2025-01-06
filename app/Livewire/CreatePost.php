<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;
    public $title, $content;
    protected $rules = [
        'title' => 'required|max:20',
        'content' => 'required|min:10'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function save()
    {
        $this->validate();
        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);
        $this->reset(['open', 'title', 'content']);
        $this->dispatch('sav');
        $this->dispatch('alert', 'Post creado');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}

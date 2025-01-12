<?php

namespace App\Livewire;

use App\Livewire\Forms\editPost as FormsEditPost;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $post, $image;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = 10;
    public $open_edit = false;
    protected $queryString = [
        'cant' => ['except' => 10],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];
    public FormsEditPost $postEdit;

    public function mount()
    {
        $this->post = new Post();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On("sav")]
    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'desc';
        }
    }

    public function mostrar()
    {
    }

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->postEdit->Id = $this->post->id;
        $this->postEdit->title = $this->post->title;
        $this->postEdit->content = $this->post->content;
        $this->postEdit->image = $this->post->image;
        $this->open_edit = true;
    }

    public function saveUpdate()
    {
        $this->validate();
        if ($this->image) {
            if (Storage::disk('public')->exists($this->postEdit->image)) {
                Storage::disk('public')->delete($this->postEdit->image);
            }
            $this->postEdit->image = $this->image->store('posts', 'public');
        }
        $this->postEdit->updatePost();
        $this->reset('open_edit', 'image');
        $this->dispatch('alert', 'Post actualizado');
    }
}

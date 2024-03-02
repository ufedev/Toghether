<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;


class LikePost extends Component
{

    public Post $post;
    public bool $isLiked;
    public int $likes;

    public function mount($post)
    {
        if (auth()->user())
            $this->isLiked = $post->checkLikes(auth()->user());


        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if ($this->post->checkLikes(auth()->user())) {
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}

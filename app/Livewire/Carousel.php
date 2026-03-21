<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Media;


class Carousel extends Component
{

    public $slides = [];
    public $current =0;

    public function mount()
    {
        $this->loadSlides();
    }


    public function loadSlides()
    {
        $this->slides = Media::where('show_in_carousel', true)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
        if($this->current >= count($this->slides)) {
            $this->current = 0;
        }
    }

    public function next()
    {
        if (count($this->slides) > 0) {
            $this->current = ($this->current + 1) % count($this->slides);
        }
    }

     public function previous()
    {
        if (count($this->slides) > 0) {
            $this->current = ($this->current - 1 + count($this->slides)) % count($this->slides);
        }
    }
    public function render()
    {
        return view('livewire.carousel');
    }
}

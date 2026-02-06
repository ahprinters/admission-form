<?php

namespace App\Livewire;

use App\Models\Notice;
use App\Models\Slider;
use Livewire\Component;
use App\Models\QuickLink;
use Livewire\Attributes\Layout;

class HomePage extends Component
{
    #[Layout('components.layouts.app')]
    public $notices;
    public $sliders;
    public $quickLinks;

    public function mount()
    {
        // Marquee Notices
        $this->notices = Notice::where('status', 1)
            ->latest()
            ->take(5)
            ->get();

        // Slider Images
        $this->sliders = Slider::where('status', 1)
            ->orderBy('position', 'asc')
            ->get();

        // Quick Action Links
        $this->quickLinks = QuickLink::where('status', 1)
            ->orderBy('position', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.home-page')
            ->layout('layouts.app');
    }
}

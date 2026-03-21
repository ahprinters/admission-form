<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Media;

class Gallery extends Component
{
    public function render()
    {
        $galleryImages = Media::where('show_in_gallery', true)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('livewire.gallery', [
            'galleryImages' => $galleryImages,
        ]);
    }
}

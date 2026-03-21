<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaManager extends Component
{
    use WithFileUploads;

    public $image;
    public $title;
    public $show_in_carousel = true;
    public $show_in_gallery = true;
    public $sort_order = 0;
    public $is_active = true;

    public $editId = null;
    public $existingImage = null;

    public function save()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $this->image->store('media', 'public');

        Media::create([
            'title' => $this->title,
            'image_path' => $path,
            'show_in_carousel' => $this->show_in_carousel,
            'show_in_gallery' => $this->show_in_gallery,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ]);

        $this->resetForm();

        session()->flash('success', 'Image uploaded successfully.');
    }

    public function edit($id)
    {
        $item = Media::findOrFail($id);

        $this->editId = $item->id;
        $this->title = $item->title;
        $this->show_in_carousel = $item->show_in_carousel;
        $this->show_in_gallery = $item->show_in_gallery;
        $this->sort_order = $item->sort_order;
        $this->is_active = $item->is_active;
        $this->existingImage = $item->image_path;
    }

    public function update()
    {
        $item = Media::findOrFail($this->editId);

        $this->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $item->image_path;

        if ($this->image) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }

            $path = $this->image->store('media', 'public');
        }

        $item->update([
            'title' => $this->title,
            'image_path' => $path,
            'show_in_carousel' => $this->show_in_carousel,
            'show_in_gallery' => $this->show_in_gallery,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ]);

        $this->resetForm();

        session()->flash('success', 'Image updated successfully.');
    }

    public function delete($id)
    {
        $item = Media::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        session()->flash('success', 'Image deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset([
            'image',
            'title',
            'show_in_carousel',
            'show_in_gallery',
            'sort_order',
            'is_active',
            'editId',
            'existingImage',
        ]);

        $this->show_in_carousel = true;
        $this->show_in_gallery = true;
        $this->sort_order = 0;
        $this->is_active = true;
    }

    public function render()
    {
        return view('livewire.admin.media-manager', [
            'items' => Media::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }
}

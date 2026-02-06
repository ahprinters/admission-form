<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Marquee;

class MarqueeManager extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // Form fields
    public $marqueeId = null;
    public $title = '';
    public $message = '';
    public $status = true;
    public $position = 0;
    public $starts_at = null;
    public $ends_at = null;

    public $isModalOpen = false;

    protected function rules()
    {
        return [
            'title'     => ['nullable', 'string', 'max:255'],
            'message'   => ['required', 'string', 'min:3'],
            'status'    => ['boolean'],
            'position'  => ['integer', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at'   => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function openEdit(int $id)
    {
        $m = Marquee::findOrFail($id);

        $this->marqueeId = $m->id;
        $this->title = $m->title ?? '';
        $this->message = $m->message;
        $this->status = (bool) $m->status;
        $this->position = (int) $m->position;
        $this->starts_at = optional($m->starts_at)->format('Y-m-d\TH:i');
        $this->ends_at = optional($m->ends_at)->format('Y-m-d\TH:i');

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $data = $this->validate();

        // datetime-local -> proper format
        $data['starts_at'] = $this->starts_at ? date('Y-m-d H:i:s', strtotime($this->starts_at)) : null;
        $data['ends_at']   = $this->ends_at ? date('Y-m-d H:i:s', strtotime($this->ends_at)) : null;

        if ($this->marqueeId) {
            Marquee::where('id', $this->marqueeId)->update($data);
            session()->flash('success', 'Marquee আপডেট হয়েছে ✅');
        } else {
            // default position if not set
            if ((int)$data['position'] === 0) {
                $max = (int) Marquee::max('position');
                $data['position'] = $max + 1;
            }
            Marquee::create($data);
            session()->flash('success', 'Marquee যোগ হয়েছে ✅');
        }

        $this->closeModal();
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['marqueeId','title','message','status','position','starts_at','ends_at']);
        $this->status = true;
        $this->position = 0;
    }

    public function delete(int $id)
    {
        Marquee::where('id', $id)->delete();
        session()->flash('success', 'Marquee ডিলিট হয়েছে 🗑️');
    }

    public function toggleStatus(int $id)
    {
        $m = Marquee::findOrFail($id);
        $m->update(['status' => !$m->status]);
    }

    public function moveUp(int $id)
    {
        $m = Marquee::findOrFail($id);

        $prev = Marquee::where('position', '<', $m->position)
            ->orderBy('position', 'desc')
            ->first();

        if (!$prev) return;

        $currentPos = $m->position;
        $m->update(['position' => $prev->position]);
        $prev->update(['position' => $currentPos]);
    }

    public function moveDown(int $id)
    {
        $m = Marquee::findOrFail($id);

        $next = Marquee::where('position', '>', $m->position)
            ->orderBy('position', 'asc')
            ->first();

        if (!$next) return;

        $currentPos = $m->position;
        $m->update(['position' => $next->position]);
        $next->update(['position' => $currentPos]);
    }

    public function updateOrder($orderedIds): void
    {
        // $orderedIds = [12, 5, 9, ...] (drag-drop এর পর নতুন সিরিয়াল)

        foreach ($orderedIds as $index => $id) {
            \App\Models\Marquee::where('id', $id)->update([
                'position' => $index + 1,
            ]);
        }

        session()->flash('success', 'Order আপডেট হয়েছে ✅');
    }


    public function render()
    {
        $items = Marquee::query()
            ->when($this->search, function ($q) {
                $q->where('message', 'like', '%'.$this->search.'%')
                  ->orWhere('title', 'like', '%'.$this->search.'%');
            })
            ->orderBy('position', 'asc')
            ->latest('id')
            ->paginate($this->perPage);

        return view('livewire.admin.marquee-manager', compact('items'));
    }
}

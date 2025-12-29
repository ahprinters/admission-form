<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Livewire\WithPagination;

class StudentList extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';
    public int $perPage = 10;

    // search change হলে page reset
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $student = Student::find($id);

        if (! $student) {
            session()->flash('message', 'শিক্ষার্থী পাওয়া যায়নি।');
            return;
        }

        // Optional: submitted হলে delete বন্ধ
        if ($student->status === 'submitted') {
            session()->flash('message', 'Submitted শিক্ষার্থী ডিলিট করা যাবে না।');
            return;
        }

        $student->delete();

        session()->flash('message', 'শিক্ষার্থীর তথ্য মুছে ফেলা হয়েছে।');

        // page empty হলে আগের page এ
        if ($this->page > 1 && $this->getStudentsQuery()->paginate($this->perPage)->count() === 0) {
            $this->previousPage();
        }
    }

    private function getStudentsQuery()
    {
        $q = Student::query()->latest();

        if (trim($this->search) !== '') {
            $s = trim($this->search);
            $q->where(function ($qq) use ($s) {
                $qq->where('name_en', 'like', "%{$s}%")
                   ->orWhere('name_bn', 'like', "%{$s}%")
                   ->orWhere('email', 'like', "%{$s}%")
                   ->orWhere('phone', 'like', "%{$s}%")
                   ->orWhere('roll_number', 'like', "%{$s}%")
                   ->orWhere('class', 'like', "%{$s}%");
            });
        }

        return $q;
    }

    public function render()
    {
        return view('livewire.student-list', [
            'students' => $this->getStudentsQuery()->paginate($this->perPage),
        ])->layout('components.layouts.admin');
    }
}

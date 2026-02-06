<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Marquee as MarqueeModel;

class Marquee extends Component
{
    public string $text;

    public function __construct(
        public int $limit = 10,
        public string $separator = ' | ',
        public string $direction = 'left',
        public string $behavior = 'scroll',
        public int $speed = 6 // smaller = faster in marquee (browser dependent)
    ) {
        $items = MarqueeModel::query()
            ->active()
            ->orderBy('position', 'asc')
            ->latest('id')
            ->limit($this->limit)
            ->pluck('message')
            ->filter()
            ->map(fn ($m) => trim($m))
            ->values();

        $this->text = $items->isNotEmpty()
            ? $items->implode($this->separator)
            : '';
    }

    public function render(): View|Closure|string
    {
        return view('components.marquee');
    }
}

<?php

namespace App\Support;

use Illuminate\View\ComponentAttributeBag;

class FormField
{
    public static function make(
        string $name,
        ComponentAttributeBag $attributes,
        ?string $model = null,
        string $wire = 'defer',
        bool $hasIcon = false
    ): array {
        $id = str_replace(['.', '[', ']'], '-', $name);
        $modelName = $model ?: $name;

        // parent থেকে wire:model* থাকলে default binding বসাব না
        $wireModelAttr = collect($attributes->getAttributes())
            ->keys()
            ->first(fn ($k) => str_starts_with($k, 'wire:model'));

        $wire = in_array($wire, ['defer', 'live', 'lazy', 'blur'], true) ? $wire : 'defer';
        $defaultWireDirective = $wire === 'defer' ? 'wire:model.defer' : "wire:model.$wire";

        // === UI TOKENS (Design System) ===
        $labelClass = 'block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5';
        $hintClass  = 'mt-1 text-xs text-slate-500 dark:text-slate-400';
        $wrapClass  = 'w-full';

        $base = 'block w-full rounded-xl px-3 py-2 border transition shadow-sm '
              . 'focus:outline-none focus:ring-2 disabled:opacity-60 disabled:cursor-not-allowed';

        $padding = $hasIcon ? 'pl-10 pr-3' : '';
        $colors  = 'bg-white text-slate-900 border-slate-300 placeholder-slate-400 '
                 . 'dark:bg-slate-900 dark:text-slate-100 dark:border-slate-700 dark:placeholder-slate-500';

        return [
            'id' => $id,
            'modelName' => $modelName,
            'wireModelAttr' => $wireModelAttr,
            'defaultWireDirective' => $defaultWireDirective,

            // classes
            'wrapClass' => $wrapClass,
            'labelClass' => $labelClass,
            'hintClass' => $hintClass,
            'baseControlClass' => trim($base.' '.$padding.' '.$colors),
        ];
    }

    public static function stateClass(bool $hasError): string
    {
        return $hasError
            ? 'border-red-300 focus:ring-red-500 focus:border-red-500'
            : 'focus:ring-indigo-500 focus:border-indigo-500';
    }

    // textarea / select এর extra class গুলো এখানে দিতে পারেন
    public static function extra(string $kind): string
    {
        return match ($kind) {
            'textarea' => 'resize-y min-h-[96px]',
            'select'   => 'appearance-none',
            default    => '',
        };
    }
}

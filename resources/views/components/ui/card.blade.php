<div {{ $attributes->merge([
'class' => 'w-full max-w-md backdrop-blur-xl bg-white/70 dark:bg-gray-900/70
            border border-white/20 shadow-2xl rounded-2xl p-8 transition'
]) }}>
    {{ $slot }}
</div>

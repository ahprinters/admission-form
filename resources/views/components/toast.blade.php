<div
    x-data="{
        show: false,
        message: '',
        type: 'success',
        timer: 3000,

        // progress: 0 থেকে 100
        progress: 100,
        _timeout: null,
        _raf: null,
        _start: null,

        showToast(event) {
            const d = event.detail || {};

            this.message = d.message || '';
            this.type = d.type || 'success';
            this.timer = d.timer ?? 3000;

            // reset
            this.show = true;
            this.progress = 100;
            this._start = performance.now();

            // clear old timers/animations
            if (this._timeout) clearTimeout(this._timeout);
            if (this._raf) cancelAnimationFrame(this._raf);

            // auto hide
            this._timeout = setTimeout(() => {
                this.show = false;
            }, this.timer);

            // progress animation
            const tick = (now) => {
                const elapsed = now - this._start;
                const pct = 100 - (elapsed / this.timer) * 100;
                this.progress = Math.max(0, Math.min(100, pct));

                if (this.show && elapsed < this.timer) {
                    this._raf = requestAnimationFrame(tick);
                }
            };

            this._raf = requestAnimationFrame(tick);
        },

        close() {
            this.show = false;
            if (this._timeout) clearTimeout(this._timeout);
            if (this._raf) cancelAnimationFrame(this._raf);
        }
    }"
    x-on:toast.window="showToast($event)"
    x-show="show"
    x-transition.opacity.duration.250ms
    class="fixed top-6 right-6 z-50 w-[92vw] max-w-sm"
    style="display: none;"
>
    <div
        class="overflow-hidden rounded-xl shadow-lg border"
        :class="{
            'bg-white border-green-200': type === 'success',
            'bg-white border-red-200': type === 'error',
            'bg-white border-blue-200': type === 'info',
            'bg-white border-yellow-200': type === 'warning'
        }"
    >
        <div class="flex items-start gap-3 px-4 py-3">
            <!-- Dot/Icon -->
            <div
                class="mt-1 h-2.5 w-2.5 rounded-full shrink-0"
                :class="{
                    'bg-green-600': type === 'success',
                    'bg-red-600': type === 'error',
                    'bg-blue-600': type === 'info',
                    'bg-yellow-500': type === 'warning'
                }"
            ></div>

            <div class="flex-1">
                <div class="text-sm font-medium text-slate-900" x-text="message"></div>
            </div>

            <!-- Close button -->
            <button
                type="button"
                class="text-slate-400 hover:text-slate-700 transition"
                @click="close()"
                aria-label="Close"
            >
                ✕
            </button>
        </div>

        <!-- Progress bar -->
        <div class="h-1 w-full bg-slate-100">
            <div
                class="h-1 transition-[width] duration-75"
                :class="{
                    'bg-green-600': type === 'success',
                    'bg-red-600': type === 'error',
                    'bg-blue-600': type === 'info',
                    'bg-yellow-500': type === 'warning'
                }"
                :style="`width: ${progress}%;`"
            ></div>
        </div>
    </div>
</div>

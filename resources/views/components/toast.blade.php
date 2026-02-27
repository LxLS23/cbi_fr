@props(['type' => 'success', 'message' => ''])

@php
    $colors = [
        'success' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
        'error' => 'bg-rose-50 text-rose-600 border-rose-100',
        'warning' => 'bg-amber-50 text-amber-600 border-amber-100',
    ];
    
    $icons = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
    ];
@endphp

<div id="toast-{{ uniqid() }}" class="flex items-center w-full max-w-xs p-4 rounded-2xl shadow-xl shadow-slate-200/50 border {{ $colors[$type] }} transition-all duration-300 transform translate-y-0" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $icons[$type] !!}
        </svg>
    </div>
    <div class="ms-3 text-sm font-semibold tracking-tight">{{ $message }}</div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-transparent p-1.5 hover:bg-slate-100 rounded-lg inline-flex items-center justify-center h-8 w-8 transition-colors" data-dismiss-target="#toast-{{ $loop->index ?? 0 }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<script>
    setTimeout(() => {
        const toast = document.querySelector('[role="alert"]');
        if (toast) {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }
    }, 4000);
</script>

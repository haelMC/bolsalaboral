@props(['href', 'text', 'icon' => null]) <!-- Hacemos que $icon sea opcional -->

<a href="{{ $href }}" class="group flex items-center space-x-2 px-5 py-0.5 text-sm font-medium active:bg-gray-50 text-gray-700 hover:text-gray-500">
    <span class="flex flex-none items-center opacity-75">
        @if ($icon)
            <div class="hi-outline hi-home inline-block h-6 w-6 text-[#0b4558]">
                {!! $icon !!} <!-- Aquí utilizamos $icon si está definido -->
            </div>
        @endif
    </span>
    <span class="grow py-2 font-bold capitalize">{{ $text }}</span>
</a>

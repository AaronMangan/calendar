@props(
    [
        'model' => null,
        'enabled' => null,
        'label' => null,
    ]
)
<label class="inline-flex items-center cursor-pointer">
    <input
        type="checkbox"
        wire:model.live="{{ $model }}"
        class="sr-only peer"
        :checked="$model"
    >

    <div
        class="
            relative w-11 h-6 bg-gray-200 rounded-full flex-row-reverse
            peer peer-checked:bg-purple-600
            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
            after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all
            peer-checked:after:translate-x-full
        "
    ></div>

    <span class="ml-3 text-sm text-gray-700">
        {{ $label ?? null }}
    </span>
</label>

@props([
    'name' => null,
    'class' => null,
    'label' => null,
    'parentClass' => null,
    'options' => [],
    'xModel' => null,
])
<div class="{{ $parentClass }}">
    <label for="{{ $name }}">{{ $label ?? 'Select:' }}</label>
    <select wire:model="{{ $xModel }}" class="{{ $class }}" name="{{ $name }}" type="select">
        @if (is_array($options))
            @foreach ($options as $option)
                <option id="{{ $option['id'] }}" name="{{ $option['id'] }}">{{ $option['name'] }}</option>    
            @endforeach
        @else
            <option id="select" name="select-option">Please Select...</option>
        @endif
    </select>
</div>
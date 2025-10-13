@props(['placeholder' => null, 'label' => null])
<label class=" text-sm font-medium text-gray-700">
    {{ $label }}
</label>
<input {{ $attributes->merge([
    'class' => 'input w-full',
]) }} placeholder={{ $placeholder }} required />

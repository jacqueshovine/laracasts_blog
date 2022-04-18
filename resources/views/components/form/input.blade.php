@props([
    'name', 
    'type' => 'text', 
    'placeholder' => '', 
    'autocomplete' => '',
    'value' => old($name),
])
<x-form.field>
    <x-form.label name="{{ $name }}"/>

    <input class="border border-gray-200 p-2 w-full"
           type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ $value }}"
           placeholder="{{ $placeholder }}"
           required
           autocomplete="{{ $autocomplete }}""
    >

    <x-form.error name="{{ $name }}"/>
</x-form.field>
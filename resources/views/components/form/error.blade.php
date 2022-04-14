@props(['name'])

@error($name)
<!-- $message contains the validation error message -->
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
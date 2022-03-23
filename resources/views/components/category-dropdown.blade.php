<div>
    <x-dropdown>
        <x-slot name="trigger">
            <button 
                class="py-2 pl-3 pr-9 text-sm font-semibold lg:w-32 text-left flex lg:inline-flex">
                
                {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
        
                <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"></x-icon>
            </button>
        </x-slot>
        {{-- <x-dropdown-item href="/">All</x-dropdown-item> --}}
        <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" 
                         :active="request()->routeIs('home')">All
        </x-dropdown-item>

        @foreach($categories as $category)
        <x-dropdown-item 
            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
            :active="isset($currentCategory) && $currentCategory->is($category)"
        >{{ ucwords($category->name )}}</x-dropdown-item>

            {{-- {{ isset($currentCategory) && $currentCategory->is($category) ? 'bg-blue-300 text-white' : '' }}"> --}}
        @endforeach
    </x-dropdown>
</div>

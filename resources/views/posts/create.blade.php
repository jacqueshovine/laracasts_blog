<x-layout>
    <x-setting heading="Publish New Post">
        <!-- enctype needs to be specified if we upload files through the form -->
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title"/>
            <x-form.input name="slug"/>
            <x-form.input name="thumbnail" type="file"/>
            <x-form.input name="thumbnail_alt" placeholder="A short description for the thumbnail image"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>

            <x-form.field>
                <x-form.label name="category"/>

                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ ucwords($category->name) }}</option>
                    @endforeach

                </select>

                <x-form.error name="category"/>
            </x-form.field>

            <x-form.submit-button>Publish</x-form.submit-button>
            </div>
        </form>
    </x-setting>
</x-layout>
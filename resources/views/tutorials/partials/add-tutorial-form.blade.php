<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Tutorial') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Use this form to add a new tutorial.') }}
        </p>
    </header>
    <form method="post" action="{{ route('tutorials.create') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input required id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="title"
                          placeholder="Title of the tutorial"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="download_url" :value="__('Download Link')"/>
            <x-text-input required id="download_url" name="download_url" type="text" class="mt-1 block w-full"
                          autocomplete="download_url"
                          placeholder="Download address of the tutorial"/>
            <x-input-error :messages="$errors->get('download_url')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="thumbnail_url" :value="__('Thumbnail Link')"/>
            <x-text-input id="thumbnail_url" name="thumbnail_url" type="text" class="mt-1 block w-full"
                          autocomplete="thumbnail_url"
                          placeholder="Optional thumbnail image"/>
            <x-input-error :messages="$errors->get('thumbnail_url')" class="mt-2"/>
        </div>

        <div>
            <x-bladewind.checkbox
                value="1"
                name="google_drive"
                label="Files are uploaded on google drive"
                checked="true"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add') }}</x-primary-button>

            @if (session('status') === 'tutorial-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-gray-400"
                >{{ __('New Tutorial Added.') }}</p>
            @endif
        </div>
    </form>
</section>

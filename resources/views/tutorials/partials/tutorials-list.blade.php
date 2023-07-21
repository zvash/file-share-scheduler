<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('All Tutorials') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('To download any of these videos click on it.') }}
        </p>
    </header>
    <div class="flex flex-wrap p-2">
        @foreach($tutorials as $tutorial)
            <a target="_blank" href="{{ $tutorial['url'] }}" class="flex">
                <x-bladewind.card class="!bg-gray-200 p-1 mb-2 ml-1 mr-1">
                    <x-slot name="header">
                        <div class="flex px-4 pt-2 pb-3">
                            <x-bladewind.icon name="video-camera" class="h-8 w-8...k"/>
                            <div class="pl-2 pt-1">
                                <span class="block... mt-3">{{ $tutorial['title'] }}</span>
                            </div>
                        </div>

                    </x-slot>

                    <img class="object-cover h-48"
                         src="{{ $tutorial['thumbnail_url'] ? $tutorial['thumbnail_url'] : '/storage/images/video-stub.jpg' }}"/>

                    <x-slot name="footer">
                        <div class="flex space-x-4 justify-between">
                            <div class="pl-2 pt-1">
                                <span class="mt-3">{{ $tutorial['size'] }}</span>
                            </div>

                            <x-bladewind.icon name="arrow-down-circle" class="h-8 w-8...k"/>
                        </div>
                    </x-slot>
                </x-bladewind.card>
            </a>
        @endforeach
    </div>
</section>

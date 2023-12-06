<x-page title="Welcome to Pulsara">
    <section>
        <x-container>
            <ul wire:poll class="list-none">
                @foreach($posts as $post)
                    <li>
                        <article class="">
                            <div class="flex flex-shrink-0 p-4 pb-0">
                                <a class="flex-shrink-0 group block">
                                    <div class="flex items-center">
                                        <div>
                                            <x-avatar
                                                src="{{ $post->profile->user->avatar }}"
                                                alt="{{ $post->profile->handle }} Avatar"
                                            />
                                        </div>
                                        <div class="ml-3">
                                            <x-p class="flex flex-col items-start justify-center">
                                                <span>
                                                    {{ $post->profile->user->first_name }} {{ $post->profile->user->last_name }}
                                                </span>
                                                <span class="text-sm leading-5 font-bold">
                                                    {{ '@' . $post->profile->handle }} | {{ $post->published_at?->diffForHumans() }}
                                                </span>
                                            </x-p>
                                        </div>
                                    </div>
                                </a>
                            </div>


                            <div class="pl-16">
                                <div>
                                    {!! str($post->content)->limit(200) !!}
                                </div>

                                <div class="flex items-center py-4">
                                    <div class="flex-1 flex items-center text-xs hover:text-blue-400 transition duration-350 ease-in-out">
                                        <x-icons.comment
                                            class="w-5 h-5 mr-2"
                                        />
                                        12.3 k
                                    </div>
                                    <div class="flex-1 flex items-center text-xs hover:text-red-600 transition duration-350 ease-in-out">
                                        <x-icons.heart
                                            class="w-5 h-5 mr-2"
                                        />
                                        14 k
                                    </div>
                                    <div class="flex-1 flex items-center  text-xs hover:text-blue-400 transition duration-350 ease-in-out">
                                        <x-icons.share
                                            class="w-5 h-5 mr-2"
                                        />
                                    </div>
                                </div>

                            </div>
                            <hr class="border-gray-800">
                        </article>
                    </li>
                @endforeach
            </ul>

            <div>
                {{ $posts->links() }}
            </div>
        </x-container>
    </section>
</x-page>

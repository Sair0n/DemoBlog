<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-wrap -m-4">

                @foreach($posts as $post)

                <div class="p-4 md:w-1/3">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        @if($post->img)
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="images/{{$post->img}}" alt="blog">
                        @endif
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$post->title}}</h1>
                            <p class="leading-relaxed mb-3">{{$post->desc}}</p>
                            <div class="flex items-center flex-wrap ">
                                <a href="{{route('posts.show',$post->id)}}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Подробнее
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <span class="text-gray-400 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-1 py-1">
                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                </svg> {{$post->comments->count()}}
              </span>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach




            </div>
            {{ $posts->links() }}
        </div>
    </section>

</x-app-layout>

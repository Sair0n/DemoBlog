<x-app-layout>
    <!-- component -->
    <div class="max-w-screen-lg mx-auto">

        <main class="mt-10">

            <div class="mb-4 md:mb-0 w-full mx-auto relative">
                <div class="px-4 lg:px-0">
                    <h2 class="text-4xl font-semibold text-gray-800 leading-tight">
                        {{$post->title}}
                    </h2>
                @if(auth()->user()->id == $post->user_id)
                    <a href="{{route('posts.edit', $post->id)}}" class="py-2 text-green-700 inline-flex items-center justify-center mb-2">
                        Редактировать
                    </a>
                @endif
                </div>
                    @if($post->img)
                     <img src="{{ asset('/images').'/'.$post->img }}" class="object-cover lg:rounded" style="height: 28em;"/>
                    @endif
            </div>

            <div class="flex flex-col lg:flex-row lg:space-x-12">

                <div class="px-4 lg:px-0 mt-12 text-gray-700 text-lg leading-relaxed w-full ">
                    <p class="pb-6">{{$post->text}}</p>

                </div>



            </div>
        </main>
        <!-- main ends here -->

        <!-- footer -->
        <div class="border-t mt-12 pt-6 pb-6 px-4 lg:px-0"></div>

        <!-- component -->

        <div>

            <section class="rounded-b-lg  mt-4 ">

                @livewire('comments',['post_id' => $post->id])

            </section>

        </div>


    </div>
</x-app-layout>

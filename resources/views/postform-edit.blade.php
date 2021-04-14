<x-app-layout>
    <!-- component -->
    <div class="heading text-center font-bold text-2xl m-5 text-gray-800">Редактирование поста</div>
    <style>
        body {background:white !important;}
    </style>
    <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">

            @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <input name="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" value="{{$post->title}}" maxlength="255" type="text">

            @error('text')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <textarea name="text" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" maxlength="10000">{{$post->text}}</textarea>

            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
                <label>
                    <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                    <input type="file" name="img" class="hidden">
                </label>

                @error('img')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div class="count ml-auto text-gray-400 text-xs font-semibold">Максимум 10000 символов</div>
            </div>
            <!-- buttons -->
            <div class="buttons flex">
                    <button type="submit" class="btn border border-indigo-500 p-1 px-8 font-semibold cursor-pointer text-gray-100 ml-auto bg-indigo-500">Post</button>
            </div>

      </div>

    </form>
    <form method="post" class="text-center m-5" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn border border-red-500 p-1 px-10 font-semibold cursor-pointer text-gray-100 ml-auto bg-red-500">Delete</button>
    </form>


</x-app-layout>

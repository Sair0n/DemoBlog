<div>
    @if($comments->count() > 0)
        <div id="task-comments" class="pt-4">


            @foreach($comments as $comment)

                <div class="bg-white rounded-lg p-3  flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                    <div class="flex flex-row justify-center mr-2">

                        <img alt="{{$comment->user->name}}" width="48" height="48" class="rounded-full w-10 h-10 mr-4 shadow-lg mb-4" src="{{$comment->user->profile_photo_url}}">

                        <h3 class="text-purple-600 font-semibold text-lg text-center md:text-left ">{{$comment->user->name}}</h3>
                    </div>

                    <p style="width: 90%" class="text-gray-600 text-lg text-center md:text-left ">{{$comment->text}}</p>

                </div>

            @endforeach


        </div>
    @endif


    <form wire:submit.prevent="addComment" class="pb-9">

        <input type="text"
               wire:model.defer="newComment"
               class="w-full shadow-inner p-4 border-0 mb-4 rounded-lg focus:shadow-outline text-2xl" placeholder="Ask questions here." cols="6" rows="6" id="comment_content" spellcheck="false">

        <button type="submit" class="font-bold py-2 px-4 w-full bg-purple-400 text-lg text-white shadow-md rounded-lg ">Comment </button>
    </form>





</div>

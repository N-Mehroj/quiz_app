<h1 class="text-center text-3xl text-orange-500">Your Result: {{ $resault['percent'] }}</h1>
@foreach ($resault as $key => $quiz)
    @if (gettype($key) == 'integer')
        @if ($quiz['correct_class'] != 1)
            <div class="border-2 rounded-md flex flex-col items-center gap-2 my-5 border-red-500">
                <h1 class="text-center text-xl">{{ $quiz['question'] }}</h1>
                <h1 class="text-center">{{ $quiz['correct'] }}</h1>
            </div>
        @else
            <div class="border-2 rounded-md flex flex-col items-center gap-2 my-5 border-green-500">
                <h1 class="text-center text-xl">{{ $quiz['question'] }}</h1>
                <h1 class="text-center">{{ $quiz['correct'] }}</h1>
            </div>
        @endif
    @endif
@endforeach
<form action="/result/export/" method="get">
    <input type="hidden" name="room_id" placeholder="Room Id" class="px-4 py-3 rounded-md" required value="{{ $roomid }}">
    <button type="submit" class="px-5 py-2 bg-green-500 rounded-lg">Get Result</button>
</form>

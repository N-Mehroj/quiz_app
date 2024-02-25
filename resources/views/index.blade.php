@extends('main')

@section('body')
    @if (!session('idTest'))
        <a href="/test_info" class="bg-blue-500 text-white font-mono rounded-lg px-5 py-3">Create Test information</a>
    @else
        <a href="/admin" class="bg-blue-500 text-white font-mono rounded-lg px-5 py-3">Create Test information</a>
    @endif

    <div class="flex justify-center items-center h-screen w-full">
        <form method="get" action="/login_quiz">

            <h1 class="text-center font-extrabold text-3xl mb-5" id="inner">Join Test</h1>
            <div class="flex flex-col px-10 py-8 bg-blue-500 gap-10 rounded-lg">
                {{-- <input type="text" name="name" placeholder="Your Name"  class="px-4 py-3 rounded-md" required> --}}
                <input type="text" name="room_id" placeholder="Room Id" class="px-4 py-3 rounded-md" required>
                <button type="submit" class="bg-white px-4 py-2 rounded-md">Submit</button>
            </div>
        </form>
    </div>
@endsection

@extends('main')

@section('body')
    <div class="flex justify-center items-center h-screen w-full">
        <form method="post">
            @csrf
            <h1 class="text-center font-extrabold text-3xl mb-5">Join Test</h1>
            <div class="flex flex-col px-10 py-8 bg-blue-500 gap-10 rounded-lg">
                <input type="text" name="name" placeholder="Your Name"  class="px-4 py-3 rounded-md" required>
                <input type="number" name="room_id" placeholder="Room Id" class="px-4 py-3 rounded-md" required>
                <button type="submit" class="bg-white px-4 py-2 rounded-md">Qo'shilish</button>
            </div>
        </form>
    </div>
@endsection

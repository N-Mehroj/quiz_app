@extends('main')

@section('body')
    <h1 class="text-center font-extrabold text-3xl my-10">Create New Test</h1>
    <div class="flex justify-center items-center w-full bg-blue-500">
        <form method="post">
            @csrf
            <div class="flex flex-col px-10 py-8  gap-10 rounded-lg">
                <textarea name="" id="" cols="100" rows="10" class="px-4 py-3 rounded-md" placeholder="Question"></textarea>
                <div>
                    <div class="flex">
                        <input type="radio" class="w-8 mx-3 !bg-black" name="radio">
                        <textarea name="" id="" cols="100" rows="1" class="px-4 py-3 rounded-md" placeholder="Option"></textarea>
                    </div>
                   <div class="flex justify-center mt-2">
                       <div class="text-center text-5xl bg-orange-500 text-white rounded-md cursor-pointer px-5 pb-2">+</div>
                   </div>
                </div>
                <div class="flex justify-center items-center text-5xl bg-teal-400 text-white rounded-md cursor-pointer pb-2">+</div>
                <button type="submit" class="bg-white px-4 py-2 rounded-md">Qo'shilish</button>
            </div>
        </form>
    </div>
@endsection

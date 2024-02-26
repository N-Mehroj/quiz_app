@extends('main')

@section('body')
    <style>
        .question-block {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            flex-direction: column;
            background: rgb(61, 61, 194);
            padding: 50px
        }
    </style>
    <form method="post" action="/insert" id="quizForm">
        @csrf
        <div id="quiz-container" class="flex items-center flex-col mt-20">
            <div class="flex w-5/12">
                <div class="bg-green-500  cursor-pointer py-2 text-white rounded-s-xl text-center w-full"
                    onclick="changeOneChoice()">1 correct answer
                </div>
                <div class="bg-orange-500 cursor-pointer py-2 text-white rounded-e-xl text-center w-full"
                    onclick="changeMultipleChoice()">many correct answer
                </div>
            </div>
            <div class="bg-blue-500 border-2 px-10 py-10 rounded-lg flex flex-col w-5/12 gap-5">
                <input type="text" name="quiz[]" id="" class="border w-full px-3 py-2 rounded-md"
                    placeholder="Quiz" required>
                <div class="grid grid-cols-1 gap-3 mt-2" id="opt">
                    <div class="flex gap-3 ">
                        <input type="radio" name="radio" id="" class="w-7" required>
                        <input type="text" name="answer[]" required
                            class="border w-full px-3 py-2 rounded-md answer" placeholder="options">
                    </div>
                    <div class="flex gap-3">
                        <input type="radio" name="radio" id="" class="w-7" required>
                        <input type="text" name="answer[]" required id=""
                            class="border w-full px-3 py-2 rounded-md answer" placeholder="options">
                    </div>
                    <div class="flex gap-3">
                        <input type="radio" name="radio" id="" class="w-7" required>
                        <input type="text" name="answer[]" required id=""
                            class="border w-full px-3 py-2 rounded-md answer" placeholder="options">
                    </div>
                    <div class="flex gap-3">
                        <input type="radio" name="radio" id="" class="w-7" required>
                        <input type="text" name="answer[]" required id=""
                            class="border w-full px-3 py-2 rounded-md answer" placeholder="options">
                    </div>
                </div>
                <div class="flex justify-center">
                    <div onclick="addNewOpts()"
                        class="bg-green-500 text-white px-8 text-center leading-snug py-2 font-semibold text-2xl rounded-lg">
                        +</div>
                </div>
                <button id="add-question-btn" class="bg-orange-500 font-semibold  text-white px-5 py-3 rounded-md"
                    onclick="getFormData()">Submit</button>
            </div>
        </div>
    </form>

    <script>
        let type = 'radio';

        function changeMultipleChoice() {

            const radioInputs = document.querySelectorAll('input[type="radio"]');
            radioInputs.forEach(radioInput => {
                radioInput.setAttribute('type', 'checkbox');
            });
            type = 'checkbox';
        }

        function changeOneChoice() {

            const radioInputs = document.querySelectorAll('input[type="checkbox"]');
            radioInputs.forEach(radioInput => {
                radioInput.setAttribute('type', 'radio');
            });
            type = 'radio';
        }

        function addNewOpts() {
            const optionsContainer = document.getElementById('opt');

            const clonedOption = optionsContainer.lastElementChild.cloneNode(true);

            clonedOption.querySelector('input[name="radio[]"]');
            clonedOption.querySelector('input[name="answer[]"]').value = '';
            optionsContainer.appendChild(clonedOption);
        }
        const answer = document.querySelectorAll('.answer');

        answer.forEach(function(el) {
            el.addEventListener('keyup', function(e) {
                console.log(el.previousElementSibling);
                console.log(el.previousElementSibling.value = el.value);

            })
        });


        // document.addEventListener('DOMContentLoaded', function() {
        //     var inputElements = document.querySelectorAll('.toggler');

        //     inputElements.forEach(function(el) {
        //         el.addEventListener('keyup', function(el) {
        //             // console.log(inputElement.value);
        //             console.log(el.previousElementSibling);
        //             // el.previousElementSibling.value = inputElement.value;
        //         });
        //     });
        // });
        // const optionInput = document.createElement('input');
        // optionInput.type.forEach(element => {

        //     console.log(element);
        // });
        // optionInput.getAttribute('type', 'radio');
        // document.getElementById('add-question-btn').addEventListener('click', addQuestion);

        // function getFormData() {
        //     const formData = new FormData();

        //     const questionBlocks = document.querySelectorAll('.question-block');

        //     questionBlocks.forEach((block, index) => {
        //         const question = block.querySelector(`input[name="question${index + 1}"]`).value;
        //         const options = [];
        //         for (let i = 1; i <= 4; i++) {
        //             const option = block.querySelector(`input[name="option${index + 1}-${i}"]`).value;
        //             options.push(option);
        //         }
        //         const answer = block.querySelector(`input[name="answer${index + 1}"]`).value;
        //         // const img = block.querySelector(`input[name="img${index + 1}"]`).files[0];

        //         formData.append(`Question ${index + 1}`, question);
        //         options.forEach((option, optionIndex) => {
        //             formData.append(`Option ${index + 1}-${optionIndex + 1}`, option);
        //         });
        //         formData.append(`Answer ${index + 1}`, answer);
        //         // formData.append(`Image ${index + 1}`, img);
        //     });

        //     // Do something with formData
        //     console.log([...formData.entries()]);


        //     var xhr = new XMLHttpRequest();
        //     xhr.open('POST', '/insert', true);
        //     xhr.setRequestHeader('Content-Type', 'application/json');
        //     xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
        //         'content'));

        //     xhr.onload = function() {
        //         if (xhr.status >= 200 && xhr.status < 300) {
        //             alert(xhr.responseText);
        //             window.location.href = 'http://127.0.0.1:8000/';
        //             console.log('Response:', xhr.responseText);
        //         } else {
        //             console.error('Request failed. Status:', xhr.status);
        //         }
        //     };

        //     var jsonData = JSON.stringify([...formData.entries()]);
        //     xhr.send(jsonData);
        // }
    </script>
@endsection

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
    <form method="post" id="quizForm" enctype="multipart/form-data">
        @csrf
        <button id="add-question-btn" class="bg-green-700 text-white px-5 py-3 rounded-md">Add Question</button>
        <button id="add-question-btn" class="bg-sky-700 text-white px-5 py-3 rounded-md"
            onclick="getFormData()">bajaraish</button>
        <div id="quiz-container" class="flex justify-center gap-3 flex-col">
        </div>
    </form>

    <script>
        const element = document.querySelector('form');
        element.addEventListener('submit', event => {
            event.preventDefault();
        });
        let questionCount = 0;

        function addQuestion() {
            questionCount++;

            const container = document.getElementById('quiz-container');

            const questionBlock = document.createElement('div');
            questionBlock.className = 'question-block';


            const questionInput = document.createElement('input');
            questionInput.setAttribute('type', 'text');
            questionInput.setAttribute('name', `question${questionCount}`);
            questionInput.setAttribute('placeholder', `Question ${questionCount}`);
            questionInput.setAttribute('class', `border-2 rounded-md px-5 py-3`);
            questionInput.setAttribute('required', true);
            questionBlock.appendChild(questionInput);

            for (let i = 1; i <= 4; i++) {
                const optionInput = document.createElement('input');
                optionInput.setAttribute('type', 'text');
                optionInput.setAttribute('name', `option${questionCount}-${i}`);
                optionInput.setAttribute('placeholder', `Option ${i}`);
                optionInput.setAttribute('class', `border-2 rounded-md px-5 py-3`);
                optionInput.setAttribute('required', true); //
                questionBlock.appendChild(optionInput);
            }

            const quizTextArea = document.createElement('input');
            quizTextArea.setAttribute('type', 'text');
            quizTextArea.setAttribute('name', `answer${questionCount}`);
            quizTextArea.setAttribute('class', `border-2 rounded-md px-5 py-3`);
            quizTextArea.setAttribute('required', true);
            quizTextArea.setAttribute('placeholder', `Answer for Question ${questionCount}`);
            questionBlock.appendChild(quizTextArea);

            container.appendChild(questionBlock);

            // const imageInput = document.createElement('input');
            // imageInput.setAttribute('type', 'file');
            // imageInput.setAttribute('name', `img${questionCount}`);
            // questionBlock.appendChild(imageInput);
            // questionBlock.appendChild(document.createElement('br'));

            // container.appendChild(questionBlock);
        }

        document.getElementById('add-question-btn').addEventListener('click', addQuestion);

        function getFormData() {
            const formData = new FormData();

            const questionBlocks = document.querySelectorAll('.question-block');

            questionBlocks.forEach((block, index) => {
                const question = block.querySelector(`input[name="question${index + 1}"]`).value;
                const options = [];
                for (let i = 1; i <= 4; i++) {
                    const option = block.querySelector(`input[name="option${index + 1}-${i}"]`).value;
                    options.push(option);
                }
                const answer = block.querySelector(`input[name="answer${index + 1}"]`).value;
                // const img = block.querySelector(`input[name="img${index + 1}"]`).files[0];

                formData.append(`Question ${index + 1}`, question);
                options.forEach((option, optionIndex) => {
                    formData.append(`Option ${index + 1}-${optionIndex + 1}`, option);
                });
                formData.append(`Answer ${index + 1}`, answer);
                // formData.append(`Image ${index + 1}`, img);
            });

            // Do something with formData
            console.log([...formData.entries()]);


            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/insert', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'));

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    alert(xhr.responseText);
                    window.location.href = 'http://127.0.0.1:8000/';
                    console.log('Response:', xhr.responseText);
                } else {
                    console.error('Request failed. Status:', xhr.status);
                }
            };

            var jsonData = JSON.stringify([...formData.entries()]);
            xhr.send(jsonData);
        }
    </script>
@endsection

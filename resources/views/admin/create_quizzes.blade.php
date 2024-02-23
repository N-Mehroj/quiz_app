@extends('main')

@section('body')
    <h1 class="text-center font-extrabold text-3xl my-10">Create New Test{{ old('quiz') }}</h1>
    <div class="flex justify-center items-center w-full bg-blue-500">
        <form method="post" action="/insert"  id="quizForm" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col px-10 py-8  gap-10 rounded-lg">
                <div id="quzizContainer" class="flex flex-col gap-10 quizArea">
                    <div class="flex flex-col gap-5">
                        <textarea name="quiz" id="" cols="100" rows="10" class="px-4 py-3 rounded-md w-full mb-5 quzzes"
                            placeholder="Question" required></textarea>
                        <input type="file" class="w-full bg-white py-3 px-5 rounded-lg file" name="file_1">
                        <div class="opt_1 optionContainer flex flex-col gap-4" id="opt">
                            <div class="flex">
                                <input type="radio" class="w-8 mx-3 !bg-black exampleClass" name="radio_1" required>
                                <textarea name="radio_1" id="" cols="100" rows="1" class="px-4 py-3 rounded-md" placeholder="Option"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="flex justify-center mt-2">
                            <div class="text-center text-5xl bg-orange-500 text-white rounded-md cursor-pointer px-5 pb-2"
                                onclick="addOption()">+</div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center items-center text-5xl bg-teal-400 text-white rounded-md cursor-pointer pb-2"
                    onclick="addQuiz()">+</div>
                <button type="submit" class="bg-white px-4 py-2 rounded-md">Qo'shilish</button>
            </div>
        </form>
    </div>
    <script>
        let numForm = 1;

        function addQuiz() {
            numForm++;
            var inputElement = document.querySelectorAll('.exampleClass');
            var optionsContainer = document.getElementById('quzizContainer');
            var newOptionDiv = document.createElement('div');
            var classEle = document.getElementById('opt');
            console.log(inputElement);
            // console.log();
            var lastRadio = inputElement[inputElement.length - 1];
            var inputName = lastRadio.getAttribute('name') + '_' + numForm;
            var getClass = classEle.classList.value.split(' ')[0] + '_' + numForm;
            // console.log(getClass.value.split(' ')[0]);
            var fileElement = document.querySelectorAll('.file');
            var lastfile = fileElement[fileElement.length - 1];
            var inputFile = lastfile.getAttribute('name') + '_' + numForm;
            console.log(inputFile);

            newOptionDiv.className = 'flex flex-col gap-5';
            newOptionDiv.innerHTML = `
                  <textarea name="quiz" id="" cols="100" rows="10" class="px-4 py-3 rounded-md w-full mb-5  quzzes" placeholder="Question" required></textarea>
                  <input type="file" class="w-full bg-white py-3 px-5 rounded-lg" name="${inputFile}">
                    <div  class="${getClass} optionContainer flex flex-col gap-4">
                        <div class="flex">
                            <input type="radio" class="exampleClass w-8 mx-3 !bg-black" name="${inputName}" required>
                            <textarea name="${inputName}" id="" cols="100" rows="1" class="px-4 py-3 rounded-md" placeholder="Option" required></textarea>
                        </div>
                    </div>
                    <div class="flex justify-center mt-2">
                        <div class="text-center text-5xl bg-orange-500 text-white rounded-md cursor-pointer px-5 pb-2" onclick="addOption()">+</div>
                    </div>
                    `;
            optionsContainer.appendChild(newOptionDiv);

            console.log('Input Name:', inputName);
        }

        function addOption() {
            var allOptionContainers = document.querySelectorAll('.optionContainer');
            console.log(allOptionContainers);
            var lastOptionContainer = allOptionContainers[allOptionContainers.length - 1];
            var inputElement = document.querySelectorAll('.exampleClass');
            var lastRadio = inputElement[inputElement.length - 1];
            var inputName = lastRadio.getAttribute('name');
            console.log('Input Name:', inputName);
            var newOptionDiv = document.createElement('div');
            newOptionDiv.innerHTML = `
                        <div class="flex">
                            <input type="radio" class="exampleClass w-8 mx-3 !bg-black" name="${inputName}">
                            <textarea name="${inputName}" id="" cols="100" rows="1" class="px-4 py-3 rounded-md" placeholder="Option"></textarea>
                        </div>
                        `;

            lastOptionContainer.appendChild(newOptionDiv);
        }

        const element = document.querySelector('form');
        element.addEventListener('submit', event => {
            // event.preventDefault();
            var optionContainer = document.querySelector('.quizArea');
            var textareas = optionContainer.querySelectorAll('textarea');
            var quzzesContainer = document.querySelectorAll('.quzzes');
            var optContainer = document.querySelectorAll('.opt_1');

            var formData = [];

            var form = document.getElementById('quizForm');
            var formData = new FormData(form);

            var values = {};
            formData.forEach(function(value, key) {
                if (values[key]) {
                    if (!Array.isArray(values[key])) {
                        values[key] = [values[key]];
                    }
                    values[key].push(value);
                } else {
                    values[key] = value;
                }
            });

            console.log(values);
            // fetch("http://127.0.0.1:8000/insert", {
            //     method: "POST",
            //     headers: {
            //         'Content-Type': 'application/json'
            //     },
            //     body: JSON.stringify(values)
            // }).then(res => {
            //     console.log("Request complete! response:", res);
            // });

        });

        var elementss = document.querySelector('.quizArea');

        if (elementss) {
            console.log('An element with the class exists on the page.');
        } else {
            console.log('No element with the class found on the page.');
        }
    </script>
@endsection

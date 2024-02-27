@extends('main')

@section('body')
    @php
        //    print_r((int)explode("-",$test['start_date']));
        $year = (int) explode('-', $test[0]['start_date'])[0];
        $month = (int) explode('-', $test[0]['start_date'])[1];
        $day = (int) explode('-', $test[0]['start_date'])[2];
        $yearEnd = (int) explode('-', $test[0]['end_date'])[0];
        $monthEnd = (int) explode('-', $test[0]['end_date'])[1];
        $dayEnd = (int) explode('-', $test[0]['end_date'])[2];
        $yearNow = (int) date('Y');
        $monthNow = (int) date('m');
        $dayNow = (int) date('d');
    @endphp
    <style>
        .selected {
            color: rgb(15, 156, 15);
            border: 2px solid rgb(0, 255, 0);
        }

        .bg-bl {
            background: #02020263;
            backdrop-filter: blur(5px);
        }

        .modal {
            display: block !important;
        }
    </style>
    <div class="box w-full h-screen absolute bg-bl hidden" id="modalArea">
        <div class="flex pt-10 justify-center items-center">
            <div class="bg-white px-8 w-10/12 py-5 rounded-lg ">
                <div class="flex justify-between">
                    <h1 class="text-5xl font-semibold">{{ $test[0]['title'] }}</h1>
                    <h1 class="text-5xl font-semibold cursor-pointer" onclick="location.reload();">&Chi;</h1>
                </div>
                <div class="getRequest" id="resultDiv">

                </div>
            </div>
        </div>
    </div>
    <h1 class="text-left font-extrabold text-3xl mb-5 py-5 px-10" id="inner">Joining</h1>
    <div class="flex p-5 flex-col items-center gap-10 w-full">
        <h1 class="text-5xl font-semibold">{{ $test[0]['title'] }}</h1>
        <p class="text-xl">{{ $test[0]['desc'] }}</p>
        @if ($yearEnd >= $yearNow && $monthEnd >= $monthNow && $dayEnd >= $dayNow)
            @if ($year <= $yearNow && $month <= $monthNow && $day <= $dayNow)
                @foreach ($quizlist as $quiz)
                    <div class="box border-2 border-black rounded-lg px-10 py-5 w-10/12">
                        <h1 class="text-center my-5">{{ $quiz['question'] }}</h1>
                        <div class="grid grid-cols-2 gap-10">
                            @foreach ($quiz['options']['options'] as $key => $option)
                                <div class="grid-item border-2 rounded-lg p-5 cursor-pointer"
                                    onclick="quiz({{ $quiz['id'] }},`{{ $option }}`)">
                                    <h1 class="font-semibold">{{ $option }}</h1>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-6xl text-orange-500 font-mono">Test Is Coming Soon</h1>
            @endif
        @else
            <h1 class="text-6xl text-red-500 font-mono">Test Completed</h1>
        @endif
        <div class="bg-green-500 px-8 py-3 text-white rounded-lg text-lg flex items-center cursor-pointer"
            onclick="sendData()">submit</div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const gridItems = document.querySelectorAll('.grid-item');

            gridItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Belgilanishni o'zgartirish
                    item.classList.toggle('selected');
                    gridItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('selected');
                        }
                    });
                });
            });
        });
        let qu = [];

        function quiz(id, vall) {
            // removeDublicates(qu)

            if (!qu.some(item => item.id === id)) {
                let q = {
                    id: id,
                    vall: vall,
                };
                qu.push(q);
            }
            console.log(qu);

        }


        var minute = {{ $test[0]['time'] }};
        var second = minute * 60;

        var timer = setInterval(function() {

            var minutLeft = Math.floor(second / 60);
            var sekundLeft = second % 60;

            document.getElementById('inner').innerText = minutLeft + ' minut ' + sekundLeft + ' seconds left'

            second--;
            if (second < 0) {
                clearInterval(timer);
                alert('Time is up');
                sendData();
            }
        }, 1000);


        function sendData() {
            clearInterval(timer);
            let data = {
                'answer': qu,
                'room_id': "{{ $test[0]['allowed_room_id'] }}",
                'count_quiz': qu.length,
            };
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/get_resault', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'));

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    console.log('Response:', xhr.responseText);
                    document.getElementById("modalArea").classList.remove('hidden');

                    document.getElementById("resultDiv").innerHTML = this.responseText;
                } else {
                    console.error('Request failed. Status:', xhr.status);
                }
            };

            var jsonData = JSON.stringify([data]);
            xhr.send(jsonData);
            // console.log(data);


        }

        function toggleFullScreen() {
          var elem = document.documentElement;
          if (!document.fullscreenElement && !document.mozFullScreenElement &&
              !document.webkitFullscreenElement && !document.msFullscreenElement) {
            if (elem.requestFullscreen) {
              elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {
              elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
              elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
              elem.msRequestFullscreen();
            }
          } else {
            if (document.exitFullscreen) {
              document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
              document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
              document.msExitFullscreen();
            }
          }
        }
    </script>

@endsection

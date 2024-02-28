<table>
    <tr>
        <th>Title</th>
        {{-- title in  here --}}
        <td>{{ $data['title'] }}</td>
    </tr>
    <tr>
        <th>Description</th>
        {{-- description in here --}}
        <td>{{ $data['desc'] }}</td>
    </tr>
    <tr>
        <th>Complated At Date</th>
        {{-- Complated At Date in here --}}
        <td>{{ $data['complated'] }}</td>
    </tr>
    <tr>
        <th>percentage</th>
        {{-- percentage in here --}}
        <td>{{ $data['percentage']}}</td>
    </tr>
    <tr>
        <th></th>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <td></td>
    </tr>
    <thead>
        <tr>
            <th>question</th>
            <th>option</th>
            <th>Correct status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['resault_data'] as $item)
            <tr>
                <td>{{ $item['question'] }}</td>
                <td>{{ $item['option'] }}</td>
                <td>{{ $item['correct_type'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


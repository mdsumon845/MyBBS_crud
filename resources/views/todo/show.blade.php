<div class = "back-link">
    &laquo; <a href = "{{ route('todo') }}">back</a>
</div>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col">id</th>
            <th scope = "col">title</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($get_all_todo as $key=>$todo)
            <tr>
                <td>{{ $todo->id }}</td>
                <td>{{ $todo->title }}</td>
                <td>
                    <a href = "{{ url('todo_delete/'.$todo->id) }}" class = "btn btn_danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


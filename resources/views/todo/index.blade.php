<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>My Todos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <main >
        <header>
            <h1>Todos</h1>
            <span  class = "purge delete_all" data-url = "{{ route('bulkcategoryDelete') }}">Purge</span>
        </header>

        <form action = "{{ route('todo_store') }}" method = "POST" >
            @csrf
            <input type = "text" name = "title" value = "" placeholder = "Type new todo.">
        </form>

        <ul>
            @isset ($get_all_todo)
                @foreach ($get_all_todo as $key=>$todo)
                    <li id = "tr_{{ $todo->id }}">
                        <input type = "checkbox" class = "sub_chk" data-id = "{{ $todo->id }}">
                        <span>{{ $todo->title }}</span>
                        <span class = "delete"><a onclick = "return confirm('Are you sure?')" href = "{{ url('todo_delete/'.$todo->id) }}">x</a></span>
                    </li>
                @endforeach
            @endisset
        </ul>
    </main>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <=0){
            alert("Please select row.");
            }else{
                var check = confirm("Are you sure you want to delete this row?");
                if (check == true){
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("li").remove();
                                });
                                alert(data['success']);
                                location.reload();
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function( index, value ) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }

        });

    });
</script>
</html>




<?php
namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Service\TodoService
use DB;

class TodoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $todo['get_all_todo'] = Todo::orderBy('id', 'desc')->get();
        return view ('todo.index', $todo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->save();
        return redirect()->route('todo');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $todo['get_all_todo'] = Todo::all();
        return view ('todo.show', $todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $idArr = explode(",", $ids);
        for ($i = 0; $i<count($idArr); $i++){
            $result = DB::table('todos')->where('id', '=', $idArr[$i])->delete();
        }
        return response()->json(['success'=>"Selected Items Deleted successfully."]);
    }
}

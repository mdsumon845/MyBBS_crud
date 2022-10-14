<?php
namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Services\TodoService;
use DB;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * @var TodoService
     */
    protected $todoService;

    /**
     * TodoController Constructor
     *
     * @param TodoService $todoService
     *
     */
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = ['status' => 200];

        try {
            $result['get_all_todo'] = $this->todoService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('todo.index', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->todoService->savePostData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()->route('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['get_all_todo'] = $this->todoService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('todo.show', $result);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->todoService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $idArr = explode(",", $ids);
        for ($i = 0; $i<count($idArr); $i++){
            $result = DB::table('todos')->where('id', '=', $idArr[$i])->delete();
        }
        return response()->json(['success' => "Selected Items Deleted successfully."]);
    }
}

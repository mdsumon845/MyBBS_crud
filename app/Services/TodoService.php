<?php
namespace App\Services;
use App\Repositories\TodoRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TodoService
{
    /**
     * @var $TodoRepository
     */
    protected $TodoRepository;

    /**
     * TodoService constructor.
     *
     * @param TodoRepository $TodoRepository
     */

    public function __construct(TodoRepository $TodoRepository)
    {
        $this->TodoRepository = $TodoRepository;
    }

    /**
     * Get all Todo
     * @return String
     */
    public function getAll()
    {
        return $this->TodoRepository->getAllPost();
    }


    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function savePostData($data)
    {
        $validator = Validator::make($data, [
            'title'=>'required',

        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $result = $this->TodoRepository->save($data);

        return $result;
    }

    /**
     * Get Post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->TodoRepository->getById($id);
    }

    /**
     * Delete post by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();
        try{
            $Todo = $this->TodoRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $Todo;
    }
}



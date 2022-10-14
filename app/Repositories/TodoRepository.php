<?php

namespace App\Repositories;
use App\Models\Todo;

class TodoRepository
{
    /**
     * @var Todo
     */
    protected $todo;

    /**
     * TodoRepository constructor.
     *
     * @param Todo $todo
     */

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Get all post
     *
     * @return Todo $todo
     */
    public function getAllPost()
    {
        return $this->todo::orderBy('id', 'desc')
            ->get();

    }


    /**
     * Save todo
     *
     * @param $data
     * @return Todo
     */
    public function save($data)
    {
        $todo = new $this->todo;
        $todo->title = $data['title'];
        $todo->save();
        return $todo->fresh();
    }

    /**
     * Get post by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->todo
            ->where('id', $id)
            ->get();
    }

    /**
     * Delete todo
     *
     * @param $data
     * @return Todo
     */
    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();

        return $todo;
    }
}

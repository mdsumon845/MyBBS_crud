<?php

namespace App\Repositories;
use App\Models\Todo;

class TodoRepository
{
    /**
     * @var Todo
     */
    protected $Todo;

    /**
     * TodoRepository constructor.
     *
     * @param Todo $Todo
     */

    public function __construct(Todo $Todo)
    {
        $this->Todo = $Todo;
    }

    /**
     * Get all post
     *
     * @return Todo $Todo
     */
    public function getAllPost()
    {
        return $this->Todo::orderBy('id', 'desc')
            ->get();

    }


    /**
     * Save Todo
     *
     * @param $data
     * @return Todo
     */
    public function save($data)
    {
        $Todo = new $this->Todo;
        $Todo->title = $data['title'];
        $Todo->save();
        return $Todo->fresh();
    }

    /**
     * Get post by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->Todo
            ->where('id', $id)
            ->get();
    }

    /**
     * Delete Todo
     *
     * @param $data
     * @return Todo
     */
    public function delete($id)
    {
        $Todo = $this->Todo->find($id);
        $Todo->delete();

        return $Todo;
    }
}

<?php
namespace App\Service;
use App\Repositories\TodoInterface as TodoRepository;

class TodoService
{
    public function __construct(TodoRepository $todoRepo)
    {
        $this->TodoRepository = $todoRepo;
    }

    public function find($id)
    {
        $todo = $this->TodoRepository->find($id);
        $respons=Json_encode($todo);
        return $respons;
    }
}

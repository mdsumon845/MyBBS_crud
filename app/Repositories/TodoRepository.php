<?php
namespace App\Repositories;
use App\Models\Todo;

class TodoRepository implements TodoInterface
{
    public function find($id)
    {
        return Todo::find($id);
    }
}

<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function all() : Collection
    {
        return Category::all();
    }

    public function get(int $id) : Category
    {
        return Category::findOrFail($id);
    }

    public function store(array $data) : Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data) : bool
    {
        return $this->get($id)->update($data);
    }

    public function delete(int $id) : bool
    {
        return $this->get($id)->delete();
    }
}

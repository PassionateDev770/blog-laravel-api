<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    public function create($data): Category
    {
        return DB::transaction(function () use ($data) {
            $category = new Category();
            $category->fill($data);
            $category->save();
            return $category;
        }, 3);

    }

    public function update($data, Category $category): Category
    {
        return DB::transaction(function () use ($data, $category) {
            $category->fill($data);
            $category->save();
            return $category;
        }, 3);

    }
}

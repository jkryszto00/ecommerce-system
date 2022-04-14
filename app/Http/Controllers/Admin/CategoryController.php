<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('admin.categories.index', [
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $name = $request->validated('name');
        $this->categoryRepository->store([
            'name' => $name,
            'slug' => Str::slug($name, '-')
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $this->categoryRepository->update($id, [
            'name' => $request->validated('name'),
            'slug' => Str::slug($request->validated('slug'), '-')
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}

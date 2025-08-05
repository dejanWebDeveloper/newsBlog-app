<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }
    public function datatable()
    {   //this is from yajra documentation
        $query = Category::query();
        $datatable = DataTables::of($query);
        $datatable->addColumn('name', function ($row) {
            return $row->name;
        })->addColumn('description', function ($row) {
            return $row->description;
        })->addColumn('priority', function ($row) {
            return $row->priority;
        })->editColumn('created_at', function ($row) {
            return date_format($row->created_at, 'd/m/Y H:i:s');
        })->addColumn('actions', function ($row) {
            return view('admin.categories.partials.actions', [
                'category' => $row,
            ]);
        })->rawColumns(['actions']); //rawColumn samo za dodate kolone u kojima ima neki html kod

        return $datatable->toJson();
    }
    public function addCategory()
    {

        return view('admin.categories.add_category');
    }

    public function storeCategory()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'description' => ['required', 'string', 'min:3', 'max:100'],
            'show_on_homepage' => ['boolean'],
            'priority' => ['required', 'numeric']
            ]);

        $data['created_at'] = now();

        Category::where('priority', '>=', $data['priority'])
            ->increment('priority');

        $lastCategory = Category::orderBy('id', 'desc')->first();
        if (($data['priority'] == 0 || !isset($lastCategory->id))){
            $data['priority'] = 1;
        }

        $newCategory = new Category();

        $newCategory->fill($data)->save();



        session()->put('system_message', 'Category Added Successfully');
        return redirect()->route('admin.category.index');
    }
    public function editCategory(Category $category)
    {
        return view('admin.categories.edit_category', compact('category'));
    }
    public function updateCategory(Category $category)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'description' => ['required', 'string', 'min:3', 'max:100'],
            'show_on_homepage' => ['boolean'],
            'priority' => ['required', 'numeric']
        ]);
        $data['updated_at'] = now();

        Category::where('priority', '>=', $data['priority'])
            ->increment('priority');

        $lastCategory = Category::orderBy('id', 'desc')->first();
        if (($data['priority'] == 0 || !isset($lastCategory->id))){
            $data['priority'] = 1;
        }

        $category->fill($data)->save();

        session()->put('system_message', 'Category Edited Successfully');
        return redirect()->route('admin.category.index');
    }
    public function deleteCategory()
    {
        $data =  request()->validate([
            'category_for_delete_id' => ['required', 'numeric', 'exists:categories,id'],
        ]);
        $category = Category::findOrFail($data['category_for_delete_id']);
        $category->delete();

        return response()->json(['success' => 'Article Deleted Successfully']);

    }
}

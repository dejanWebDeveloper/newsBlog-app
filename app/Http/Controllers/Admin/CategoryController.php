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
                'article' => $row,
            ]);
        })->rawColumns(['actions']); //rawColumn samo za dodate kolone u kojima ima neki html kod

        return $datatable->toJson();
    }
}

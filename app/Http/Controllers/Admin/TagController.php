<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.tags.index');
    }
    public function datatable()
    {   //this is from yajra documentation
        $query = Tag::query();
        $datatable = DataTables::of($query);
        $datatable->addColumn('name', function ($row) {
            return $row->name;
        })->editColumn('created_at', function ($row) {
            return date_format($row->created_at, 'd/m/Y H:i:s');
        })->addColumn('actions', function ($row) {
            return view('admin.tags.partials.actions', [
                'tag' => $row,
            ]);
        })->rawColumns(['actions']); //rawColumn samo za dodate kolone u kojima ima neki html kod

        return $datatable->toJson();
    }
}

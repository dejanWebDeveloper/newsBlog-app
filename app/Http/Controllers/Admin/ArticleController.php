<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;


class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.articles.index');
    }
    public function datatable()
    {   //ovo sve je iz dokumentacije za yajra dataTables
        $query = Article::query();
        $datatable = DataTables::of($query);
        //imamo probelem sa redom picture jer za nju nemamo podatke u bazi
        $datatable->addColumn('photo', function ($row) {
            return '<img src="' . $row->getImageUrl() . '" border="0" width="100" class="img-rounded" align="center" />';
        })->addColumn('category', function ($row) {
            return optional($row->category)->name;
        })->addColumn('tag', function ($row) {
            return optional($row->tag->pluck('name'))->join(',');
        })->editColumn('created_at', function ($row) {
            return date_format($row->created_at, 'd/m/Y H:i:s');
        })->editColumn('ban', function ($row) {
            if ($row->ban == 1) {
                return 'Banned';
            } else {
                return 'Active';
            };
        })->addColumn('actions', function ($row) {
            return view('admin.articles.partials.actions', [
                'article' => $row,
            ]);
        })->rawColumns(['photo', 'actions']); //rawColumn samo za dodate kolone u kojima ima neki html kod

        return $datatable->toJson();
    }
}

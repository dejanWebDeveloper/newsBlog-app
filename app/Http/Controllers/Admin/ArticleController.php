<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Employee;
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
            }
        })->addColumn('actions', function ($row) {
            return view('admin.articles.partials.actions', [
                'article' => $row,
            ]);
        })->rawColumns(['photo', 'actions']); //rawColumn samo za dodate kolone u kojima ima neki html kod

        return $datatable->toJson();
    }

    public function addArticle()
    {
        $authors = Employee::all();
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.articles.add_article',
            compact('authors', 'tags', 'categories')
        );
    }

    public function storeArticle()
    {
        $data = request()->validate([
            'heading' => ['required', 'string', 'min:3', 'max:30'],
            'preheading' => ['required', 'string', 'min:3', 'max:60'],
            'author' => ['required', 'numeric', 'exists:employee,id'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:200'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'tags' => ['required', 'array', 'min:2'],
            'tags.*' => ['required', 'numeric', 'exists:tags,id'],
            'text' => ['required', 'string', 'min:20', 'max:1000']
        ]);
        $data['ban'] = 0;
        $data['created_at'] = now();
        $data['text'] = strip_tags($data['text']);
        $newArticle = new Article();
        $newArticle->fill($data)->save();
        //table tags
        $newArticle->tag()->sync($data['tags']);

        //saving photo
        if(request()->hasFile('photo')) { //if has file
            $photo = request()->file('photo'); //save file to $photo
            //helper methode
            $this->savePhoto($photo, $newArticle);
        }

        session()->put('system_message', 'Article Added Successfully');
        return redirect()->route('admin.article.index');
    }
    public function savePhoto($photo, $newArticle)
    {
        $photoName = $newArticle->id . '.' . $photo->getClientOriginalExtension(); //jpg..
        $photo->move(public_path('/storage/photo'), $photoName); //save to public/storage/photo

        $newArticle->photo = $photoName;
        $newArticle->save();
    }
    public function deletePhoto($article)
    {
        // Ako članak nema fotografiju, nema potrebe za brisanjem
        if (!$article->photo) {
            return false;
        }

        // Koristimo basename() da bismo se zaštitili od eventualnog path traversal napada
        $filename = basename($article->photo);
        $path = public_path('storage/photo/' . $filename);

        // Ako fajl postoji — obriši ga
        if (file_exists($path)) {
            return unlink($path); // vraća true/false
        }

        return false; // fajl nije postojao
    }
    public function editArticle(Article $article)
    {
        $authors = Employee::all();
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.articles.edit_article', compact(
            'article',
            'authors',
            'tags',
            'categories'
        ));
    }
    public function updateArticle(Article $article)
    {
        $data = request()->validate([
            'heading' => ['required', 'string', 'min:3', 'max:30'],
            'preheading' => ['required', 'string', 'min:3', 'max:60'],
            'author' => ['required', 'numeric', 'exists:employee,id'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:200'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'tags' => ['required', 'array', 'min:2'],
            'tags.*' => ['required', 'numeric', 'exists:tags,id'],
            'text' => ['required', 'string', 'min:20', 'max:1000']
        ]);
        $data['updated_at'] = now();
        $data['text'] = strip_tags($data['text']);
        $article->fill($data)->save();
        //table tags
        $article->tag()->sync($data['tags']);
        if(request()->hasFile('photo')) { //provera da li je administrator uploadovao sliku
            $this->deletePhoto($article);
            $photo = request()->file('photo'); //cuvanje slike u varijablu
            $this->savePhoto($photo, $article);
        }
        session()->put('system_message', 'Article Edited Successfully');
        return redirect()->route('admin.article.index');
    }
}

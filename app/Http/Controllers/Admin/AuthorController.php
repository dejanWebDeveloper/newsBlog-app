<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AuthorController extends Controller
{
    public function index()
    {
        return view('admin.authors.index');
    }
    public function datatable()
    {   //this is from yajra documentation
        $query = Employee::query();
        $datatable = DataTables::of($query);
        $datatable->addColumn('name', function ($row) {
            return $row->name;
        })->editColumn('created_at', function ($row) {
            return date_format($row->created_at, 'd/m/Y H:i:s');
        })->addColumn('actions', function ($row) {
            return view('admin.authors.partials.actions', [
                'author' => $row,
            ]);
        })->rawColumns(['actions']); //rawColumn samo za dodate kolone u kojima ima neki html kod

        return $datatable->toJson();
    }
    public function addAuthor()
    {
        return view('admin.authors.add_author');
    }

    public function storeAuthor()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:30']
        ]);

        $data['created_at'] = now();

        $newAuthor = new Employee();

        $newAuthor->fill($data)->save();

        session()->put('system_message', 'Author Added Successfully');
        return redirect()->route('admin.author.index');
    }
    public function editAuthor(Employee $author)
    {
        return view('admin.authors.edit_author', compact('author'));
    }
    public function updateAuthor(Employee $author)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
        ]);
        $data['updated_at'] = now();

        $author->fill($data)->save();

        session()->put('system_message', 'Author Edited Successfully');
        return redirect()->route('admin.author.index');
    }
    public function deleteAuthor()
    {
        $data =  request()->validate([
            'author_for_delete_id' => ['required', 'numeric', 'exists:employee,id']
        ]);
        $author = Employee::findOrFail($data['author_for_delete_id']);
        $author->delete();

        return response()->json(['success' => 'Author Deleted Successfully']);

    }
}

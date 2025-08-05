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
    public function addTag()
    {

        return view('admin.tags.add_tag');
    }

    public function storeTag()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:30']
        ]);

        $data['created_at'] = now();

        $newTag = new Tag();

        $newTag->fill($data)->save();

        session()->put('system_message', 'Tag Added Successfully');
        return redirect()->route('admin.tag.index');
    }
    public function editTag(Tag $tag)
    {
        return view('admin.tags.edit_tag', compact('tag'));
    }
    public function updateTag(Tag $tag)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'max:30'],
        ]);
        $data['updated_at'] = now();

        $tag->fill($data)->save();

        session()->put('system_message', 'Tag Edited Successfully');
        return redirect()->route('admin.tag.index');
    }
    public function deleteTag()
    {
        $data =  request()->validate([
            'tag_for_delete_id' => ['required', 'numeric', 'exists:tags,id'],
        ]);
        $tag = Tag::findOrFail($data['tag_for_delete_id']);
        $tag->delete();

        return response()->json(['success' => 'Tag Deleted Successfully']);

    }
}

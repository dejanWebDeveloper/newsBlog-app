<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchResult(Request $request)
    {
        $query = $request->input('q');

        $results = Article::where('heading', 'like', '%' . $query . '%')
            ->orWhere('preheading', 'like', '%' . $query . '%')
            ->orWhere('text', 'like', '%' . $query . '%')
            ->paginate(10);

        return view('front.search_result.search_result_page', compact('results', 'query'));
    }
}

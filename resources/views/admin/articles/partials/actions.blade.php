<div class="btn-group">
    <a class="btn btn-primary" href="{{route('admin.article.edit-article', ['article'=>$article])}}">Edit</a>
    @if($article->ban == 1)
        <button data-id="{{$article->id}}" data-name="{{$article->heading}}" data-action="update"
                type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#statusModal">Activate</button>
    @else
        <button data-id="{{$article->id}}" data-name="{{$article->heading}}" data-action="update"
                type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#statusModal">Ban</button>
    @endif
    <button data-id="{{$article->id}}" data-name="{{$article->heading}}" data-action="delete"
            type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#deleteModal">Delete
    </button>
</div>

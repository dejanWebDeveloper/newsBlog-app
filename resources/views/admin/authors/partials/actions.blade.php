<div class="btn-group">
    <a class="btn btn-primary" href="{{route('admin.author.edit-author', ['author'=>$author])}}">Edit</a>

    <button data-id="{{$author->id}}" data-name="{{$author->name}}" data-action="delete"
            type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#deleteModal">Delete
    </button>
</div>

<div class="btn-group">
    <a class="btn btn-primary" href="{{route('admin.tag.edit-tag', ['tag'=>$tag])}}">Edit</a>

    <button data-id="{{$tag->id}}" data-name="{{$tag->name}}" data-action="delete"
            type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#deleteModal">Delete
    </button>
</div>

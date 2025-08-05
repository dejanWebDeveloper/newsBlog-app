<div class="btn-group">
    <a class="btn btn-primary" href="{{route('admin.category.edit-category', ['category'=>$category])}}">Edit</a>

    <button data-id="{{$category->id}}" data-name="{{$category->name}}" data-action="delete"
            type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#deleteModal">Delete
    </button>
    </button>
</div>

<div class="btn-group dropdown">
    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        <span class="sr-only">Action</span>
    </button>
    <div class="dropdown-menu">

        <a class="dropdown-item" href="{{route('services.show',$row->id)}}">View</a>
        <a class="dropdown-item" href="{{route('services.edit',$row->id)}}">Edit</a>
       
        <form action="{{ route('services.destroy',$row->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Are you sure?')" class="dropdown-item" type="submit">Delete</button>
         
        </form>
    </div>
</div>
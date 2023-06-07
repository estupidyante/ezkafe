@section('title')
<title>EzKafe | Categories</title>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Categories</h3>
        <p class="text-muted pb-4">EzKafe / Inventory / Categories</p>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{ session('status') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        @elseif(session('failed'))
            <div class="alert alert-danger" role="alert">
                <p>{{ session('failed') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-accounts">
                <h6 class="card-header">
                    <a href="#" class="btn btn-primary float-end d-flex justify-content-center" data-mdb-toggle="modal" data-mdb-target="#addCategoryModal">
                        <span class="menu-icon">
                            <i class="mdi mdi-shape"></i>
                        </span>
                        <span>Add New Category</span>
                    </a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col"> ID </th>
                                    <th scope="col"> Name </th>
                                    <th scope="col"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $row)
                                    <tr>
                                        <td> {{$row->id}} </td>
                                        <td> {{$row->name}} </td>
                                        <td>
                                            <a href="#" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#updateCategoryModal_{{ $row->id }}">Edit</a>
                                            <form class="d-inline" action="{{ route('user.category.destroy', $row ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">
            <span class="menu-icon">
                <i class="mdi mdi mdi-coffee"></i>
            </span>
            <span>Add New Category</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new category.</p>
        <form method="POST" action="{{ route('user.category.create') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control p_input" name="name" placeholder="Enter the name" :value="name" required autofocus>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="create">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@foreach($categories as $category)
<div class="modal fade" id="updateCategoryModal_{{ $category->id }}" tabindex="-1" aria-labelledby="updateCategoryModalLabel_{{ $category->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateCategoryModalLabel_{{ $category->id }}">
            <span class="menu-icon">
                <i class="mdi mdi mdi-coffee"></i>
            </span>
            <span>Edit Existing Category</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new category.</p>
        <form method="POST" action="/user/category/{{ $category->id }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control p_input" name="name" placeholder="Enter the name" :value="name" value="{{ $category->name }}" required autofocus>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="create">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
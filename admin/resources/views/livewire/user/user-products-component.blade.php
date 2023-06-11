@section('title')
<title>EzKafe | Products</title>
@endsection
@section('page-style')
<style type="text/css">
    .category {
        display: flex;
    }
    body {
        background-color: #d2d2d2;
    }
    .categories {
        height: 500px;
    }
    .nav-tabs.table-tabs .nav-link {
        background: #ffffff;
        color: #000000;
        border:0px;
    }
    .nav-tabs.table-tabs .nav-link.active {
        background: #D9D9D9;
        color: #000000;
    }
    .card .card-body {
        padding:0px !important;
    }
    .card.card-accounts {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    .table {
        margin: 0px !important;
    }
    .table thead tr {
        border: none !important;
    }
    .tab-content {
        padding: 0px !important;
        background: #ffffff !important;
        border: none !important;
    }
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 24px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
</style>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Products</h3>
        <p class="text-muted pb-4">EzKafe / Inventory / Products</p>
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
        <div class="col-12 grid-margin categories">
            <div class="card card-accounts">
                <h6 class="card-header">
                    <a href="#" class="btn btn-primary float-end d-flex justify-content-center" data-mdb-toggle="modal" data-mdb-target="#addProductsModal">
                        <span class="menu-icon">
                            <i class="mdi mdi-plus-circle"></i>
                        </span>
                        <span>Add New Product</span>
                    </a>
                </h6>
                <div class="card-body">
                    <ul class="nav nav-tabs table-tabs pb-1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('user.products', ['id' => 0]) }}" class="nav-link {{ $selectedTab == 0 ? 'active' : '' }}" data-toggle="tab" role="tab">All</a>
                        </li>   
                        @foreach ($categories as $category)
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('user.products', ['id' => $category->id]) }}" class="nav-link {{ $selectedTab == $category->id ? 'active' : '' }}" data-toggle="tab" role="tab">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-5 tab-content">
                                <thead class="table-secondary">
                                    <tr>
                                        <th scope="col"> Image </th>
                                        <th scope="col"> Name </th>
                                        <th scope="col"> Description </th>
                                        <th scope="col"> Category </th>
                                        <th scope="col"> Ingredients </th>
                                        <th scope="col"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $item)
                                    @foreach ($item->products as $element)
                                        @if ($selectedTab == 0)
                                        <tr class="tab-pane">
                                            <td> {{ $item->image }} </td>
                                            <td> {{ $element->name }} </td>
                                            <td> {{ $element->description }} </td>
                                            <td> {{ $item->find($element->category_id)->name }} </td>
                                            <td>
                                                @if ($element->ing_ids != "")
                                                    @foreach(explode(',', $element->ing_ids) as $ing_id) 
                                                        {{ $ingredients->find($ing_id)->name }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#updateProductsModal_{{ $element->id }}">Edit</a>
                                                <form class="d-inline" action="{{ route('user.product.destroy', $element ) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @elseif ($selectedTab == $item->id && $item->id == $element->category_id)
                                        <tr class="tab-pane">
                                            <td> {{ $item->image }} </td>
                                            <td> {{ $element->name }} </td>
                                            <td> {{ $element->description }} </td>
                                            <td> {{ $item->find($element->category_id)->name }} </td>
                                            <td>
                                                @if ($element->ing_ids != "")
                                                    @foreach(explode(',', $element->ing_ids) as $ing_id) 
                                                        {{ $ingredients->find($ing_id)->name }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#updateProductsModal_{{ $element->id }}">Edit</a>
                                                <form class="d-inline" action="{{ route('user.product.destroy', $element ) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addProductsModal" tabindex="-1" aria-labelledby="addProductsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductsModalLabel">
            <span class="menu-icon">
                <i class="mdi mdi-delete-variant"></i>
            </span>
            <span>Add New Product</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new ingredient.</p>
        <form method="POST" action="{{ route('user.product.create') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control p_input" name="name" placeholder="Enter the name" :value="name" required autofocus>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control p_input" name="description" placeholder="Enter the description" :value="description" required autofocus>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Ingredients</label>
                <select class="form-control" name="ing[]" multiple>
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input class="form-control" type="file" placeholder="{{ __('Image') }}" name="uploads" required autofocus>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="create">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@foreach($products as $product)
<div class="modal fade" id="updateProductsModal_{{ $product->id }}" tabindex="-1" aria-labelledby="updateProductsModalLabel_{{ $product->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProductsModalLabel_{{ $product->id }}">
            <span class="menu-icon">
                <i class="mdi mdi-delete-variant"></i>
            </span>
            <span>Edit Existing Product</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new product.</p>
        <form method="POST" action="/user/product/{{ $product->id }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control p_input" name="name" placeholder="Enter the name" :value="name" value="{{ $product->name }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control p_input" name="description" placeholder="Enter the description" :value="description" value="{{ $product->description }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{$category->id == $product->category_id  ? 'selected' : ''}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Ingredients</label>
                <select class="form-control" name="ing[]" multiple>
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input class="form-control" type="file" placeholder="{{ __('Image') }}" name="uploads" required autofocus>
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
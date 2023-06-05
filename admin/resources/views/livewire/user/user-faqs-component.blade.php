@section('title')
<title>EzKafe | FAQs</title>
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
        <h3 class="text-dark">Frequently Asked Questions (F.A.Q.)</h3>
        <p class="text-muted pb-4">Here is the list of the frequently asked questions</p>
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
                    <a href="#" class="btn btn-primary float-end d-flex justify-content-center" data-mdb-toggle="modal" data-mdb-target="#addQuestionModal">
                        <span class="menu-icon">
                            <i class="mdi mdi-plus-circle"></i>
                        </span>
                        <span>Add New Question</span>
                    </a>
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col"> # </th>
                                    <th scope="col"> Category </th>
                                    <th scope="col"> Question </th>
                                    <th scope="col"> </th>
                                    <th scope="col"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $question)
                                    <tr>
                                        <td> {{$question->id}} </td>
                                        <td> {{ $categories->find($question->categories_id)->name }} </td>
                                        <td> {{$question->question}} </td>
                                        <td> 
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#updateQuestionModal_{{ $question->id }}">Edit</a>
                                            <form class="d-inline" action="{{ route('user.faq.destroy', $question ) }}" method="POST">
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
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addQuestionModalLabel">
            <span class="menu-icon">
                <i class="mdi mdi mdi-frequently-asked-questions"></i>
            </span>
            <span>Add New Question</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new admin question.</p>
        <form method="POST" action="{{ route('user.faq.create') }}">
            @csrf
            <div class="form-group">
                <label>Question</label>
                <textarea id="question" name="question" rows="4" cols="50" :value="question" required autofocus></textarea>
                <!-- <input type="text" class="form-control p_input" name="question" placeholder="Enter the question" :value="question" required autofocus> -->
            </div>
            <div class="form-group">
                <label>Answer</label>
                <textarea id="answer" name="answer" rows="4" cols="50" :value="answer" required autofocus></textarea>
                <!-- <textarea type="text" class="form-control p_input" name="answer" placeholder="Enter the answer" :value="answer" required autofocus> -->
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="register">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
@foreach ($faqs as $faq)
<div class="modal fade" id="updateQuestionModal_{{ $faq->id }}" tabindex="-1" aria-labelledby="updateQuestionModal_{{ $faq->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateQuestionModalLabel_{{ $faq->id }}">
            <span class="menu-icon">
                <i class="mdi mdi mdi-frequently-asked-questions"></i>
            </span>
            <span>Edit Existing Question</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new admin question.</p>
        <form method="POST" action="/user/faq/{{ $faq->id }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Question</label>
                <textarea id="question" name="question" rows="4" cols="50" :value="question" required autofocus>{{ $faq->question }}</textarea>
            </div>
            <div class="form-group">
                <label>Answer</label>
                <textarea id="answer" name="answer" rows="4" cols="50" :value="answer" required autofocus>{{ $faq->answer }}</textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"  {{$category->id == $faq->categories_id  ? 'selected' : ''}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="register">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
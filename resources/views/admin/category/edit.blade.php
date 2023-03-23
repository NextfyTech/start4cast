@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('update',$data->spl_category_id)}}" method="POST" enctype="multipart/form-data">
    <h3>Edit Categories</h3>
    @csrf
 <fieldset>
  <legend>Add Data - Special Categories</legend>
  

  </div>
  <div class="form-group">
  <div class=" row">
    <label for="specialCategory" class="col-sm-3">Special Category:</label>
    <div class="col">
      <input type="text" class="form-control" name="spl_category" id="spl_category" value="{{$data->spl_category}}">
    </div>
  </div>
<button class="btn btn-primary" type="submit">Update Data</button>

</form>
@endsection

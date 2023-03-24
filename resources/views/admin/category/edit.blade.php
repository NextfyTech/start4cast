@extends('home')

@section('content')

<div class="container-fluid">
<form class="form-horizontal" action="{{route('update',$data->spl_category_id)}}" method="POST" enctype="multipart/form-data">
    <h3>Edit Categories</h3>
    @csrf


  </div>
  <div class="form-group">
  <div class=" row">
    <label class="control-label col-sm-2" for="specialCategory" class="col-sm-3">Special Category:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="spl_category" id="spl_category" value="{{$data->spl_category}}">
    </div>
  </div>
<button class="btn btn-primary" type="submit">Update Data</button>

</form>
</div>
@endsection

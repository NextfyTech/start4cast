@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('Data_Manager.daily')}}" method="POST" enctype="multipart/form-data">
  @csrf
    <h3>Add Daily Data - Data Manager</h3>
    <div class="form-group">
    <label for="day" class="col-sm-4">Day:</label>
    <input type="hidden" class="form-control" id="data_type" name="data_type" value="day">
      <input type="date" class="form-control" id="day" name="day">
    </div>
  
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File:</label>
  <input class="form-control" type="file" name="data_upload" id="formFile">
</div>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
@extends('home')

@section('content')

<form class="form-horizontal" action="/action_page.php">
    <h3>Add Daily Data - Data Manager</h3>
    <div class="form-group">
    <label for="day" class="col-sm-4">Day:</label>
    
      <input type="date" class="form-control" id="day value="">
    </div>
  
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File:</label>
  <input class="form-control" type="file" id="formFile">
</div>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
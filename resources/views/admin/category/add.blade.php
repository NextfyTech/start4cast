@extends('home')

@section('content')

<form class="form-horizontal" action="/action_page.php">
    <h3>Add Data - Special Categories</h3>
  <div class="form-group">
  <label for="Category">Category:</label>
      <select id="category" class="form-control">
        <option selected>Choose...</option>
        <option>Health</option>
        <option>Wealth</option>
      </select>
    
  </div>
  <div class="form-group">
  <label for="year">Year:</label>
      <select id="year" class="form-control">
        <option selected>Choose...</option>
        <option>2012</option>
        <option>2013</option>
        <option>2014</option>
        <option>2015</option>
      </select>
  </div>
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File</label>
  <input class="form-control" type="file" id="formFile">
</div>
<button class="btn btn-primary" type="submit">Submit form</button>
</form>
@endsection
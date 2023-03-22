@extends('home')

@section('content')

<form class="form-horizontal" action="/action_page.php">
    <h3>Add Monthly Data - Data Manager</h3>
  <div class="form-group">
  <label for="year">Change Year:</label>
      <select id="year" class="form-control">
        <option selected>Choose...</option>
        <option>2013</option>
        <option>2014</option>
        <option>2015</option>
        <option>2016</option>
        <option>2017</option>
        <option>2018</option>
        <option>2019</option>
        <option>2020</option>
      </select>
    
  </div>
  <div class="form-group">
  <label for="week">Month:</label>
      <select id="month" class="form-control">
        <option selected>Choose...</option>
        <option>January</option>
        <option>February</option>
        <option>March</option>
        <option>April</option>
        <option>May</option>
        <option>June</option>
        <option>July</option>
        <option>August</option>
        <option>September</option>
        <option>October</option>
        <option>November</option>
        <option>December</option>
      </select>
  </div>
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File</label>
  <input class="form-control" type="file" id="formFile">
</div>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
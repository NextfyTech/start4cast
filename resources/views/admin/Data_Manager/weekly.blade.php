@extends('home')

@section('content')

<form class="form-horizontal" action="/action_page.php">
    <h3>Add Weekly Data - Data Manager</h3>
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
  <label for="week">week:</label>
      <select id="week" class="form-control">
        <option selected>Choose...</option>
        <option>week 01:02 jan-08 jan</option>
        <option>week 02:09 jan-15 jan</option>
        <option>week 03:016 jan-22 jan</option>
        <option>week 04:023 jan-29 jan</option>
        <option>week 05:30 jan-05 jan</option>
      </select>
  </div>
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File</label>
  <input class="form-control" type="file" id="formFile">
</div>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
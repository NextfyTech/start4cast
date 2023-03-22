@extends('home')

@section('content')

<form class="form-horizontal" action="/action_page.php">
    <h3>View Special Data - Data Manage</h3>
 

  <div class="form-group">
  <label for="starSign">Select Star Sign:</label>
      <select id="starSign" class="form-control">
        <option selected>All</option>
        <option>Aries</option>
        <option>Taurus</option>
        <option>Gemini</option>
      </select>
    
</div>

<div class="form-group">
  <label for="selctType">Select Type:</label>
      <select id="selctTyp" class="form-control">
        <option selected>Choose...</option>
        <option>Daily</option>
        <option>Weekly</option>
        <option>Monthly</option>
        <option>Yearly</option>
      </select>
    
  </div>

  <div class="form-group">
    <label for="day" class="col-sm-4">Day:</label>
    
      <input type="date" class="form-control" id="day" value="">
    </div>
  
<button class="btn btn-primary" type="submit">Search</button>
</form>
<hr>
<table class="table">
    <thead>
      <tr>
        <th>Data From</th>
        <th>Data To</th>
        <th>Star Sign</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>1</td>
        <td>Health</td>
        <td>abcd</td>
      </tr>
      
    </tbody>
  </table>
@endsection
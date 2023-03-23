@extends('home')

@section('content')

<form class="form-horizontal" action="/action_page.php">
    <h3>View Special Data - Data Manage</h3>
  <div class="form-group">
  <label for="Category">Category:</label>
      <select id="category" class="form-control">
        <option selected>Choose...</option>
        @foreach($category_list as $master)
        <option value="{{$master['spl_category_id']}}">{{$master->spl_category}}</option>
      @endforeach
        
      </select>
    
  </div>

  <div class="form-group">
  <label for="starSign">Select Star Sign:</label>
      <select id="starSign" class="form-control">
        <option selected>All</option>
        @foreach($star_sign_master as $master)
        <option value="{{$master['id']}}">{{$master->starsign}}</option>
      @endforeach
      </select>
    
</div>

  <div class="form-group">
  <label for="year">Year:</label>
      <select id="year" class="form-control">
        <option selected>Choose...</option>
        
      </select>
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

  <script>
    
@endsection

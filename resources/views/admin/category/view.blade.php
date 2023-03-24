@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('search')}}">
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
      @if(isset($data))
      @foreach($data as $d)
      <tr>
        <td>{{ $d->spl_data_from }}</td>
        <td>{{ $d->spl_data_to}}</td>
        @php 
        $name =  DB::table('horosco_starsign_master')->where('star_sign_id',$d->starsign)->first();
        @endphp
        <td>{{ $name->starsign }}</td>
        <td>{{ $d->data}}</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>

  <script>
    
@endsection

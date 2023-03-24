@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('searchSpecialData')}}">
    <h3>View Special Data - Data Manage</h3>
 

    <div class="form-group">
  <label for="starSign">Select Star Sign:</label>
      <select id="starSign" name='starsign_id' class="form-control">
        @foreach($star_sign_master as $master)
        <option value="{{$master['starsign_id']}}">{{$master->starsign}}</option>
      @endforeach
      </select>
    
</div>  

<div class="form-group">
  <label for="selctType">Select Type:</label>
      <select id="selctTyp" name="data_type" class="form-control">
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
      @if(isset($data))
      @foreach($data as $d)
      <tr>
        <td>{{ $d->spl_date_from }}</td>
        <td>{{ $d->spl_date_to}}</td>
        @php 
        $name =  DB::table('horosco_starsign_master')->where('starsign_id',$d->starsign_id)->first();
        @endphp
        <td>{{ $name->starsign}}</td>
        <td>{{ $d->data}}</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
@endsection
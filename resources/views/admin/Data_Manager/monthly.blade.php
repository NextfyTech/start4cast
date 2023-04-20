@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('Data_Manager.monthly')}}" method="POST" enctype="multipart/form-data">
  @csrf
    <h3>Add Monthly Data - Data Manager</h3>
    @if (count($errors) > 0)
  @foreach ($errors->all() as $error)
  <p class="alert alert-danger">{{ $error}}  </p>
  @endforeach
  @endif
  @if (session('error'))
  <div class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
  @endif
  @if (session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif
  <div class="form-group">
  <label for="year">Change Year:</label>
      <select id="year" name="year_data" class="form-control">
        @if(false)
        <option selected>Choose...</option>
        @endif
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023" selected>2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
       <option value="2026">2026</option>
       <option value="2027">2027</option>
       <option value="2028">2028</option>
       <option value="2029">2029</option>
       <option value="2030">2030</option>
      <option value="2031">2031</option>
      <option value="2032">2032</option>
      <option value="2033">2033</option>
      </select>

  </div>
  <div class="form-group">
  <label for="week">Month:</label>
      <select id="month" name="month_data" class="form-control">
        <option selected>Choose...</option>
        <option value="01-01#01-31">January</option>
        <option value="02-01#02-31">February</option>
        <option value="03-01#03-31">March</option>
        <option value="04-01#04-31">April</option>
        <option value="05-01#05-31">May</option>
        <option value="06-01#06-31">June</option>
        <option value="07-01#07-31">July</option>
        <option value="08-01#08-31">August</option>
        <option value="09-01#09-31">September</option>
        <option value="10-01#10-31">October</option>
        <option value="11-01#11-31">November</option>
        <option value="12-01#12-31">December</option>
      </select>
  </div>
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File</label>
  <input class="form-control" type="file" name="csv_file" id="formFile">
</div>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection

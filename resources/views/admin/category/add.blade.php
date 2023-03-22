@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('category.data_index')}}" method="POST" enctype="multipart/form-data">
    <h3>Add Data - Special Categories</h3>
    @csrf
 <fieldset>
  <legend>Add Data - Special Categories</legend>
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
  <label for="Category">Category:</label>
      <select id="category" name="spl_category_id" class="form-control">
        <option selected>Choose...</option>
        @foreach($spl_category as $list)
<option value="{{$list['spl_category_id']}}">{{$list['spl_category']}}</option>
@endforeach
      </select>
    
  </div>
  <div class="form-group">
  <label for="year">Year:</label>
  <select id="year" name="timePeriod" class="form-control">
  <option selected>Choose...</option>
<option value="2013-01-01">2013</option>
<!-- <option value="2014-01-01#2014-12-31">2014</option>
<option value="2015-01-01#2015-12-31">2015</option>
<option value="2016-01-01#2016-12-31">2016</option>
<option value="2017-01-01#2017-12-31">2017</option>
<option value="2018-01-01#2018-12-31">2018</option>
<option value="2019-01-01#2019-12-31">2019</option>
<option value="2020-01-01#2020-12-31">2020</option>
<option value="2021-01-01#2021-12-31">2021</option>
<option value="2022-01-01#2022-12-31">2022</option>
<option value="2023-01-01#2023-12-31">2023</option>
<option value="2024-01-01#2024-12-31">2024</option>
<option value="2025-01-01#2025-12-31">2025</option>
<option value="2026-01-01#2026-12-31">2026</option>
<option value="2027-01-01#2027-12-31">2027</option>
<option value="2028-01-01#2028-12-31">2028</option>
<option value="2029-01-01#2029-12-31">2029</option>
<option value="2030-01-01#2030-12-31">2030</option>
<option value="2031-01-01#2031-12-31">2031</option>
<option value="2032-01-01#2032-12-31">2032</option>
<option value="2033-01-01#2033-12-31">2033</option> -->
      </select>
  </div>
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File</label>
  <input class="form-control" name="csv_file" type="file" id="csv_file">
</div>
<button class="btn btn-primary" type="submit">Submit form</button>

</form>
@endsection
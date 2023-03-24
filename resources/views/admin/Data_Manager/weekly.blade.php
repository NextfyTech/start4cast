@extends('home')

@section('content')

<form class="form-horizontal" action="{{route('Data_Manager.weekly')}}" method="POST" enctype="multipart/form-data">
  @csrf
    <h3>Add Weekly Data - Data Manager</h3>
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
<option selected>Choose...</option>
<option value="2013-01-01">2013</option>
 <option value="2014-01-01#2014-12-31">2014</option>
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
<option value="2033-01-01#2033-12-31">2033</option>
      </select>
    
  </div>
  <div class="form-group">
  <label for="week">week:</label>
   <select id="timePeriod" name="timePeriod">
    <option value="2014-12-29#2015-01-04">Week 01 : 29 Dec - 04 Jan</option>
    <option value="2015-01-05#2015-01-11">Week 02 : 05 Jan - 11 Jan</option>
    <option value="2015-01-12#2015-01-18">Week 03 : 12 Jan - 18 Jan</option>
    <option value="2015-01-19#2015-01-25">Week 04 : 19 Jan - 25 Jan</option>
    <option value="2015-01-26#2015-02-01">Week 05 : 26 Jan - 01 Feb</option>
    <option value="2015-02-02#2015-02-08">Week 06 : 02 Feb - 08 Feb</option>
    <option value="2015-02-09#2015-02-15">Week 07 : 09 Feb - 15 Feb</option>
    <option value="2015-02-16#2015-02-22">Week 08 : 16 Feb - 22 Feb</option>
    <option value="2015-02-23#2015-03-01">Week 09 : 23 Feb - 01 Mar</option>
    <option value="2015-03-02#2015-03-08">Week 10 : 02 Mar - 08 Mar</option>
    <option value="2015-03-09#2015-03-15">Week 11 : 09 Mar - 15 Mar</option>
    <option value="2015-03-16#2015-03-22">Week 12 : 16 Mar - 22 Mar</option>
    <option value="2015-03-23#2015-03-29">Week 13 : 23 Mar - 29 Mar</option>
    <option value="2015-03-30#2015-04-05">Week 14 : 30 Mar - 05 Apr</option>
    <option value="2015-04-06#2015-04-12">Week 15 : 06 Apr - 12 Apr</option>
    <option value="2015-04-13#2015-04-19">Week 16 : 13 Apr - 19 Apr</option>
    <option value="2015-04-20#2015-04-26">Week 17 : 20 Apr - 26 Apr</option>
    <option value="2015-04-27#2015-05-03">Week 18 : 27 Apr - 03 May</option>
    <option value="2015-05-04#2015-05-10">Week 19 : 04 May - 10 May</option>
    <option value="2015-05-11#2015-05-17">Week 20 : 11 May - 17 May</option>
    <option value="2015-05-18#2015-05-24">Week 21 : 18 May - 24 May</option>
    <option value="2015-05-25#2015-05-31">Week 22 : 25 May - 31 May</option>
    <option value="2015-06-01#2015-06-07">Week 23 : 01 Jun - 07 Jun</option>
    <option value="2015-06-08#2015-06-14">Week 24 : 08 Jun - 14 Jun</option>
    <option value="2015-06-15#2015-06-21">Week 25 : 15 Jun - 21 Jun</option>
    <option value="2015-06-22#2015-06-28">Week 26 : 22 Jun - 28 Jun</option>
    <option value="2015-06-29#2015-07-05">Week 27 : 29 Jun - 05 Jul</option>
    <option value="2015-07-06#2015-07-12">Week 28 : 06 Jul - 12 Jul</option>
    <option value="2015-07-13#2015-07-19">Week 29 : 13 Jul - 19 Jul</option>
    <option value="2015-07-20#2015-07-26">Week 30 : 20 Jul - 26 Jul</option>
    <option value="2015-07-27#2015-08-02">Week 31 : 27 Jul - 02 Aug</option>
    <option value="2015-08-03#2015-08-09">Week 32 : 03 Aug - 09 Aug</option>
    <option value="2015-08-10#2015-08-16">Week 33 : 10 Aug - 16 Aug</option>
    <option value="2015-08-17#2015-08-23">Week 34 : 17 Aug - 23 Aug</option>
    <option value="2015-08-24#2015-08-30">Week 35 : 24 Aug - 30 Aug</option>
    <option value="2015-08-31#2015-09-06">Week 36 : 31 Aug - 06 Sep</option>
    <option value="2015-09-07#2015-09-13">Week 37 : 07 Sep - 13 Sep</option>
    <option value="2015-09-14#2015-09-20">Week 38 : 14 Sep - 20 Sep</option>
    <option value="2015-09-21#2015-09-27">Week 39 : 21 Sep - 27 Sep</option>
    <option value="2015-09-28#2015-10-04">Week 40 : 28 Sep - 04 Oct</option>
    <option value="2015-10-05#2015-10-11">Week 41 : 05 Oct - 11 Oct</option>
    <option value="2015-10-12#2015-10-18">Week 42 : 12 Oct - 18 Oct</option>
    <option value="2015-10-19#2015-10-25">Week 43 : 19 Oct - 25 Oct</option>
    <option value="2015-10-26#2015-11-01">Week 44 : 26 Oct - 01 Nov</option>
    <option value="2015-11-02#2015-11-08">Week 45 : 02 Nov - 08 Nov</option>
    <option value="2015-11-09#2015-11-15">Week 46 : 09 Nov - 15 Nov</option>
    <option value="2015-11-16#2015-11-22">Week 47 : 16 Nov - 22 Nov</option>
    <option value="2015-11-23#2015-11-29">Week 48 : 23 Nov - 29 Nov</option>
    <option value="2015-11-30#2015-12-06">Week 49 : 30 Nov - 06 Dec</option>
    <option value="2015-12-07#2015-12-13">Week 50 : 07 Dec - 13 Dec</option>
    <option value="2015-12-14#2015-12-20">Week 51 : 14 Dec - 20 Dec</option>
    <option value="2015-12-21#2015-12-27">Week 52 : 21 Dec - 27 Dec</option>
    <option value="2015-12-28#2016-01-03">Week 53 : 28 Dec - 03 Jan</option>
  		</select>
  </div>
  <div  class="form-group mb-3">
  <label for="formFile" class="form-label">Data File</label>
  <input class="form-control" type="file" id="formFile" name="csv_file">
</div>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
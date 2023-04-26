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
                <option value="0">Choose...</option>
                @php
                    $currentYear = date('Y');
                    $years = range($currentYear - 10, $currentYear + 10);
                @endphp
                @foreach($years as $yea)
                    <option value="{{$yea}}" @if($yea == $currentYear) selected @endif>{{$yea}}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="week">week:</label>
            <select id="timePeriod" class="form-select" name="timePeriod">

            </select>
        </div>
        <div class="form-group mb-3">
            <label for="formFile" class="form-label">Data File</label>
            <input class="form-control" type="file" id="formFile" name="csv_file">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection

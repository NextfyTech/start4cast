@extends('home')
@section('content')
    <form class="form-horizontal" action="{{route('Data_Manager.daily')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Add Daily Data - Data Manager</h3>
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
        @if (session('fail'))
            <div class="alert alert-warning" role="alert">
                {{ session('fail') }}
            </div>
        @endif
        <div class="form-group">
            <label for="date" class="form-label">Select a Date:</label>
            <input type="text" id="date" name="day" class="form-control" placeholder="dd/mm/yyyy" />
            {{--            <label for="day" class="col-sm-4">Day:</label>--}}
{{--            <!-- <input type="hidden" class="form-control" id="data_type" name="data_type" value="day"> -->--}}
            <input type="hidden" class="form-control" id="day" name="day" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" required>
        </div>

        <div class="form-group mb-3">
            <label for="formFile" class="form-label">Data File:</label>
            <input class="form-control" type="file" name="csv_file" id="formFile">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection

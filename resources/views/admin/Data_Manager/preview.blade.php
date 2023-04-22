@extends('home')

@section('content')

    <form class="form-horizontal" action="{{route('dataPreview')}}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">Submit</button>
        <input type="hidden" name="date_from" value="{{$date_from}}">
        <input type="hidden" name="date_to" value="{{$date_to}}">
        <table class="table table-bordered">
            @if(isset($data))
                @foreach($data as $key => $value)
                    @php
                      $arrKeys = array_keys($value);
                      $arrValues = array_values($value);
                    @endphp
                <tr>
                    <td>
                        <input type="hidden" name="starsign[]" value="{{$arrKeys[0]}}">
                        {{$arrKeys[0]}}
                    </td>
                    <td>
                    <textarea name="content[]" class="form-control" rows="5">
                        {{$arrValues[0]}}
                    </textarea>
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </form>
@endsection

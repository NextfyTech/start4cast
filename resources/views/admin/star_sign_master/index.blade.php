@extends('home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Horoscope - Star Sign Master</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Horoscope - Star Sign Master</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Star Sign</th>
                            <th>Date Range</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('star_sign_master.index') }}",
                columns: [
                    {data: 'starsign', name: 'starsign'},
                    {data: 'starsign_date_range', name: 'starsign_date_range'},

                ],
            });
        });
    </script>
@endsection

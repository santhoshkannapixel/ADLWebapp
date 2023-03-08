@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                City List
            </div>
            @if (permission_check('CITY_SYNC'))
            <form action="{{ route('city.sync') }}" method="POST">
                @csrf
                <small><b>Last Sync</b> :  {{ $last_sync }}</small>
                <button type="submit" class="btn btn-primary ms-3">
                    <i class="fa fa-refresh me-2" aria-hidden="true"></i>
                    Sync Data</button>
            </form>
            @endif
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>CityID </th>
                        <th>CityName</th>
                        <th>AreaId </th>
                        <th>AreaName</th>
                        <th>Pincode</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('#data-table').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('city.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"CityID", name : "CityID"},
                    {data:"CityName", name : "CityName"},
                    {data:"AreaId", name : "AreaId"},
                    {data:"AreaName", name : "AreaName"},
                    {data:"Pincode", name : "Pincode"},
                    {data:"State", name : "State"},
                ],
            });
        });
    </script>  
@endsection
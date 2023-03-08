@extends('admin.master.layout')

@section('admin_master_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Lab Test & Packages List
            </div>
            @if (permission_check('TEST_SYNC'))
            <form action="{{ route('test.sync') }}" method="POST">
                @csrf
                <small><b>Last Sync</b> : {{ $last_sync }}</small>
                <button type="submit" class="btn btn-primary ms-3">
                    <i class="fa fa-refresh me-2" aria-hidden="true"></i>
                    Sync Data</button>
            </form>
            @endif
        </div>
        <div class="card-body">
            <ul class="nav nav-pills m-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button onclick="isPackage('No')" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Test</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button onclick="isPackage('Yes')" class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Packages</button>
                </li>
            </ul>
            <table class="table table-bordered  table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th>S.No </th>
                        <th>Test Id</th>
                        <th>Test Name</th>
                        <th>Applicable Gender</th>
                        <th>Is Home</th>
                        <th>Classifications</th>
                        <th>Drive Through</th>
                        <th>Home Collection</th>
                        <th>Test Schedule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            LoadData = (data) => {
                var table = $('#data-table').DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('test.index') }}",
                        data: {
                            isPackage: data
                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "TestId",
                            name: "TestId"
                        },
                        {
                            data: "TestName",
                            name: "TestName"
                        },
                        {
                            data: "Applicable_Gender",
                            name: "ApplicableGender"
                        },
                        {
                            data: "is_home",
                            name: "is_home"
                        },
                        {
                            data: "Classifications",
                            name: "Classifications"
                        },
                        {
                            data: "Drive_Through",
                            name: "DriveThrough"
                        },
                        {
                            data: "Home_Collection",
                            name: "HomeCollection"
                        },
                        {
                            data: "Test_Schedule",
                            name: "TestSchedule"
                        },
                        {
                            data: "action",
                            name: "action"
                        },
                    ],
                });
            }
            LoadData('No')
            isPackage = (data) => {
                console.log(data)
                $('#data-table').DataTable().destroy();
                LoadData(data);
            }
        });
        function isHomeStatusChange (id)
        {
            var  table = $('#data-table').DataTable();
            swal({
            text: "Do you want to change the status?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn-light rounded-pill btn",
                    closeModal: true,
                },
                confirm: {
                    text: "Yes! Change",
                    value: true,
                    visible: true,
                    className: "btn btn-danger rounded-pill",
                    closeModal: true
                }
            },
        }).then((isConfirm) => {
            if (isConfirm) {
                $.ajax({
                url: "{{ route('test.is_home') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(res) {
                    table.ajax.reload();
                }
            })
            }
        });
            
        }

    </script>
@endsection

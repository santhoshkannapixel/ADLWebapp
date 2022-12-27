@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
    <div class="p-1 mb-3">
        <div class="mb-1 lead"><strong>Welcome  <b class="text-gradient">{{ Sentinel::getUser()->name }}</b></strong></div>
        <span><b class="text-dark">Role :</b> <span class="badge bg-gradient">{{ Sentinel::getUser()->roles[0]->name }}</span></span>
    </div>
    <div class="row m-0">
        <div class="col-3 p-1">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="h4 text-gradient"> <span id="total_test"></span> </div>
                    <div class="x-between y-center">
                        <b class="text-secondary">Total Tests</b>
                        <i class="text-primary fa fa-flask fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-1">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="h4 text-gradient"><span id="total_package"></span></div>
                    <div class="x-between y-center">
                        <b class="text-secondary">Total Packages</b>
                        <i class="text-primary bi bi-box fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-1">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="h4 text-gradient"><span id="total_order"></span></div>
                    <div class="x-between y-center">
                        <b class="text-secondary">Total Orders</b>
                        <i class="text-primary fa fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 p-1">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="h4 text-gradient"><span id="total_customer"></span></div>
                    <div class="x-between y-center">
                        <span>Total Customers</span>
                        <i class="text-primary bi bi-person-lines-fill fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card card-body shadow-sm">
                <div class="x-between y-center">
                    <div>
                        <div class="h4 text-success">452</div>
                        <div><b>Received Payments</b></div>
                    </div>
                    <i class="fa-2x bi bi-credit-card-fill text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card card-body shadow-sm">
                <div class="x-between y-center">
                    <div>
                        <div class="h4 text-warning">18</div>
                        <div><b>Pending Payments</b></div>
                    </div>
                    <i class="fa-2x bi bi-credit-card-fill text-warning"></i>
                </div>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card card-body shadow-sm">
                <div class="x-between y-center">
                    <div>
                        <div class="h4 text-danger">3</div>
                        <div><b>Failed Payments</b></div>
                    </div>
                    <i class="fa-2x bi bi-credit-card-fill text-danger"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card custom table-card m-1 mt-2">
        <div class="card-header">
            <div class="card-title">
                All Enquiries
            </div>
            <div class="btn-group input-daterange m-0">
                <button type="button" name="refresh" id="refresh" class="btn btn-warning form-control-sm"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                <select name="search_data" id="search_data" class="form-select selectpicker">
                    <option value="">-- Search Enquiry  --</option>
                    <option value="BOOK_HOME_COLLECTION_LIST">BOOK HOME COLLECTION LIST</option>
                    <option value="PATIENTS_CONSUMERS_LIST">PATIENTS CONSUMERS LIST</option>
                    <option value="FEEDBACK_LIST">FEEDBACK LIST</option>
                    <option value="FREQUENTLY_ASKED_QUESTIONS_LIST">FREQUENTLY ASKED QUESTIONS LIST</option>
                    <option value="HOSPITAL_LAB_MANAGEMENT">HOSPITAL LAB MANAGEMENT</option>
                    <option value="CLINICAL_LAB_MANAGEMENT">CLINICION LAB MANAGEMENT</option>
                    <option value="FRANCHISING_OPPORTUNITIES">FRANCHISING OPPORTUNITIES</option>
                    <option value="RESEARCH">RESEARCH</option>
                    <option value="BOOK_AN_APPOINTMENT">BOOK AN APPOINTMENT</option>
                    <option value="HEAD_OFFICE">HEAD OFFICE</option>
                </select>
                
                <input type="text" name="from_date" id="from_date" class="btn form-control form-control-sm text-start" placeholder="From Date" readonly />
                <input type="text" name="to_date" id="to_date" class="btn form-control form-control-sm text-start" placeholder="To Date" readonly />
                <button type="button" name="filter" id="filter" class="btn btn-primary form-control-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="data-table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){           
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });
            $.ajax({
                type:'GET',
                url: "{{ route('dashboard.data') }}",
                success: function(data){
                    $('#total_test').html(data.data.test);
                    $('#total_package').html(data.data.package);
                    $('#total_order').html(data.data.order);
                    $('#total_customer').html(data.data.customer);
                }
            });
            function load_data(from_date = '', to_date = '',search_data = '')    {
                $('#data-table').DataTable({
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('dashboard.index') }}",
                        data:{from_date:from_date, to_date:to_date,search_data:search_data}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                        {data: 'Name', Name: 'name'},
                        {data: 'Email', name: 'Email'},
                        {data: 'Mobile', name: 'Mobile'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                });
            } load_data();

            $('#filter').click(function(){
                var from_date   =   $('#from_date').val();
                var to_date     =   $('#to_date').val();
                var search_data =   $('#search_data').val();
                if(from_date != '' &&  to_date != '')        {
                    $('#data-table').DataTable().destroy();
                    load_data(from_date, to_date,search_data);
                }else{

                    toastr.error("Both Date is required")
                }
            });

            $('#refresh').click(function(){
                $('#search_data').val('');
                $('#from_date').val('');
                $('#to_date').val('');
                $('#data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection

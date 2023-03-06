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
                        <div class="h4 text-success"><span id="received_payment"></span> </div>
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
                        <div class="h4 text-warning"><span id="pending_order"></span> </div>
                        <div><b>Pending Order</b></div>
                    </div>
                    <i class="fa-2x bi bi-credit-card-fill text-warning"></i>
                </div>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card card-body shadow-sm">
                <div class="x-between y-center">
                    <div>
                        <div class="h4 text-danger"><span id="failed_payment"></span> </div>
                        <div><b>Failed Payments</b></div>
                    </div>
                    <i class="fa-2x bi bi-credit-card-fill text-danger"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card custom table-card m-1 mt-2">
        <div class="card-header">
            <div class="row m-0 align-items-center w-100">
                <div class="col-3 p-0">
                    <div class="card-title">
                        All Enquiries
                    </div>
                </div>
                <div class="col p-0 text-end">
                    <div class="input-group input-daterange m-0">
                        <form method="POST" name="dashboard_export" action="{{ route('dashboard.export') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="export_enquiry" id="export_enquiry" value="">
                            <button type="submit" id="dashboardExport" class="btn btn-primary" >Export</button>
                        </form>
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
                            <option value="HEAD_OFFICE">HEALTHCHECKUP FOR EMPLOYEES</option>
                            {{-- <option value="CUSTOMERS">CUSTOMERS</option> --}}
                            <option value="CAREER_ENQUIRY">CAREER ENQUIRIES</option>
                            <option value="CONTACT_LIST">CONTACT LIST</option>
                        </select>

                        <input type="text" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>" class="btn form-control form-control-sm text-start" placeholder="From Date" readonly />
                        <input type="text" name="to_date" id="to_date"  value="<?php echo date('Y-m-d'); ?>" class="btn form-control form-control-sm text-start" placeholder="To Date" readonly />
                        <button type="button" name="filter" id="filter" class="btn btn-primary form-control-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
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
                        <th>Type</th>
                        <th>Status</th>
                        <th>Remarks</th>
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
                    $('#received_payment').html(data.data.received_payment);
                    $('#pending_order').html(data.data.pending_order);
                    $('#failed_payment').html(data.data.failed_payment);
                }
            });         
            function load_data(from_date = '', to_date = '',search_data = '')    {
                var from_date   =   $('#from_date').val();
                var to_date     =   $('#to_date').val();
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
                        {data: 'type', name: 'type'},
                        {data: 'status', name: 'status'},
                        {data: 'remark', name: 'remark'},
                    ],
                });
            } load_data();
            $('#dashboardExport').click(function(){
                var search_data =   $('#search_data').val();
                if(search_data == '')
                {
                    toastr.error("Please Select Enquiry")
                    return false;
                }
                else{
                    $('#export_enquiry').val(search_data);
                }

            });
            $('#filter').click(function(){
                var from_date   =   $('#from_date').val();
                var to_date     =   $('#to_date').val();
                var search_data =   $('#search_data').val();
                $('#export_enquiry').val(search_data);
                if(from_date != '' &&  to_date != '')        {
                    $('#data-table').DataTable().destroy();
                    load_data(from_date, to_date,search_data);
                }else{

                    toastr.error("Both Date is required")
                }
            });
            
            $('#refresh').click(function(){

                var tdate = new Date();
                var dd = tdate.getDate(); //yields day
                var MM = tdate.getMonth(); //yields month
                var yyyy = tdate.getFullYear(); //yields year
                var currentDate= yyyy + "-" +'0'+( MM+1) + "-" + '0'+dd;

                var from_date   =   $('#from_date').val();
                var to_date     =   $('#to_date').val();
                $('#search_data').val('');
                $('#from_date').val(currentDate);
                $('#to_date').val(to_date);
                $('#data-table').DataTable().destroy();
                load_data();
            });
                   
            $(document).on('change','#status',function(){
                var type    =       $(this).data("type");
                var id      =       $(this).data("id");
                var value   =       $(this).val();
               
                if(type != '' && id != '' && value != '')
                {
                    $.ajax({
                        type: "POST",
                        url:"{{ route('dashboard.status') }}",
                        data: {
                            id:id,
                            type:type,
                            value:value,
                            _token: '{{csrf_token()}}'
                        },
                        success :function(data) {
                            $('#data-table').DataTable().destroy();
                            toastr.success("Status updated successfully");
                        }
                    })
                }
            });
            $(document).on('blur','#remark',function(){
                var type    =       $(this).data("type");
                var id      =       $(this).data("id");
                var value   =       $(this).val();
                // alert(type)
                // alert(id)
                // alert(value)
                if(type != '' && id != '')
                {
                    $.ajax({
                        type: "POST",
                        url:"{{ route('dashboard.remark') }}",
                        data: {
                            id:id,
                            type:type,
                            value:value,
                            _token: '{{csrf_token()}}'
                        },
                        success :function(data) {
                            $('#data-table').DataTable().destroy();
                        }
                    })
                }
               

            });
        });
    </script>
@endsection

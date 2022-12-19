<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Name</label>
    <div class="col-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Email</label>
    <div class="col-10">
        {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3" >
    <label class="col-2 text-end col-form-label">Password</label>
    <div class="col-10">
        {!! Form::text('password', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Role</label>
    <div class="col-10">
        {!! Form::select('role_id',$roleDb , $userRole, ['class' =>'form-select', 'placeholder' => '-- Select Role --'])  !!}
    </div>
</div>

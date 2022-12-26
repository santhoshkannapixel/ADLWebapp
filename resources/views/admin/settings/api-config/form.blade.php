<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Corporate ID</label>
    <div class="col-10">
        {!! Form::text('corporateID', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Pass Code</label>
    <div class="col-10">
        {!! Form::text('passCode', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3" >
    <label class="col-2 text-end col-form-label">API Url</label>
    <div class="col-10">
        {!! Form::url('apiUrl', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">API Type</label>
    <div class="col-10">
        {!! Form::text('apiType', null, ['class' => 'form-control']) !!}
    </div>
</div>

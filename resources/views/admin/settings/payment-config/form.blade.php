<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Gateway Name</label>
    <div class="col-10">
        {!! Form::text('gateWayName', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Payment Key / Id</label>
    <div class="col-10">
        {!! Form::text('payKeyId', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3" >
    <label class="col-2 text-end col-form-label">Payment SecretKey</label>
    <div class="col-10"> 
        {!! Form::text('paySecretKey', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div> 
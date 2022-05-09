<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Corporate ID</label>
    <div class="col-10">
        {!! Form::text('CorporateID', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Pass Code</label>
    <div class="col-10">
        {!! Form::text('passCode', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3" >
    <label class="col-2 text-end col-form-label">Base Url</label>
    <div class="col-10"> 
        {!! Form::url('BaseUrl', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Site </label>
    <div class="col-10">
        {!! Form::select('SiteId',['Mangalore' => 'Mangalore', 'Bangalore' => 'Bangalore', 'Mysore' => 'Mysore'] , $Site ?? null, ['class' =>'form-select', 'placeholder' => '-- Select  --'])  !!}
    </div>
</div>
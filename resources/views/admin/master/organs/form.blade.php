<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Organ Name</label>
    <div class="col-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div> 
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Sort Order</label>
    <div class="col-10">
        {!! Form::number('order_by', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div> 
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Organ Image</label>
    <div class="col-10">
        <div>
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>
        @if ($organ->image ?? null)
            <img src="{{ asset_url($organ->image) }}" height="60" class="mt-2">
        @endif
    </div> 
</div>
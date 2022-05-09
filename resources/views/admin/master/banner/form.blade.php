<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Title</label>
    <div class="col-10">
        {!! Form::text('Title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Redirect URL</label>
    <div class="col-10">
        {!! Form::url('Url', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Sort Order</label>
    <div class="col-10">
        {!! Form::number('OrderBy', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Content</label>
    <div class="col-10">
        {!! Form::text('Content', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Desktop Image</label>
    <div class="col-10">
        <div>
            {!! Form::file('DesktopImage',  ['class' => 'form-control']) !!}
            <small class="text-danger"><b>Note</b> : min image size should be 1200 x 800</small>
        </div>
        @if ($banner->DesktopImage ?? null)
            <img src="{{ asset_url($banner->DesktopImage) }}" height="60" class="mt-2">
        @endif
    </div> 
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Mobile Image</label>
    <div class="col-10">
        <div>
            {!! Form::file('MobileImage', ['class' => 'form-control']) !!}
            <small class="text-danger"><b>Note</b> : min image size should be 600 x 450</small>
        </div>
        @if ($banner->MobileImage ?? null)
            <img src="{{ asset_url($banner->MobileImage) }}" height="60" class="mt-2">
        @endif
    </div> 
</div>
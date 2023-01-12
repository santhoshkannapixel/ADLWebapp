


<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Job Title *</label>
    <div class="col-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Job Code *</label>
    <div class="col-10">
        {!! Form::text('code', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Location </label>
    <div class="col-10">
        {!! Form::text('location', null, ['class' => 'form-control','id'=>'location', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Department</label>
    <div class="col-10">
        {{ Form::select('department_id', $department, null, array('class'=>'form-control', 'placeholder'=>'Please select Department' )) }}

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Experience *</label>
    <div class="col-10">
        {!! Form::text('experience', null, ['class' => 'form-control','id'=>'experience', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Responsibilities</label>
    <div class="col-10">
        <div class="form-group">
            {!! Form::textarea('responsibilities', null, ['class' => 'ckeditor form-control', 'id'=>'responsibilities', 'autocomplete' => 'off',]) !!}
        </div>
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Qualification</label>
    <div class="col-10">
        {!! Form::text('qualification', null, ['class' => 'form-control','id'=>'qualification', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">No Of Requirement</label>
    <div class="col-10">
        {!! Form::text('no_of_requirement', null, ['class' => 'form-control','id'=>'no_of_requirement', 'autocomplete' => 'off']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10">
        @if(isset($job))
            @if($job->status)
                <input type="checkbox" id="status" name="status" value="1" checked="checked">
            @else
                <input type="checkbox" id="status" name="status" value="0" >
            @endif
        @else
            <input type="checkbox" id="status" name="status" value="1" checked="checked">
        @endif
    </div>
</div>
<?php $ids = (URL::current()) ?>
<?php $ids = explode('/',$ids);?>
<?php $ids = end($ids); ?>

<?php $ids = substr($ids, -2) ?> 

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

    <script type="text/javascript">
 

       $(document).ready(function() {
            $('#status').click(function() {
                if (!$(this).is(':checked')) {
                    $(this).val(0);
                // return confirm("Are you sure?");
                }
                else if($(this).is(':checked')) {
                    $(this).val(1);
                // return confirm("Are you sure111?");
                }
            });
        });
        
        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file


    </script>  
@endsection
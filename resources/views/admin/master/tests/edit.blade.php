@extends('admin.master.layout')

@section('admin_master_content')
{!! Form::model($data,['route' =>['test.edit' , $data->id] , "Method" => "POST", 'files' => true]) !!}
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                {{ $data->TestName }}  
            </div>
           
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">TestId</label>
                <div class="col-10">
                    {!! Form::text('TestId', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">TestName</label>
                <div class="col-10">
                    {!! Form::text('TestName', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="row mb-3" >
                <label class="col-2 text-end col-form-label">TestName</label>
                <div class="col-10"> 
                    {!! Form::text('TestPrice', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="row mb-3" >
                <label class="col-2 text-end col-form-label">Test Images</label>
                <div class="col-10"> 
                    <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail2" class="form-control" type="text" name="TestImages">
                    </div>
                    <br>
                    <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                    @foreach (explode(",",$data->TestImages) as $row)
                        <img src="{{ $row }}" width="80px">
                    @endforeach
                </div>
                
            </div>
        </div>
        <div class="text-end card-footer">
            <a href="{{ route('api_config.index') }}" class="btn btn-light bg-white me-2">back</a>
            <button type="submit" class="btn btn-primary fw-bold">Save</button>
        </div>  
    </div>
{!! Form::close() !!}
@endsection 

@section('scripts')
    <script>
        var route_prefix = "{{ url('laravel-filemanager') }}";
    </script>
    <script src="{{ asset('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js') }}"></script>
    <script>$('#lfm').filemanager('file', {prefix: route_prefix});</script>
    <script>
        var lfm = function(id, type, options) {
            let button = document.getElementById(id);

            button.addEventListener('click', function () {

                var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById(button.getAttribute('data-preview'));

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');

                window.SetUrl = function (items) {
                    
                    var file_path = items.map(function (item) {
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function (item) {
                        let img = document.createElement('img')
                        img.setAttribute('style', 'height: 5rem')
                        img.setAttribute('src', item.thumb_url)
                        target_preview.appendChild(img);
                    });

                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        };

        lfm('lfm2', 'file', {prefix: route_prefix});

    </script>
@endsection
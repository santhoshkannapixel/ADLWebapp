<div class="row mb-3 mx-0">
    <label class="col-2 text-end col-form-label">Role Name</label>
    <div class="col-10 ps-4">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>
<table class="table table-sm shadow-sm border">
    <tbody>
        @foreach (getAllRoutes() as $rootKey => $route)
            <tr>
                <td class="px-3 bg-light border-end" width="20%"><b>{{ ucfirst($rootKey) }}</b></td>
                <td style="padding:0 !important">
                    <div class="row m-0 align-content-center">
                        @foreach ($route as $key => $name)
                            <div class="col-3 p-0">
                                <label for="{{ $name }}" class="bg-light w-100 p-2">
                                    @php $function_name = explode('.',$name) @endphp
                                    {{ ucwords(str_replace('-', ' ', end($function_name))) }}
                                </label>
                                <div class="d-flex align-items-center p-2">
                                    <label  for="{{ $name }}_ON">
                                        <input type="radio" value="1" name="{{ formatRoute($name) }}" id="{{ $name }}_ON" @isset($permissions) {{ $permissions[formatRoute($name)] ?? false == "1" ? 'checked' : ''}} @endisset>
                                        <b class="text-success">ON</b>
                                    </label>
                                    <label class="ms-3" for="{{ $name }}_OFF">
                                        <input type="radio" value="0" name="{{ formatRoute($name) }}" id="{{ $name }}_OFF" @isset($permissions) {{ $permissions[formatRoute($name)] ?? false == "0" ? 'checked' : ''}} @endisset>
                                        <b class="text-danger">OFF</b>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

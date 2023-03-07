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
                <td class="px-3 bg-light border-end" width="20%"><small><b>{{ ucfirst($rootKey) }}</b></small></td>
                <td style="padding:0 !important">
                    <div class="row m-0 align-content-center">
                        @foreach ($route as $name) 
                            <label label="{{  $permissions[formatRoute($name)] ?? '0' == 1 ? 'Access' : 'Not Access' }}" class="col-3 btn btn-sm text-start" for="{{ formatRoute($name) }}">
                                @if (isset($permissions[formatRoute($name)]))
                                    <input type="hidden" name="{{ formatRoute($name) }}" value="{{ $permissions[formatRoute($name)] == 0 ? 0 : '' }}">
                                    <input class="form-check-input me-1 border" type="checkbox"
                                        {{ $permissions[formatRoute($name)] == 1 ? 'checked' : '' }}
                                        name="{{ formatRoute($name) }}" value="1" id="{{ formatRoute($name) }}">
                                @else
                                    <input type="hidden" name="{{ formatRoute($name) }}" value="0">
                                    <input class="form-check-input me-1 border" type="checkbox"
                                        name="{{ formatRoute($name) }}" value="1" id="{{ formatRoute($name) }}">
                                @endif
                                <small> @php $function_name = explode('.',$name) @endphp
                                    {{ ucwords(str_replace('-', ' ', end($function_name))) }}</small>
                            </label>
                        @endforeach 
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

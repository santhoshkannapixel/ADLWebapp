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
                <td>
                    <div class="row m-0 align-content-center">
                        @foreach ($route as $key => $name)
                            <div class="form-check col-3">
                                <input class="form-check-input" type="checkbox" value="true" name="{{ $name }}" id="{{ $name }}"
                                    {{ isset($permissions[$name]) && $permissions[$name] == 1 ? 'checked' : '' }}>
                                <label for="{{ $name }}">
                                    @php $function_name = explode('.',$name) @endphp
                                    {{ ucwords(str_replace('-', ' ', end($function_name))) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

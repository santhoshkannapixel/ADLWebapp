<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Role Name</label>
    <div class="col-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>
 
<table class="table table-bordered table-centered  tr-sm table-hover">
    <thead class="bg-primary-2 text-white">
        <tr>
            <th rowspan="2" width="200px">Menus</th>
            <th colspan="4"><input onclick="toggle(this);" type="checkbox" class="form-check-input me-2"> Permissions</th>
        </tr>
        <tr>
            <th><input type="checkbox" onclick="view_alls(this);" id="view_all" class="form-check-input me-2"> View</th>
            <th><input type="checkbox" onclick="add_alls(this);" id="add_all"class="form-check-input me-2"> Add</th>
            <th><input type="checkbox" onclick="edit_alls(this);" id="edit_all"class="form-check-input me-2"> Edit</th>
            <th><input type="checkbox" onclick="delete_alls(this);" id="delete_all"class="form-check-input me-2"> Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Dashboard</th>
            <td><input type="checkbox" {{ $permissions['user.view.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.dashboard"></td>
            <td><input type="checkbox" {{ $permissions['user.add.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.dashboard"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.dashboard"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.dashboard"></td>
        </tr>
        <tr>
            <th>Settings </th>
            <td><input type="checkbox" {{ $permissions['user.view.settings'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.settings"></td>
            <td><input type="checkbox" {{ $permissions['user.add.settings'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.settings"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.settings'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.settings"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.settings'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.settings"></td>
        </tr>
    </tbody>
</table> 
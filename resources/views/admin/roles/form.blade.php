<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Nombre</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ $role->name or old('name') }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
    <label for="label" class="col-md-4 control-label">Nombre Legible</label>

    <div class="col-md-6">
        <input id="label" type="text" class="form-control" name="label" value="{{ $role->label or old('label') }}">

        @if ($errors->has('label'))
            <span class="help-block">
                <strong>{{ $errors->first('label') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Permisos</label>

    <div class="col-md-6">
        <select class="role-multiselect col-md-12" multiple="multiple" name="permissions[]">
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->label}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Confirmar
        </button>
    </div>
</div>
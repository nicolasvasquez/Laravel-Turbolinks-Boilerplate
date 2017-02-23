@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $action }} Usuario</div>
                <div class="panel-body">
                    <form id="{{ $action }}" class="form-horizontal" role="form" method="POST" action="{{ route($route) }}" novalidate>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

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
                                <input id="label" type="text" class="form-control" name="label" value="{{ old('label') }}">

                                @if ($errors->has('label'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".role-multiselect").select2({
        theme: 'bootstrap'
    });
    document.addEventListener('turbolinks:load', function() {
        $('#Crear').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $promise = $.post($form.attr('action'), $form.serialize());
            $promise.done(function(data) {
                console.log('done', data);
                $(document).one('turbolinks:render', function(){
                    toastr.success('Creado');
                });
            });
            $promise.fail(function(data){
                console.log('fail', data);
            });
        })
    })
</script>
@endsection
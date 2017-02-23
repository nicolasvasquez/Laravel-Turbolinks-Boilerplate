@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Roles</div>
                <div class="panel-body">
                    <div class="pull-right">
                        <a class="btn btn-default" href="{{ route('roles.create') }}">Nuevo Rol <i class="glyphicon glyphicon-plus"></i></a>
                    </div>
                    <table class="table" id="list">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre publico o legible</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->label }}</td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            <span class="label label-primary">{{ $permission->label }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form class="formDelete" role="form" method="POST" action="{{ route('roles.destroy', $role) }}" novalidate>
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a class="btn btn-warning btn-xs" href="{{ route('roles.edit', $role) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <button type="submit" class="btn btn-danger btn-xs destroy"><i class="glyphicon glyphicon-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("turbolinks:load", function() {
        $('.formDelete').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            swal({
                title: 'Esta seguro de eliminar?',
                text: 'No sera capaz de recuperar el registro!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Si, eliminalo!',
            }).then(() => {
                var $promise = $.post($form.attr('action'), $form.serialize());
                $promise.done(function(data) {
                    $(document).one('turbolinks:render', function(){
                        toastr.success('Eliminado');
                    });
                });
                $promise.fail(function(data){
                    console.log('fail', data);
                });
            });
        })
    });
</script>
@endsection
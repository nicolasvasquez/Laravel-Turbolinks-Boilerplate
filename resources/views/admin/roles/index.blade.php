@extends('layouts.app')

@section('content')
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
                    <tr>
                        <td><input id="nameSearch" type="text" class="form-control" placeholder="Nombre"></td>
                        <td><input id="labelSearch" type="text" class="form-control" placeholder="Nombre publico"></td>
                        <td><input id="permissionSearch" type="text" class="form-control" placeholder="Permiso"></td>
                        <td></td>
                    </tr>
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
            {{ $roles->links() }}
        </div>
    </div>
<script>
    function parseParams(params) {
        var aux = {
            name: null,
            label: null,
            permission: null
        };
        if (params) {
            if(params.indexOf('name') != -1) {
                aux.name = params.split('name=')[1].split('&&')[0];
            }
            if(params.indexOf('label') != -1) {
                aux.label = params.split('label=')[1].split('&&')[0];
            }
            if(params.indexOf('permission') != -1) {
                aux.permission = params.split('permission=')[1].split('&&')[0];
            }
        }

        return aux;
    }

    function buildQueryParams(params) {
		var page = 1;
		var query = '?page=' + page;

		for (var paramKey in params) {
			if (paramKey !== 'page' && params[paramKey] !== null) {
				query += '&' + paramKey + '=' + params[paramKey];
			}
		}
		return query;
	}

    var $nameSearch = $('#nameSearch');
    var $labelSearch = $('#labelSearch');
    var $permissionSearch = $('#permissionSearch');

    var fullPath = window.location.href.split('.dev')[1];
    var path = fullPath.split('?')[0];
    var params = parseParams(fullPath.split('?')[1]);    

    $nameSearch.change(function() {
        params.name = $nameSearch.val();
        location.assign(path + buildQueryParams(params));
    });

    $labelSearch.change(function() {
        params.label = $labelSearch.val();
        location.assign(path + buildQueryParams(params));
    });

    $permissionSearch.change(function() {
        params.permission = $permissionSearch.val();
        location.assign(path + buildQueryParams(params));
    });

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
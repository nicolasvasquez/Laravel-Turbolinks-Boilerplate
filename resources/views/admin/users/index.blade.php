@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Usuarios</div>
        <div class="panel-body">
            <div class="pull-right">
                <a class="btn btn-default" href="{{ route('users.create') }}">Nuevo Usuario <i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <table id="list" class="table" >
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input id="nameSearch" type="text" class="form-control" placeholder="nombre"></td>
                        <td><input id="emailSearch" type="text" class="form-control" placeholder="email"></td>
                        <td><input id="rolSearch" type="text" class="form-control" placeholder="rol"></td>
                        <td></td>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="label label-primary">{{ $role->label }}</span>
                                @endforeach
                            </td>
                            <td>
                                <form class="formDelete" role="form" method="POST" action="{{ route('users.destroy', $user) }}" novalidate>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-warning btn-xs" href="{{ route('users.edit', $user) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <button type="submit" class="btn btn-danger btn-xs destroy"><i class="glyphicon glyphicon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
<script>
    function parseParams(params) {
        var aux = {
            name: null,
            email: null,
            rol: null
        };
        if(params) {
            if(params.indexOf('name') != -1) {
                aux.name = params.split('name=')[1].split('&&')[0];
            }
            if(params.indexOf('email') != -1) {
                aux.email = params.split('email=')[1].split('&&')[0];
            }
            if(params.indexOf('rol') != -1) {
                aux.rol = params.split('rol=')[1].split('&&')[0];
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
    var $emailSearch = $('#emailSearch');
    var $rolSearch = $('#rolSearch');

    var fullPath = window.location.href.split('.dev')[1];
    var path = fullPath.split('?')[0];
    var params = parseParams(fullPath.split('?')[1]);    

    $nameSearch.change(function() {
        params.name = $nameSearch.val();
        location.assign(path + buildQueryParams(params));
    });

    $emailSearch.change(function() {
        params.email = $emailSearch.val();
        location.assign(path + buildQueryParams(params));
    });

    $rolSearch.change(function() {
        params.rol = $rolSearch.val();
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
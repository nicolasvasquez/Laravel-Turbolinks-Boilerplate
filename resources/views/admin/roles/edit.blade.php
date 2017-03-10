@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Crear Rol</div>
        <div class="panel-body">
            <form class="form-horizontal roleForm" role="form" method="POST" action="{{ route('roles.update', $role) }}" novalidate>
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                @include('admin.roles.form')
            </form>
        </div>
    </div>
<script>
    $(".role-multiselect").select2({
        theme: 'bootstrap'
    });
    document.addEventListener('turbolinks:load', function() {
        $('.roleForm').on('submit', function(e) {
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
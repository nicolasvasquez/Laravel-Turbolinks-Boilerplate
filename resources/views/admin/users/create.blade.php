@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Crear Usuario</div>
        <div class="panel-body">
            <form class="form-horizontal userForm" role="form" method="POST" action="{{ route('users.store') }}" novalidate>
                {{ csrf_field() }}
                @include('admin.users.form')
            </form>
        </div>
    </div>
<script>
    $(".role-multiselect").select2({
        theme: 'bootstrap'
    });
    document.addEventListener('turbolinks:load', function() {
        $('.userForm').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $promise = $.post($form.attr('action'), $form.serialize());
            $promise.done(function(data) {
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
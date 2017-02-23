@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $action }} Usuario</div>
                <div class="panel-body">
                    <form id="{{ $action }}" class="form-horizontal" role="form" method="POST" action="{{ route('roles.store') }}" novalidate>
                        {{ csrf_field() }}
                        @extends('admin.roles.form')
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
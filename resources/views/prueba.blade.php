@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Select Anidado</div>
        <div class="panel-body">
            <form id="form22" action="/prueba">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name or old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <br>
                <br>
                <br>
                <select class="col-md-12 select1" name="region">
                    <option value=""></option>
                    @foreach($reg as $re)
                        <option value="{{ $re->id }}" 
                        @if ($re->id == old('region'))
                            selected = "selected"
                        @endif
                        >{{ $re->name }}</option>
                    @endforeach
                </select>
                <br>
                <select class="col-md-12 select22" name="comuna">

                </select>
                <br>
                <select class="col-md-12 select3" name="establecimiento">
                    
                </select>
                <br>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
<script>
    $.fn.select2.defaults.set("theme", "bootstrap");

    var $regiones = $(".select1");
    $regiones.select2();

    var $comunas = $(".select22");
    $comunas.select2();

    var $establecimientos = $(".select3");
    $establecimientos.select2();

    if ( {!! json_encode(old('region')) !!} ) {
        var $promise = $.get('/prueba/' + {!! json_encode(old('region')) !!} );
        $promise.done(function(data) {
            $comunas.html('').select2({data: [{id: '', text: ''}]});
            $establecimientos.html('').select2({data: [{id: '', text: ''}]});
            $.each(data, function(key, value) {
                $comunas.append($('<option>', {
                value: value.id,
                text:  value.name
            })).select2();
            });
            $comunas.select2().val( {!! json_encode(old('comuna')) !!} ).trigger('change.select2');

            if ( {!! json_encode(old('comuna')) !!} ) {
            var $promise = $.get('/prueba/comuna/' + {!! json_encode(old('comuna')) !!} );
            $promise.done(function(data) {
                $establecimientos.html('').select2({data: [{id: '', text: ''}]});
                $.each(data, function(key, value) {
                    $establecimientos.append($('<option>', {
                    value: value.id,
                    text:  value.name
                })).select2();
                });
                $establecimientos.select2().val( {!! json_encode(old('establecimiento')) !!} ).trigger('change.select2');
            });
        } 
        });    
    }

    $regiones.change(function(data) {
        var $promise = $.get('/prueba/' + $(this).find(':selected').val());
        $promise.done(function(data) {
            $comunas.html('').select2({data: [{id: '', text: ''}]});
            $establecimientos.html('').select2({data: [{id: '', text: ''}]});
            $.each(data, function(key, value) {
                $comunas.append($('<option>', {
                value: value.id,
                text:  value.name
            })).select2();
            });
        });
    });

    $comunas.change(function() {
        console.log('Event22')
        var $promise = $.get('/prueba/comuna/' + $(this).find(':selected').val());
        $promise.done(function(data) {
            $establecimientos.html('').select2({data: [{id: '', text: ''}]});
            $.each(data, function(key, value) {
                $establecimientos.append($('<option>', {
                value: value.id,
                text:  value.name
            })).select2();
            });
        });
    });

    document.addEventListener("turbolinks:load", function() {
    $('#form22').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $promise = $.post($form.attr('action'), $form.serialize());
        $promise.done(function(data) {
            console.log('done', data);
        });
        $promise.fail(function(data){
            console.log('fail', data);
        });
    })
});
</script>
@endsection
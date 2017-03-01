@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                            @foreach($reg as $re)
                                <option value="{{ $re->id }}" 
                                @if ($re->id == old('region'))
                                    selected="selected"
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
        </div>
    </div>
</div>
<script>
    console.log('comuna', {!! json_encode(old('comuna')) !!});
    var a = $(".select1").select2({
        theme: 'bootstrap',
        placeholder: "Select a state",
        allowClear: true,
    });

    var b = $(".select22").select2({
        theme: 'bootstrap',
    });

    var c = $(".select3").select2({
        theme: 'bootstrap',
    });

    if ( {!! json_encode(old('region')) !!} ) {
        var $promise = $.get('/prueba/' + {!! json_encode(old('region')) !!} );
        $promise.done(function(data) {
            $('.select22').html('').select2({data: [{id: '', text: ''}]});
            $('.select3').html('').select2({data: [{id: '', text: ''}], theme: 'bootstrap'});
            $.each(data, function(key, value) {
                $('.select22').append($('<option>', {
                value: value.id,
                text: value.name
            })).select2({
                theme: 'bootstrap',
            });
            });
            $(".select22").select2({theme: 'bootstrap'}).val( {!! json_encode(old('comuna')) !!} ).trigger('change.select2');

            if ( {!! json_encode(old('comuna')) !!} ) {
            var $promise = $.get('/prueba/comuna/' + {!! json_encode(old('comuna')) !!} );
            $promise.done(function(data) {
                $('.select3').html('').select2({data: [{id: '', text: ''}]});
                $.each(data, function(key, value) {
                    $('.select3').append($('<option>', {
                    value: value.id,
                    text: value.name
                })).select2({
                    theme: 'bootstrap',
                });
                });
                $(".select3").select2({theme: 'bootstrap'}).val( {!! json_encode(old('establecimiento')) !!} ).trigger('change.select2');
            });
        } 
        });    
    }

    $(".select1").change(function(data) {
        var $promise = $.get('/prueba/' + $(this).find(':selected').val());
        $promise.done(function(data) {
            $('.select22').html('').select2({data: [{id: '', text: ''}]});
            $('.select3').html('').select2({data: [{id: '', text: ''}], theme: 'bootstrap'});
            $.each(data, function(key, value) {
                $('.select22').append($('<option>', {
                value: value.id,
                text: value.name
            })).select2({
                theme: 'bootstrap',
            });
            });
        });
    });

    $('.select22').change(function() {
        console.log('Event22')
        var $promise = $.get('/prueba/comuna/' + $(this).find(':selected').val());
        $promise.done(function(data) {
            $('.select3').html('').select2({data: [{id: '', text: ''}]});
            $.each(data, function(key, value) {
                $('.select3').append($('<option>', {
                value: value.id,
                text: value.name
            })).select2({
                theme: 'bootstrap',
            });
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
            $(document).one('turbolinks:render', function(){
                toastr.success('Bienvenido');
            });
        });
        $promise.fail(function(data){
            console.log('fail', data);
        });
    })
});
</script>
@endsection
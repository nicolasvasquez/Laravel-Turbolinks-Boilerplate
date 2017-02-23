document.addEventListener("turbolinks:load", function() {
    $('#form').on('submit', function(e) {
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
window.onload = function () {

    document.getElementById('archive_post_button').addEventListener('click', function () {
        swal({
            title: '<h3 class="title is-3">Você tem certeza disso?</h3>',
            text: "Após arquivar o post, ninguém mais poderá comentar nele.",
            type: 'question',
            showCancelButton: true,

            confirmButtonText: 'Arquivar',
            cancelButtonText: 'Cancelar',

            confirmButtonClass: 'button is-danger extra-padding-left',
            cancelButtonClass: 'button',
            buttonsStyling: false

        }).then(function () {
            document.getElementById('archive_post_form').submit();
        }, function (dismiss) {
        });
    });


};
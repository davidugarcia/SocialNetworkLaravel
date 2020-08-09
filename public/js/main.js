var url = 'http://127.0.0.1:8000/';

window.addEventListener('load', function() {

    //alert("hola mundo");
    //colocar cursor en pointer
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    // Botón de like
    function like() {

        /*el metodo unbind() o metodo off evita de que se ejecute los eventos uno tras otro 
        es decir, estamos llamando una ejecutando una funcion dentro de otra funcion para que se ejecute una funcion con el evento click
        con esto evitamos que se ejecute todo esto y de que solo una ves de ejecute esta function con el evento click*/

        //$('.btn-like').off('click').click(function()
        $('.btn-like').unbind('click').click(function() {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', '/img/heart-red.png');

            $.ajax({
                //ruta de like/id el dato id se obtiene del atributo data-id="{{$imagen->id}}" de la img
                // esta ruta es semejante ala que esta en el archivo de ruta de web.
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function(response) {
                    //el true de respose.like se obtiene del controlador megusta metodo like enviado por JSON
                    if (response.megusta) {
                        console.log('Has dado like a la publicacion');
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();
        });
    }

    //se invoca la function
    like();

    // Botón de dislike
    function dislike() {
        // $('.btn-like').off('click').click(function()
        $('.btn-dislike').unbind('click').click(function() {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', '/img/heart-black.png');

            $.ajax({
                //ruta de dislike/id el id se obtiene del atributo data-id="{{$imagen->id}}" de la img
                // esta ruta es semejante ala que esta en el archivo de ruta de web.
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function(response) {
                    //el true de respose.like se obtiene del controlador megusta metodo dislike enviado por JSON
                    if (response.nomegusta) {
                        console.log('Has dado dislike a la publicacion');
                    } else {
                        console.log('Error al dar dislike');
                    }
                }
            });

            like();
        });
    }
    //se invoca la function
    dislike();

    /* BUSCADOR
	$('#buscador').submit(function(e){
		$(this).attr('action',url+'/gente/'+$('#buscador #search').val());
	});*/

});
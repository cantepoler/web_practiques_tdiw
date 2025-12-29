$(document).ready(function() {
    // Quan es fa clic al disparador
    $('#obrir_menu').click(function(e) {
        
        // Alterna la visibilitat amb una animació
        $('#desplegable-usuari').slideToggle('fast');
    });

    // Opcional: Tancar el menú si es fa clic a fora
    $(document).click(function(e) {
        if (!$(e.target).closest('.login').length) {
            $('#desplegable-usuari').slideUp('fast');
        }
    });
});
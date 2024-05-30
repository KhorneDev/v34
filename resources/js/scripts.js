$(document).ready(function () {
    // Agregar nuevo campo de área de interés laboral
    $(document).on("click", "#btnAgregarArea", function () {
        $('#contenedorAreasAdicionales').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="intereses[]" required>
                <button type="button" class="btn btn-danger btn-sm eliminar-campo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.854 4.146a.5.5 0 0 1 0 .708L3.207 8l1.647 1.646a.5.5 0 1 1-.708.708L2.5 8.707l-1.647 1.647a.5.5 0 0 1-.708-.708L1.793 8 0 6.354a.5.5 0 0 1 .708-.708L2.5 6.293l1.646-1.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                </button>
            </div>
        `);
    });

    // Eliminar campo dinámicamente
    $(document).on("click", ".eliminar-campo", function () {
        $(this).parent().remove();
    });

    // Generar texto
    $('#generar-texto').click(function () {
        let nombre = $('#nombre').val();
        let apellidos = $('#apellidos').val();
        let correo = $('#correo').val();
        let telefono = $('#telefono').val();
        let intereses = $('input[name="intereses[]"]').map(function () {
            return $(this).val();
        }).get().join(', ');
        let hobbies = $('input[name="hobbies[]"]').map(function () {
            return $(this).val();
        }).get().join(', ');

        let texto = `Hola, mi nombre es ${nombre} ${apellidos}. Mi correo electrónico es ${correo} y mi teléfono es ${telefono}. Mis áreas de interés laboral son: ${intereses}. En mi tiempo libre, disfruto de ${hobbies}.`;
        $('#texto-generado').text(texto);
    });

    // Copiar texto al portapapeles
    $('#copiar-texto').click(function () {
        let texto = $('#texto-generado').text();
        navigator.clipboard.writeText(texto).then(function () {
            alert('Texto copiado al portapapeles.');
        }, function (err) {
            console.error('Error al copiar el texto: ', err);
        });
    });
});

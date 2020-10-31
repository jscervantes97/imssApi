$(document).ready(function() {
    function recuperarDatosFormulario() {
        let registro = {
          usuario: $('#cajaUsuario').val(),
          contra: $('#cajaContra').val()
        };
        return registro;
    }

    $('#btnIniciar').click(function() {
        userIntent = recuperarDatosFormulario() ;
        console.log(userIntent);
        iniciaSesion(userIntent);
    });

    function iniciaSesion(usuario){
        $.ajax({
            type: 'POST',
            url: 'php/usuarios/userModel.php?opc=1',
            data: usuario,
            success: function(msg) {
              console.log(msg);
              //limpiarFormuluario();
              //$('#resultadosApi2').html("<h4>" + msg[0].resultado + "</h4>");
              alert(msg[0].resultado )
            },
            error: function(err) {
              console.log(err)
              alert("Ocurrio un error en tiempo de ejecucion.... avise al administrador del sistema el siguiente error " + err);
            }
          });
    }

});
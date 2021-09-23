$('#validarDni').click(function(){

  // Traemos los datos de los inputs

    var dni = document.getElementById("dni").value;
    /*
    var dni= 1;
    */
    // Envio de datos mediante Ajax

    $.ajax({
      method: 'POST',
      // Recuerda que la ruta se hace como si estuvieramos en el index y no en operaciones por esa razon no utilizamos ../ para ir a controller
      url: 'api/loginDni.php',
      // Recuerda el primer parametro es la variable de php y el segundo es el dato que enviamos
      data: {dni_php: dni},
      // Esta funcion se ejecuta antes de enviar la información al archivo indicado en el parametro url
      beforeSend: function(){
        // Mostramos el div con el id load mientras se espera una respuesta del servidor (el archivo solicitado en el parametro url)
        $('#load').show();
      },
      // el parametro res es la respuesta que da php mediante impresion de pantalla (echo)
      success: function(res){
        // Lo primero es ocultar el load, ya que recibimos la respuesta del servidor
        $('#load').hide();
        
        /*Hago esto ya que a veces la "RES" de AJAX trae un salto de linea*/
        res= res.split("\n").join("");
        /*Hago esto ya que a veces la "RES" de AJAX trae un salto de linea*/

        // Ahora validamos la respuesta de php, si es error_1 algun campo esta vacio de lo contrario todo salio bien y redireccionaremos a donde diga php
        if(res == 'error_1'){
          /*
          Para usar sweetalert es muy sencillo, has de cuenta que haces un alert
          solo que esta ves enviaras 3 parametros separados por comas, el primero
          es el titulo de la alerta, el segundo es la descripcion y el tercero es el tipo de alerta
          en el momento conozco tres tipos, entonces puedes variar entre success: Muestra animación de un check,
          warning: muestra icono de advertencia amarillo y error: muestra una animacion con una X muy chula :v
          */
          /*
          swal('Error', 'Por favor ingrese todos los campos', 'error');
          */
          document.getElementById("Error").style.display = "block";
          document.getElementById("Error").innerHTML="Por favor ingrese todos los campos.";

        }else if(res == 'error_3'){
          /*
          swal('Error', 'Hola!!! No estas registrado en el SIU, volve a las Preguntas Frecuentas y alli te indicamos como proceder.', 'error');
          */
          document.getElementById("Error").style.display = "block";
          document.getElementById("Error").innerHTML="<strong> Hola. No figura tu usuario en nuestros sistemas. Por favor ingresa </strong><a href=" + "https://docs.google.com/forms/d/e/1FAIpQLSckwANd6BOTCAfLAGMvjOHa2b-f58ceYG1G34eZ1IXThRC1qA/viewform" +" target=_blank>Aqui</a>";

          //volve a las Preguntas Frecuentas y alli te indicamos como proceder.";
        }else{
          // Redireccionamos a la página que diga corresponda el usuario
/*
          window.location.href= "verIncidencias.html";
*/

          window.location.href= "alumno.php";          

         }
       }
    });
  
  });

  $('#dni').keydown(function(){
    document.getElementById("Error").style.display = "none";
  });

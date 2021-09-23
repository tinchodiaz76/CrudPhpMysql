$('#login').click(function(){

    // Traemos los datos de los inputs
    var user = document.getElementById("usuario").value;
    var clave = document.getElementById("password").value;
    // Envio de datos mediante Ajax

    $.ajax({
      method: 'POST',
      // Recuerda que la ruta se hace como si estuvieramos en el index y no en operaciones por esa razon no utilizamos ../ para ir a controller
      url: 'api/loginAlumno.php',
      // Recuerda el primer parametro es la variable de php y el segundo es el dato que enviamos
      data: {user_php: user, clave_php: clave},      
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
          /*swal('Error', 'Por favor ingrese todos los campos', 'error');*/
          document.getElementById("Error").style.display = "block";
          document.getElementById("Error").innerHTML="<strong> Por favor ingrese todos los campos. </strong>";
        }else if(res == 'error_3'){
          /*swal('Error', 'Usuario o Password incorrecta.', 'error');*/
          document.getElementById("Error").style.display = "block";
          document.getElementById("Error").innerHTML="<strong> Tu usuario o contraseña son incorrectas. Para recuperar tu contraseña, ingresa aqui </strong><a href=" + "https://guarani.unaj.edu.ar/acceso/recuperar" +" target=_blank>Aqui</a>"
        }else{
          // Redireccionamos a la página que diga corresponda el usuario
          window.location.href= "cargaIncidencia.html";          

         }
       }
    });
  
  });

  $('#usuario').keydown(function(){
    document.getElementById("Error").style.display = "none";
  });
  
  $('#password').keydown(function(){
    document.getElementById("Error").style.display = "none";
  });
  

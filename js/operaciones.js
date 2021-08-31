$('#login').click(function(){

  // Traemos los datos de los inputs
    //alert('Operaciones.js');
    var user = document.getElementById("usuario").value;
    var clave = document.getElementById("password").value;
    //alert(user);
    //alert(clave);
    // Envio de datos mediante Ajax

    $.ajax({
      method: 'POST',
      // Recuerda que la ruta se hace como si estuvieramos en el index y no en operaciones por esa razon no utilizamos ../ para ir a controller
      url: 'controller/loginController.php',
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
        //alert(res);
        /*Hago esto ya que a veces la "RES" trae espacios*/
        switch (res.trim()) {
          case 'error_1':
            //alert('Entre error_1');
            swal('Error', 'Por favor ingrese todos los campos', 'error');
            break;          
          case 'error_3':
            //alert('Entre error_3');
            swal('Error', 'Usuario o Contraseña incorrectos', 'error');
            break;          
          case 'success':
            //alert('Entre success');
            window.location.href= "index.php";
            break;
        }
       }
    });
  
  });
  

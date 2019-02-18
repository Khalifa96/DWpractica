<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../styles/style-shared.css">
        <link rel="stylesheet" href="../styles/style-inicio-sesion.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>Página principal</title>
    </head>
    <body>
        <div class="flex_cols" id="contenedor-inic">
            <div id="logo-inic">
                <a href="../main/index.php">
                    <img src="../img/logo_horizontal.png" width="100%">
                </a>
            </div>
            <div id="contenedor-form">
                <form id="miFormulario">
                    <h1 style="margin-top: 40px;">Crear cuenta</h1>
                    <label id="lNombre">Nombre</label>
                    <input type="text" id="cNombre">
                    <label id="lEmail">Dirección de e-mail</label>
                    <input type="email" id="cEmail">
                    <label id="lPass">Contraseña</label>
                    <input type="password" id="cPass">
                    <label id="lPass2">Confirma tu contraseña</label>
                    <input type="password" id="cPass2"><br><br>
                    <div id="crear-nueva-cuenta">
                        <input id="boton-nueva-cuenta" type="submit" value="Crear una nueva cuenta">
                    </div>
                </form>
            </div>
            <script>
                    
                (function($) { 
                    $('#miFormulario').submit(function() { 
                        var nombre = $("#cNombre").val(), 
                            email = $("#cEmail").val(),
                            contraseña = $("#cPass").val(),
                            contraseña2 = $("#cPass2").val();

                        var inputVal = [nombre, email, contraseña, contraseña2],
                            inputMessage = ["nombre", "email", "contraseña", "contraseña2"],
                            textId = ["#lNombre", "#lEmail", "#lPass", "#lPass2"];


                        for(var i=0;i<inputVal.length;i++){
                            
                            inputVal[i] = $.trim(inputVal[i]);
                            if ( inputVal[i] == null || inputVal[i] === "") {
                                invalidEntry(i);
                                return false;
                            }
                            
                            if(inputMessage[i]== "email"){
                                if(!isEmail(inputVal)){
                                    invalidEntry(i);
                                    return false;
                                }
                            }
                            console.log("good!");
                        };
                        
                        
                        if(inputVal[3] != inputVal[4]){
                                notEqual();
                            return false;
                        }
                        
                        function invalidEntry(i) {
                            
                            $("#error").remove();
                            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
                        }
                        
                        function notEqual(i){
                            $(textId[3]).after("<p id='error' style='font-size: 14px; color: red' > Las contraseñas no coinciden.</p>");
                        }
                        
                        function isEmail(email) {
                          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                          return regex.test(email);
                        }
                        
                        
                        
                        return this.some_variable 
                    });
                })(jQuery);
 
            </script>
        </div>
        <footer class="pageFoot">
            <div class="flex_cols">
                <div class="flex_rows" id="footer_info">
                    <div class="footer_container">
                        <div class="head">
                            Componentes
                        </div>
                        <div class="content">
                            <ul>
                                <li><a href="">Placas base</a></li>
                                <li><a href="">Procesadores</a></li>
                                <li><a href="">Discos duros</a></li>
                                <li><a href="">Tarjetas gráficas</a></li>
                                <li><a href="">Memorias RAM</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer_container">
                        <div class="head">
                            Contacto
                        </div>
                        <div class="content">
                            <ul>
                                <li><a href="">Teléfono: 999887766</a></li>
                                <li><a href="">E-mail: example@mail.com</a></li>
                                <li><a href=""><img src="../img/facebook.png" width="20px"></a></li>
                                <li><a href=""><img src="../img/twitter.png" width="20px"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer_container">
                        <div class="head">
                            ¿Dónde estamos ubicados?
                        </div>
                        <div class="content">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2982.3770409752533!2d-4.717704684502627!3d41.62598097924306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4712d844c78375%3A0x8532df1684bc7224!2sUniversidad+Europea+Miguel+de+Cervantes+-+UEMC!5e0!3m2!1ses!2ses!4v1547635284329" width="90%" height="80%" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>  
                    </div>
                </div>
                <div id="footer_copyright">
                    <a href="../main/privacy-policy.php" target="_blank">Política de Privacidad</a>
                    <a href="http://www.uemc.es" target="_blank">Universidad Europea Miguel de Cervantes</a>
                    <a href="https://creativecommons.org/choose/zero/?lang=es" target="_blank"><img src="../img/CC0.png" alt="cc0" width="15px"></a>
                </div>
            </div>
        </footer>
    </body>
</html>
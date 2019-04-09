<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    // require_once('/xampp/appdata/model/Saldo.php');

    session_start();

    $c = null;
    if(isset($_SESSION['id'])){
        $u = new Usuario($_SESSION['id']);
        $tipo = $u->getTipo();
        $username = $u->getUsername();
    }
    if( $_SERVER['REQUEST_METHOD']=='GET') {
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
    <meta name="keywords" content="hardware components">
    <meta name="robots" content="NoIndex, NoFollow">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../styles/style-shared.css">
    <link rel="stylesheet" href="../styles/style-catalogo.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    

    <title>Catálogo</title>

</head>

<body>
     <nav>
        <img id="logo" src="../img/logo.png" width="60">

        <ul id="lista_nav">
            <li class="cont_enlace_interno">
                <a href="../main/index.php">Inicio</a>
            </li>
            <li class="cont_enlace_interno">
                <a href="../catalogo/index.php">Catálogo</a>
            </li>
            <li class="cont_enlace_interno">
                <a href="../servicios/index.php">Servicios</a>
            </li>
            <li class="cont_enlace_interno">
                <a href="../encuentranos/index.php">Encuéntranos</a>
            </li>
            <li>
                <form>
                    <input type="search" placeholder="Search">
                </form>
            </li>
            <li>
                    <a id="img_usuario" href="../usuario/sign-in.php"><img src="../img/user-icon.png" height="20px"></a>
            </li>
            <li>
                <a id="img_carrito" href="../cesta_compra/xxxx-cesta.php"><img src="../img/shopping-trolley.png" height="20px"></a>
            </li>
        </ul>
    </nav>


    <!--            Este contiene los divs laterales-->
    <div style="height: 10vh; min-height: 70px; visibility: hidden">
    </div>

    <div class="mainProductoWrapper">

        <div class="prodContainer">
            <div class="maxedMini">
                <img src="../img/externos/5.jpg">
                <!--
                <img src="../img/externos/maxtor/maxtor1.jpg">            
                <img src="../img/externos/maxtor/maxtor2.jpg">
                <img src="../img/externos/maxtor/maxtor3.jpg">
-->
            </div>

            <div class="prodMiniaturas flex_rows">
                <img src="../img/externos/5.jpg">
                <img src="../img/externos/maxtor/maxtor1.jpg">
                <img src="../img/externos/maxtor/maxtor2.jpg">
                <img src="../img/externos/maxtor/maxtor3.jpg">

            </div>
        </div>

        <div class="prodDescriptionWrapper">
            <h1 id="desTitulo" style="padding: 8px 8px 8px 8px;">SAMSUNG/MAXTOR M3 EXTTERNAL 2.5" INCH 2TB MOBILE HARD DRIVE - MACBOOK/LAPTOP/IMAC DATA & TIME MACHINE BACKUP DISK</h1>
            <h2 id="desDesc" style="padding: 8px 8px 8px 8px;">135.90€</h2>
            <div style="border: solid; border-color: #6600cc; border-width: 3px 0; height: 0.5vh; width: 100%; margin: 10px 0"></div>
            <div id="desCantidadesWrapper">
                <span id="desCantidad">Cantidad: </span>
                <div id="dCant2">
                    <a id="dCMenos">-</a>
                    <div id="dCcampo">
                        <input id="dCShow" min="0" value="1">
                    </div>
                    <a id="dCMas">+</a>

                </div>

            </div>
            <div id="botonesCompras" class="flex_rows">
                <a>Añadir a la cesta</a>
                <a>COMPRAR</a>
            </div>
            <div id="prStockWrapper" class="flex_rows">
                <div id="prStElement">
                    <span style="margin-right: 12px;">Stock:</span>
                    <span id="prStock">5</span>
                    <span>Disponibles</span>
                </div>
                <div id="prNdElement">
                    Descubre donde
                    <span style="font-size: 12px; border-radius: 50%; border: solid transparent;">&or;</span>
                </div>
            </div>
            <div id="prStockEspecifico">
                <p>2 Disponibles en Avda. Juan Perales</p>
                <p>3 Disponibles en Calle Enrique Madroño</p>
            </div>
            <div id="infoEnvio">
                <div id="mainEnvio"><img src="../img/Envios/envios1.jpg"></div>
                <div id="restoEnvios">
                    <h1>Envio rápido y seguro</h1>
                    <ul>
                        <li><img src="../img/Envios/envios2.jpg"></li>
                        <li><img src="../img/Envios/envios3.png"></li>
                    </ul>
                </div>
            </div>

        </div>
        <div style="height: 8vh; width: 100%"></div>

        <div id="detallesAdiccionalesWrapper">
            <div id="detallesAdCategorias">
                <span id="primeraPestaña">Detalles del producto</span>
                <span id="segundaPestaña">Reviews</span>
            </div>
            <!-- <div style="height:60%; border: solid thin black;"></div> -->
            <div id="detallesAdContent">
                <p>
                    <pre style="font-family: 'Lato', sans-serif; font-size: 13px">
        MAXTOR EXTERNAL 2.5" 2TB M3 PORTABLE BACKUP HARD DRIVE - BLACK

        HX-M201TCBM


        En la caja:


        M3 Portable External Hard Drive

        Cable USB

        Guía de instalación rápida

        Software precargado en el disco

        Documentación del usuario en formato electrónico (PDF)




        Maxtor M3 Portable External Hard Drive

        The Maxtor M3 Portable External Hard Drive delivers handy portable storage. 
        It is easy to take wherever you go, and has ample capacity of up to 4TB. 
        The durable black design stands up to the rigors of daily use.




        Handy portable storage

        Durable black design

        SafetyKey TM protection for your data

        SuperSpeed USB 3.0 (Max): 5.0Gb/s



        Compatible con:


        Playstation 4 (as additional external storage for games)

        Xbox one (as additional external storage for games)

        Windows XP/Vista/7/8.1/10

        Apple Time Machine

        Mac OS X (including High Sierra)

        Laptops/Macbooks with USB 2.0 or USB 3.0 Sockets

        Smart TVs

        Android TV Boxes

                    </pre>
                </p>
            </div>
        <div id="lasReviews">
            <div class="review">
                    <h3>Este producto es muy bueno</h3>
                <p>
                    El productó me encantó, muy util.
                </p>
            </div>
            <div class="review">
                    <h3>Envio Rápido</h3>
                <p>
                    2 dias en llegar, gracias.
                </p>
            </div>
            <div class="review">
                    <h3>Rapido y en buen estado</h3>
                <p>
                    Todo en orden.
                </p>
            </div>
        </div>
        
        </div>
        <div id="sugerencias">
            <div><h1>Sugerencias</h1></div>
            <ul id="listaSugerencias">
                <li><img src="../img/externos/3.jpg"></li>
                <li><img src="../img/externos/6.jpg"></li>
                <li><img src="../img/externos/7.jpg"></li>                
            </ul>

        </div>
    
    
    
        <script type="text/javascript">
            $("document").ready(function() {

                $("#dCMenos").click(function() {
                    var campo = $("#dCShow");
                    var valorCampo = $("#dCShow").val();
                    if (valorCampo > 0) {
                        valorCampo--;
                        campo.val(valorCampo);
                    }

                });
                $("#dCMas").click(function() {
                    var campo = $("#dCShow");
                    var valorCampo = $("#dCShow").val();
                    valorCampo++;
                    campo.val(valorCampo);
                });


                /*Stock en tiendas*/
                $("#prNdElement").click(function() {
                    var showInfo = $("#prStockEspecifico");
                    showInfo.fadeToggle(1000);
                });
                
//                $("#detallesAdiccionalesWrapper").php(.function() {
//                    var index = 1;
//                    var primeraEtiqueta = $("#primeraPestaña");
//                    var segundaEtiqueta = $("#segundaPestaña");
//                    var primerParrafo = $("#detallesAdContent").contents();
//                    var segundoParrafo = $("#lasReviews").contents();
//                    
//                    if(index = 1) primerParrafo.show();
//                    segundaEtiqueta.click(function() {
//                       primerParrafo.fadeOut();
//                        segundoParrafo.fadeIn();
//                    });
//                    primeraEtiqueta.click(function() {
//                       primerParrafo.fadeOut();
//                        segundoParrafo.fadeIn();
//                    });
//                    });
                $("#segundaPestaña").click(function(){
                    $("#lasReviews").fadeIn();
                    $("#detallesAdContent").fadeOut();
                });
                
                $("#primeraPestaña").click(function(){
                    $("#detallesAdContent").fadeIn();
                    $("#lasReviews").fadeOut();
                });    
            });

            
        </script>
    </div>




</body>


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

</html>
    <?php
        if( isset($_GET['usrlog']) ){
            if($_GET['usrlog']==1){
    ?>
    <script>
        $('head').before('<div id="usrlog" style="width: 100%; height: 20px; color: #56ed2d; background-color: #1e1e15; padding: 10px;">Logueado con éxito</div>');
        setTimeout(function(){
            $('#usrlog').fadeOut('fast');
            }, 4000
            );
    </script>
    <?php
            }else if($_GET['usrlog']==0){
    ?>
    <script>
        $('head').before('<div id="usrlog" style="width: 100%; height: 20px; color: #0073e6; background-color: #1e1e15; padding: 10px;">Sesión cerrada</div>');
        setTimeout(function(){
            $('#usrlog').fadeOut('fast');
            }, 4000
            );
    </script>
<?php
            }
        }else if( isset($_GET['saldoadd'])){
            if($_GET['saldoadd']==1){
?>
        <script>
            $('head').before('<div id="saldoadd" style="width: 100%; height: 20px; color: #ffb246; background-color: #1e1e15; padding: 10px;">Saldo añadido con éxito</div>');
            setTimeout(function(){
                $('#saldoadd').fadeOut('fast');
                }, 4000
                );
        </script>
<?php
            }
            else if($_GET['saldoadd']==0){
?>
        <script>
            $('head').before('<div id="saldoadd" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #1e1e15; padding: 10px;">No se pudo añadir saldo correctamente</div>');
            setTimeout(function(){
                $('#saldoadd').fadeOut('fast');
                }, 4000
                );
        </script>
<?php
            }
        }
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        $c = new Cliente($_SESSION['id']);
        $saldoAdd = $_POST['saldo-add'];
        if( is_numeric($saldoAdd) && $saldoAdd > 0 && $c->addSaldo($saldoAdd) ){
            header('Location: ' . $_SERVER['PHP_SELF'] . '?saldoadd=1');
            exit;
        }else{
            header('Location: ' . $_SERVER['PHP_SELF'] . '?saldoadd=0');
            exit;
        }
    }
?>

<?php
    require_once('/xampp/appdata/model/console.php');
    require_once("../dbconfig.php");

    use Entity\Usuario;
    use Entity\Pedido;

    $em = GetEntityManager();

    session_start();

    $c = null;
   
    if(isset($_SESSION['user'])){
        $usuarioRep = $em->getRepository("Entity\\Usuario");
        $pedidoRep = $em->getRepository("Entity\\Pedido");
        $u = $_SESSION['user'];
        //Esperamos para cambiar esto después de modificar la bd
        $listaPedidos = $pedidoRep->findPedidosByUser($u);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="/dw/img/logo.png" type="image/png">
        <link rel="stylesheet" href="../styles/style-shared.css">
        <link rel="stylesheet" href="../styles/style-pedidos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <title>Historial Pedidos de <?php echo($u->getUsername()) ?></title>
    </head>
    <body>
        <div class="flex_cols" id="contenedor-inic">
            <div style="height: 10vh; min-height: 100px; visibility: hidden"></div>
            <div id="logo-inic">
                <a href="../main/index.php">
                    <img src="../img/logo_horizontal.png" width="100%">
                </a>
            </div>
            <div style="height: 10vh; min-height: 50px; visibility: hidden"></div>
            <div id="mainContainer">
                <div id="titulo">Pedidos del cliente <?php echo($u->getUsername()) ?></div>
                <ol reversed>
                <?php 
                foreach($listaPedidos as $p) { 
                ?>
                    <li class="flex_rows">
                        <div class="pedido-img">
                            <a href=""><img src="<?php /*echo($p['photoPath']);*/ ?>" height="100%"></a>
                        </div>
                        <div class="flex_cols pedido-container">
                            <div class="estado"><?php echo('Estado: '.$p->getEstado()); ?></div>
                            <div class="costeTotal"><?php echo('Coste total del pedido: '.$p->getCesta()->getCosteTotal().'€'); ?></div>
                            <div class="fechaCreac"><?php echo('Fecha de creación: '.$p->getFechaCreacion()->format('Y-m-d H:i:s')); ?></div>
                        </div>
                        <div class="id-pedido"><?php echo('Id del pedido'.$p->getId()); ?></div>
                    </li>
                <?php
                }
                ?>
                </ol>
            </div>
            <div style="height: 10vh; min-height: 50px; visibility: hidden"></div>
        </div>
    </body>
        <?php require_once("../footer/footer.php"); ?>
</html>
<?php
    }else{
        header("Location: ../main");
    }
?>
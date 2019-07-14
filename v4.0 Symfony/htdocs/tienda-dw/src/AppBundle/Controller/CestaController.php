<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Unidad;
use AppBundle\Entity\Cesta;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Pedido;


class CestaController extends Controller
{
   


    
    /**
     * @Route("/cesta", name="cesta", methods={"GET"})
     */
    public function cestaAction(Request $request, SessionInterface $session)
    {

        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();

        $productoRep = $em->getRepository("AppBundle\\Entity\\Producto");
        $categoriaRepo = $em->getRepository("AppBundle\\Entity\\Categoria");
        $tiendaRepo = $em->getRepository("AppBundle\\Entity\\Tienda");
        $unidadRepo = $em->getRepository("AppBundle\\Entity\\Unidad");
        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");
        $productos = $productoRep->findAll();
        $categorias = $categoriaRepo->findAll();
        $tiendas = $tiendaRepo->findAll();
        $stock = $unidadRepo->findAll();

        // $session->set('cesta', null);

        $miCesta = $session->get('cesta');
        $cesta=null;
        if( !is_null($miCesta) ){
            $cesta = $cestaRep->findOneBy(['id'=>$miCesta->getId()]);
            
        }


        
        if(!is_null($session->get('cesta'))){

            
            // console_log('Cesta');
            // console_log((array)$session->get('cesta'));
            // console_log('Unidades de la cesta');
            // console_log((array)$session->get('cesta')->getUnidades());
            // console_log('Unidad 1 de la cesta');
            // console_log((array)$session->get('cesta')->getUnidades()[0]);
            // console_log('Producto de la unidad 1 de la cesta');
            // console_log((array)$session->get('cesta')->getUnidades()[0]->getProducto());
            // console_log('Categoría del producto de la unidad 1 de la cesta');
            // console_log((array)$session->get('cesta')->getUnidades()[0]->getProducto()->getCategoria());
            
        }

        return $this->render('cesta_compra/cesta.html.twig', [  'msg'=> $message,
                                                            'tipoMessage'=> $tipoMessage,
                                                            'cesta'=>$cesta]
                                                        );


    }

     /**
     * @Route("/cancelarCesta", name="cancelarCesta", methods={"GET"})
     */
    public function cancelarCestaAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();        
        $cestaRepo = $em->getRepository("AppBundle\\Entity\\Cesta");
        $actualCesta = $cestaRepo->findOneBy(['id'=> $session->get('cesta')->getId()]); 
        if($cestaRepo->cancelarCesta($actualCesta)){
            $session->set('cesta', null);
        }else{
            //error
        }

        

        return $this->redirectToRoute('cesta');
    }


     /**
     * @Route("/tramitarPedido", name="tramitarPedido", methods={"GET"})
     */
    public function historialPedidosAction(Request $request, SessionInterface $session)
    {
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();

        
        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");



        $miCesta = $session->get('cesta');
        $cesta=null;
        if( !is_null($miCesta) ){
            $cesta = $cestaRep->findOneBy(['id'=>$miCesta->getId()]);
            
        }
        

        return $this->render('cesta_compra/tramitarPedido.html.twig', [  'msg'=> $message,
                                                                        'tipoMessage'=> $tipoMessage,
                                                                        'cesta'=>$cesta]
                                                                    );
    }

     /**
     * @Route("/tramitarPedido", name="tramitarPedido_post", methods={"POST"})
     */
    public function historialPedidosPostAction(Request $request, SessionInterface $session)
    {
        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");
        $pedidoRep = $em->getRepository("AppBundle\\Entity\\Pedido");
        $cesta = $cestaRep->findOneBy(['id'=>$session->get('cesta')->getId()]);

        if(isset($_POST['submitTram'])){
            switch($_POST['submitTram']){
                
                case 'Si':
                    $pedido = new Pedido();
                    $pedido->setCesta($cesta);
                    $pedidoRep->tramitarPedido($pedido);
                    $session->set('cesta', null);
                    return $this->redirectToRoute('homepage', ['tramP'=>1]);
                    break;
                case 'No':
                    return $this->redirectToRoute('homepage', ['tramP'=>0]);
                    break;
                default:
                return $this->redirectToRoute('homepage', ['tramP'=>0]);
                    break;
            }
        }

        
    }



}

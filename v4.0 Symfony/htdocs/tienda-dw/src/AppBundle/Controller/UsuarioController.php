<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Psr\Log\LoggerInterface;

use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Empleado;


class UsuarioController extends Controller
{

    /**
     * @Route("/login", name="login", methods={"GET"})
     */    
    public function loginAction(Request $request)
    {
        $message = null;
        $tipoMessage = null;
        if( $request->query->has('usrreg') && $request->query->get('usrreg')==1 ) {   // $_GET['error']
            $message = "Usuario registrado con éxito, proceda a loguearse";
            $tipoMessage = 1;

        }
        if( $request->query->has('usrerror') && $request->query->get('usrerror')==1 ) {   // $_GET['error']
            $message = "Usuario o contraseña incorrectos";
            $tipoMessage = 0;
        }
        
        

        return $this->render('usuario/login.html.twig', ['msg'=>$message,
                            'tipoMessage'=>$tipoMessage]);
    }

    /**
     * @Route("/login", name="login_post", methods={"POST"})
     */    
    public function loginPostAction(Request $request, SessionInterface $session, LoggerInterface $logger)
    {
        $em = $this->getDoctrine()->getManager();

        $u = new Usuario();
        
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");


        if( preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $_POST['login']) ){
            $u->setEmail($request->request->get('login'));
        } else{
            $u->setUsername($request->request->get('login'));
        }
        $u->setPasswd($request->request->get('passwd'));
        $u->encryptPasswd();

        if( ! is_null($u = $usuarioRep->login($u)) ) {
            $tipoLogueado = $u->getTipo();
            if($u->getTipo() == "empleado"){
                $empRep = $em->getRepository("AppBundle\\Entity\\Empleado");
                $u = $empRep->findByUser($u);
                if( $u->getIsAdministrador() ){
                    $tipoLogueado = "admin";
                }

            }else{
                $cliRep = $em->getRepository("AppBundle\\Entity\\Cliente");
                $u = $cliRep->findByUser($u);
            }
            
            $session->set('user', $u);
            $session->set('tipo', $tipoLogueado);
            //$sesion->set('ip', $request->request->getClientIp());
            
           // cLog("IdUsuario logueado: " . $_SESSION['user']->getIdUsuario());
           $logger->info('IdUsuario logueado:', ['usuario'=>$u->getUsuario()->getUsername()]);
           return $this->redirectToRoute('homepage', ['usrlog'=>1]);            
            
        }
        else {
            return $this->redirectToRoute('login', ['usrerror'=>1]);
            
        }

    }


    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */    
    public function logoutAction(Request $request, SessionInterface $session)
    {
        $session->invalidate();

        return $this->redirectToRoute('homepage', ['usrlog'=>0]);
    }

    /**
     * @Route("/signUp", name="signUp", methods={"GET"})
     */    
    public function signUpAction(Request $request)
    {
        $message = null;
        if( $request->query->has('usrreg') && $request->query->get('usrreg')==0 ) {   // $_GET['error']
            $message = "Nombre de usuario o email inválido";
        }        

        return $this->render('usuario/sign-up.html.twig', ['msg'=>$message]);
    }


    /**
     * @Route("/signUp", name="signUp_post", methods={"POST"})
     */    
    public function signUpPostAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $u = new Usuario();
        $c = new Cliente();
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");
        $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");
        $ubicRep = $em->getRepository("AppBundle\\Entity\\Ubicacion");

        error_reporting(E_ALL ^ E_NOTICE);
        $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['HTTP_CLIENT_IP']));
        //console_log($geo);
        $munic = $geo['geoplugin_city'];
        
        $u  ->setUsername($_POST['username'])
            ->setPasswd($_POST['passwd'])
            ->encryptPasswd()
            ->setNombre($_POST['nombre'])
            ->setApellidos($_POST['apell'])
            ->setEmail($_POST['email'])
            ->setTipo('cliente')
            ;
            
            if( $usuarioRep->existsUsername($u->getUsername()) ||
            $usuarioRep->existsEmail($u->getEmail())){
                
                return $this->redirectToRoute('signUp', ['usrreg'=>0]);
            }
            
        $em->persist($u);
        $em->flush();

        $c  ->setDomicilio($_POST['domicilio'])
            ->setUsuario($usuarioRep->findByUsername($u->getUsername()))
            ->setUbicacion($ubicRep->findByMunic($munic));

        console_log((array)$c);
        $em->persist($c);
        $em->flush();

        
        return $this->redirectToRoute('login', ['usrreg'=>1]);

    }



    /**
     * @Route("/perfil", name="perfil", methods={"GET"})
     */    
    public function perfilAction(Request $request)
    {
        $message = null;
        $tipoMessage = null;


        if( $request->query->has('updateProfile') && $request->query->get('updateProfile')==1 ) {   
            $tipoMessage = 1; //color: #2fbf2f
        }        
        if( $request->query->has('passwdchange') && $request->query->get('passwdchange')==0 ) {   
            $message = "No se pudo cambiar la contraseña";
            $tipoMessage = 0; //color: #ff7f7f
        }        
        if( $request->query->has('passwdchange') && $request->query->get('passwdchange')==1 ) {   
            $message = "Contraseña modificada con éxito";
            $tipoMessage = 1;
        }        
        if( $request->query->has('confirmpasswd') && $request->query->get('confirmpasswd')==0 ) {   
            $message = "Contraseña de confirmación incorrecta";
            $tipoMessage = 0; 
        }        
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==1 ) {   
            $message = "Operación fallida";
            $tipoMessage = 0; 
        }        

        return $this->render('usuario/perfil.html.twig', ['msg'=>$message, 'tipoMessage'=> $tipoMessage]);
    }
    
    /**
     * @Route("/perfil", name="perfil_post", methods={"POST"})
     */    
    public function perfilPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");
        $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");

        switch($_POST['optsSubmit']){
            
            case 'Actualizar Perfil':
                if( $u->getPasswd() == sha1($_POST['ContraseñaConfirm']) ){
                    if( $session->get('tipo') == "cliente"  && (! $usuarioRep->existsUsername($_POST['Username'])) && $clienteRep->updatePerfilCliente($u, $_POST['Username'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Domicilio']) ){
                        
                        return $this->redirectToRoute('perfil', ['updateProfile'=>1]);
                        
                    }else if( $session->get('tipo') == "empleado" && (! $usuarioRep->existsUsername($_POST['Username'])) && $empleadoRep->updatePerfilEmpleado($u, $_POST['Username'], $_POST['Nombre'], $_POST['Apellidos']) ){
                        return $this->redirectToRoute('perfil', ['updateProfile'=>1]);
                        
                    }else{                        
                        return $this->redirectToRoute('perfil', ['opfallida'=>1]);                        
                    }
                }else{
                    return $this->redirectToRoute('perfil', ['confirmpasswd'=>0]);    
                }
            break;            
               
            case 'Cambiar contraseña':

                if( $u->getPasswd() == sha1($_POST['oldPasswd']) ){
                    if( $_POST['newPasswd'] == $_POST['newPasswd2'] && $usuarioRep->changePasswd($u, sha1($_POST['newPasswd'])) ){
                        return $this->redirectToRoute('perfil', ['passwdchange'=>1]);    
                    }else {
                        return $this->redirectToRoute('perfil', ['passwdchange'=>0]);
                    }
                }else{
                    return $this->redirectToRoute('perfil', ['confirmpasswd'=>0]);
                }        
            break;            
                        
        }

    }
}

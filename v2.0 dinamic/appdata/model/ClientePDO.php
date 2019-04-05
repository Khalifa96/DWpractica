<?php
require_once("config.php");
require_once("Console.php");
require_once("Usuario.php");




// class ClientePDO extends Usuario 
// {
//    private $domicilio;
//    private $saldo;
//    private $cesta;
//    private $pedidos; //- Array de arrays? - Tabla de mySQL? 
   
//    public function __construct()
//    {
//       parent::__construct();
//       $this->id = spl_object_hash($this);
//       $this->domicilio;
//       // $this->tipo = "cliente";
//    }
// }

   /**
   * Añade un cliente
   * @return ?
   */
   function addCliente($username, $passwd, $nombre, $apellidos, $email, $domicilio, 
   $monedero)
   {
      try {

            if( isCliente($username) ){
                  return false;
            }

            $conn = db();
            
            $consulta = "insert into cliente (
                  username, passwd, nombre, apellidos, 
                  email, domicilio, monedero, Cesta_id)
                  values ( :username, :passwd, :nombre, :apellidos, :email, :domicilio
                  , :monedero, :Cesta_id)";
            
            $cesta_id = null;
            
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR, 45);
            $stmt->bindParam(':passwd', $passwd, PDO::PARAM_STR, 45);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR, 45);
            $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 45);
            $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR, 45);
            $stmt->bindParam(':monedero', $monedero);                  
            $stmt->bindValue(':Cesta_id', null, PDO::PARAM_INT);            
            $stmt->execute();

            // console_log("Usuario añadido");
            ?><script>alert("Añadido")</script><?php
            return true;
            
      }catch(PDOException $e){
         echo $e->getMessage();
      }

   }



   /** 
   * Obtiene todos los empleados 
   * 
   *  @return array 
   */
   
   function clientes_get_all()
   {
      $conn = db();
      
      $clientes = [];
      
      $consulta = "SELECT * FROM cliente";
      try{
         
         $stmt = $conn->query($consulta);
         
      }catch(PDOException $ex){
         echo "Hubo un error";
         console_log($ex->getMessage());
      }
      
      // if($stmt === false)
      
      // foreach($conn->query('SELECT * FROM cliente') as $row) {
         //     echo $row['id'].' '.$row['username'] .' '.$row['nombre'].' '.$row['apellidos'];
         // }
         
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = [
               'id' => $row['id'],
               'username' => $row['username'],
               'passwd' => $row['passwd'],
               'nombre' => $row['nombre'],
               'apellidos' => $row['apellidos'],
               'email' => $row['email'],
               'domicilio' => $row['domicilio'],
               'monedero' => $row['monedero'],
               'fechaCreacion' => $row['fechaCreacion'],
               'fechaModificacion' => $row['fechaModificacion'],
               'Cesta_id' => $row['Cesta_id'] 
            ];
         }
         return $clientes;
         
      }

      function isCliente($username){
            $conn = db();
            console_log("Estamos en cliente");
            
            $consulta = "SELECT count(*) as numclientes FROM cliente WHERE usernmae = :username";

            try{
         
                  $stmt = $conn->prepare($consulta);
                  $stmt->bindParam(':username', $username, PDO::PARAM_STR, 45);
                  $stmt->execute();
                  
               }catch(PDOException $ex){
                  echo "Hubo un error";
                  console_log($ex->getMessage());
            }

            if( $stmt->fetch(PDO::FETCH_ASSOC)['numClientes'] == 0 ){
                  return false;
            }else{
                  return true;
            }


      }
            
            

?>
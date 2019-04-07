<?php

require_once("Console.php");


class Cliente extends Usuario {
    protected $email;
    private $domicilio;
    private $saldo;
    private $cesta;

    public function __construct()
    {
        $this->id = "CLI:" . spl_object_hash($this);
        $this->tipo = "cliente";
    }


    public function add(){
        try {
            if( $this->isUser() ){
                return false;
            }

            $conn = db();
            
            $consulta = "insert into cliente (
                    id, username, passwd, nombre, apellidos, 
                    email, domicilio, Cesta_id)
                    values ( :id, :username, :passwd, :nombre, :apellidos, :email,
                    :domicilio, :Cesta_id)";
            
            $cesta_id = null;
            
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR, 45);
            $stmt->bindParam(':passwd', $this->passwd, PDO::PARAM_STR, 45);
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR, 45);
            $stmt->bindParam(':apellidos', $this->apell, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 45);
            $stmt->bindParam(':domicilio', $this->domicilio, PDO::PARAM_STR, 45);
            $stmt->bindValue(':Cesta_id', null, PDO::PARAM_INT);            
            $stmt->execute();

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
   
   public function get_all()
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

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'passwd' => $row['passwd'],
                'nombre' => $row['nombre'],
                'apellidos' => $row['apellidos'],
                'email' => $row['email'],
                'domicilio' => $row['domicilio'],
                'fechaCreacion' => $row['fechaCreacion'],
                'fechaModificacion' => $row['fechaModificacion'],
                'Cesta_id' => $row['Cesta_id']
            ];
        }
        return $clientes;
         
    }

    

      




    
    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    /**
     * Get the value of domicilio
     */ 
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set the value of domicilio
     *
     * @return  self
     */ 
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }



    /**
     * Get the value of saldo
     */ 
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     *
     * @return  self
     */ 
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get the value of cesta
     */ 
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set the value of cesta
     *
     * @return  self
     */ 
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }
}

?>
<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClienteRepository")
 */

class Cliente
{


    /**
     * @ORM\Id
     * @ORM\Column(name="id",length=45, nullable=false, unique=true)
     *
     */
    private $id;
    /**
     * @ORM\Column(name="domicilio",length=45, nullable=true)
     */
    private $domicilio;
    /**
     * @ORM\Column(name="saldo",type="float",  nullable=false)
     */
    private $saldo;

    /*                      F O R E I G N   K E Y S
    */

    /**
     * Un cliente tienen una ubicacion
     * @ORM\OneToOne(targetEntity="Ubicacion")
     * @ORM\JoinColumn(name="Ubicacion_idUbicacion", referencedColumnName="idUbicacion")
     */
    private $ubicacion;
    /**
     * Una cesta tiene un cliente
     * @ORM\OneToMany(targetEntity="Cesta", mappedBy="cliente")
     * @ORM\JoinColumn(name="Cesta_id", referencedColumnName="id") 
     */
    private $cesta;
    /**
     * Un cliente tiene un usuario asociado
    * @ORM\OneToOne(targetEntity="Usuario", mappedBy="cliente")
     * @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="idUsuario")
     */
    private $usuario;






    public function __construct(){
        $this->cesta = new \Doctrine\Common\Collections\ArrayCollection();
        $this->generateId();
        $this->saldo = 0;
    }

    /** GETTERS & SETTERS */


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Add the value of saldo
     *
     * @return  self
     */
    public function addSaldo($saldo)
    {
        $this->saldo += $saldo;

        return $this;
    }

    /**
     * Get un cliente tienen una ubicacion
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set un cliente tienen una ubicacion
     *
     * @return  self
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get una cesta tiene un cliente
     */
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set una cesta tiene un cliente
     *
     * @return  self
     */
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }

    /**
     * Add una cesta tiene un cliente
     *
     * @return  self
     */
    public function addCesta($cesta)
    {
        $this->cesta[sizeof((array)$this->cesta)] = $cesta;

        return $this;
    }

    /**
     * Get un usuario tiene un cliente
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set un usuario tiene un cliente
     *
     * @return  self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }


    /*MAIN METHODS*/

    private function generateId(){
        $this ->id = "CLI:" . spl_object_hash($this);
    }




}
?>

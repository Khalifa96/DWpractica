<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CestaRepository")
 */

class Cesta
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(name="id",type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(name="costeTotal",type="float", nullable=false)
     */
    private $costeTotal = 0;

    /**
    * Un cliente tiene una cesta
    * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="cesta")
    * @ORM\JoinColumn(name="Cliente_id", referencedColumnName="id")
    */
    private $cliente;

    /**
    * Un cesta tiene muchas unidades
    * @ORM\OneToMany(targetEntity="Unidad", mappedBy="cesta")
    */
    private $unidades;

    /**
    * Una cesta es de un pedido
    * @ORM\OneToOne(targetEntity="Pedido", mappedBy="cesta")
    */
    private $pedido;

    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Get the value of costeTotal
     */
    public function getCosteTotal()
    {
        return $this->costeTotal;
    }

    /**
     * Set the value of costeTotal
     *
     * @return  self
     */
    public function setCosteTotal($costeTotal)
    {
        $this->costeTotal = $costeTotal;

        return $this;
    }

    /**
     * Add the value of costeTotal
     *
     * @return  self
     */
    public function addCosteTotal($precio)
    {
        $this->costeTotal = $this->costeTotal + $precio;

        return $this;
    }

    /**
     * Get un cliente tiene una cesta
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set un cliente tiene una cesta
     *
     * @return  self
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get un cesta tiene muchas unidades
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set un cesta tiene muchas unidades
     *
     * @return  self
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get una cesta es de un pedido
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set una cesta es de un pedido
     *
     * @return  self
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }
}
?>

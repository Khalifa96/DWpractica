<?php

namespace Entities;
/**
 * @Entity
 */

 class Categoria
 {
     /**
      * @Id
      * @Column(type="integer", nullable=false)
      */
      private $id;

      /**
       * @Column(length=45, nullable=false)
       */
      private $nombre;

    /**
     * Una Categoria tiene muchos productos
     * @OneToMany(targetEntity="Producto", mappedBy="categoria")
     */
    private $productos;

    public function __construct()
    {
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();  
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
       * Get the value of nombre
       */ 
      public function getNombre()
      {
            return $this->nombre;
      }

      /**
       * Set the value of nombre
       *
       * @return  self
       */ 
      public function setNombre($nombre)
      {
            $this->nombre = $nombre;

            return $this;
      }

    /**
     * Get una Categoria tiene muchos productos
     */ 
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set una Categoria tiene muchos productos
     *
     * @return  self
     */ 
    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }
 }

?>
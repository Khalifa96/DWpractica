<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TiendaRepository extends EntityRepository
{

    public function findAll(){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('t')
            ->from('AppBundle\\Entity\\Tienda', 't');
        $res = $qb->getQuery()->getResult();
        
        return $res;   
    }

    public function exists($t){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('count(t.id)')
            ->from('AppBundle\\Entity\\Tienda', 't')
            ->where('t.email = :email')
            ->setParameter('email', $t->getEmail());
        $res = $qb->getQuery()->getSingleScalarResult();
        if( $res == 0 ){
            return false;
        } else{
            return true;
        }
    }

    public function registrarTienda($t){
        if( isset($t) && ! $this->exists($t) ){
            $this->_em->persist($t);
            $this->_em->flush();
            return true;
        }
        return false;
    }
    
    public function addTienda($tienda){
        try{
            $this->_em->persist($tienda);
            $this->_em->flush();
            return true;
        }catch(Exception $ex){
            return false;
        };
    }
}

?>
<?php 

namespace Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class UsuarioRepository extends EntityRepository{
    
    public function login($usuario){
        $qb = $this->_em->createQueryBuilder();
        if( ! is_null($usuario->getUsername()) ){
            $qb ->select('u')
                ->from('Entity\\Usuario', 'u')
                ->where('u.username = :usr', 'u.passwd = :psw')
                ->setParameter('usr', $usuario->getUsername())
                ->setParameter('psw', $usuario->getPasswd());
            console_log($usuario->getUsername());
        } else if( ! is_null($usuario->getEmail()) ){
            $qb ->select('u')
                ->from('Entity\\Usuario', 'u')
                ->where('u.email = :email', 'u.passwd = :psw')
                ->setParameter('email', $usuario->getEmail())
                ->setParameter('psw', $usuario->getPasswd());
            console_log($usuario->getEmail());
        } else{
            return false;
        }
        console_log($usuario->getPasswd());
        $res = $qb->getQuery()->getSingleResult();
        return $res;
    }

    
    public function findByUsername($username){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('u')
            ->from('Entity\\Usuario', 'u')
            ->where('u.username = :usr')
            ->setParameter('usr', $username);
        $res = $qb->getQuery()->getSingleResult();
        return $res;
    }


    public function existsUsername($username){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('count(u.idUsuario)')
            ->from('Entity\\Usuario', 'u')
            ->where('u.username = :usr')
            ->setParameter('usr', $username);
        $res = $qb->getQuery()->getSingleScalarResult();
        if( $res == 0 ){
            return false;
        } else{
            return true;
        }
    }

    public function existsEmail($email){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('count(u.idUsuario)')
            ->from('Entity\\Usuario', 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email);
        $res = $qb->getQuery()->getSingleScalarResult();
        if( $res == 0 ){
            return false;
        } else{
            return true;
        }
    }


}

?>
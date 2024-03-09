<?php

namespace App\Repository;

use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Usuario>
 *
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    // Tambien podemos crear un metodo en especifico para por ejemplo buscar un usuario por su nombre
    public function findByName($name)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.nombre = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }

    // Otra forma mas para buscar un usuario por su nombre es utilizando un metodo que use una query de sql como la siguiente (video 14 de youtube)
    public function findByNameSql($name)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT u
            FROM App\Entity\Usuario u
            WHERE u.nombre = :name'
        )->setParameter('name', $name);
        return $query->getResult();
    }


    //    /**
    //     * @return Usuario[] Returns an array of Usuario objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Usuario
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

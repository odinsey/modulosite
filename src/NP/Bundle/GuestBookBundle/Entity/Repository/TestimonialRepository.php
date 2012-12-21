<?php

namespace NP\Bundle\GuestBookBundle\Entity\Repository;

use NP\Bundle\GuestBookBundle\Enum\StatusEnum;
use Doctrine\ORM\EntityRepository;

class TestimonialRepository extends EntityRepository {

    public function findAllQuery() {
        $qb = $this->createQueryBuilder('t');

        $qb->select('t')
                ->orderBy('t.created_at', 'DESC');

        return $qb->getQuery();
    }

    public function findByStatusQuery($status) {
        $qb = $this->createQueryBuilder('t');

        $qb->select('t')
                ->where('t.status LIKE :status')
                ->orderBy('t.created_at', 'DESC')
                ->setParameter('status', $status);

        return $qb->getQuery();
    }

    public function deleteOne($id) {
        $qb = $this->createQueryBuilder('t');

        $qb->delete('NPGuestBookBundle:Testimonial', 't')
                ->where('t.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->execute();

        $this->_em->flush();
    }

    public function deleteGroup($id) {
        $qb = $this->createQueryBuilder('t');

        $qb->delete('NPGuestBookBundle:Testimonial', 't')
                ->where($qb->expr()->in('t.id', $id))
                ->getQuery()
                ->execute();

        $this->_em->flush();
    }

    public function pendingGroup($id) {
        $qb = $this->createQueryBuilder('t');

        $qb->update('NPGuestBookBundle:Testimonial', 't')
                ->set('t.status', $qb->expr()->literal(StatusEnum::PENDING))
                ->where($qb->expr()->in('t.id', $id))
                ->getQuery()
                ->execute();

        $this->_em->flush();
    }

    public function validatedGroup($id) {
        $qb = $this->createQueryBuilder('t');

        $qb->update('NPGuestBookBundle:Testimonial', 't')
                ->set('t.status', $qb->expr()->literal(StatusEnum::VALIDATED))
                ->where($qb->expr()->in('t.id', $id))
                ->getQuery()
                ->execute();

        $this->_em->flush();
    }

    public function refusedGroup($id) {
        $qb = $this->createQueryBuilder('t');

        $qb->update('NPGuestBookBundle:Testimonial', 't')
                ->set('t.status', $qb->expr()->literal(StatusEnum::REFUSED))
                ->where($qb->expr()->in('t.id', $id))
                ->getQuery()
                ->execute();

        $this->_em->flush();
    }

}
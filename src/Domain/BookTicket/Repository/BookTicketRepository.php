<?php

namespace App\Domain\BookTicket\Repository;

use App\Factory\QueryFactory;
use DomainException;
use Cake\Chronos\Chronos;
use Symfony\Component\HttpFoundation\Session\Session;

final class BookTicketRepository
{
    private $queryFactory;
    private $session;

    public function __construct(Session $session, QueryFactory $queryFactory)
    {
        $this->queryFactory = $queryFactory;
        $this->session = $session;
    }

    public function insertBookTicket(array $row): int
    {
        return (int)$this->queryFactory->newInsert('book_tickets', $row)->execute()->lastInsertId();
    }


    public function updateBookTicket(int $book_ticketID, array $data): void
    {
        $this->queryFactory->newUpdate('book_tickets', $data)->andWhere(['id' => $book_ticketID])->execute();
    }

    public function findBookTickets(array $params): array
    {
        $query = $this->queryFactory->newSelect('book_tickets');
        $query->select(
            [
                'book_tickets.id',
                'user_id',
                'seat',
                'driving_time_id',
                'price_rate_id',
                'date',
                'p.price',
                'p.start',
                'p.destiantion',
                'd.start_time'

            ]
        );

        $query->join([
            'u' => [
                'table' => 'users',
                'type' => 'INNER',
                'conditions' => 'u.id = book_tickets.user_id',
            ]
        ]);


        $query->join([
            'd' => [
                'table' => 'driving_times',
                'type' => 'INNER',
                'conditions' => 'd.id = book_tickets.driving_time_id',
            ]
        ]);

        $query->join([
            'p' => [
                'table' => 'price_rates',
                'type' => 'INNER',
                'conditions' => 'p.id = book_tickets.price_rate_id',
            ]
        ]);

        if (isset($params['id'])) {
            $query->andWhere(['u.id' => $params['id']]);
        }

        if (isset($params['time'])) {
            $query->andWhere(['d.time' => $params['time']]);
        }
        if (isset($params['date'])) {
            $query->andWhere(['date <=' => $params['endDate'], 'date >=' => $params['startDate']]);
        }

        return $query->execute()->fetchAll('assoc') ?: [];
    }
}

<?php

namespace App\Action\Api;

use App\Domain\BookTicket\Service\BookTicketFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function DI\string;

/**
 * Action.
 */
final class BookTicketUserIDAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $finder;

    public function __construct(
        BookTicketFinder $finder,
        Responder $responder
    ) {
        $this->finder = $finder;
        $this->responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();
        if (isset($params['date'])) {
            $params['startDate'] = $params['date'];
            $params['endDate'] = date('Y-m-d', strtotime($params['date'] . "+1 days"));
        }

        $rtdata['message'] = "Get BookTicket Successful";
        $rtdata['error'] = false;
        $rtdata['book_tickets'] = $this->finder->findBookTickets($params);;

        return $this->responder->withJson($response, $rtdata);
    }
}

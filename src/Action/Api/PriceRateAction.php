<?php

namespace App\Action\Api;

use App\Domain\PriceRate\Service\PriceRateFinder;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function DI\string;

/**
 * Action.
 */
final class PriceRateAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $finder;

    public function __construct(
        PriceRateFinder $finder,
        Responder $responder
    ) {
        $this->finder = $finder;
        $this->responder = $responder;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array)$request->getQueryParams();

        $rtdata['message'] = "Get PriceRate Successful";
        $rtdata['error'] = false;
        $rtdata['price_rates'] = $this->finder->findPriceRates($params);

        if ($rtdata['price_rates'] == null) {
            $rtdata['price_rates'][0]['id'] = "0";
            $rtdata['price_rates'][0]['start'] = $params['start'];
            $rtdata['price_rates'][0]['destiantion'] = $params['destiantion'];
            $rtdata['price_rates'][0]['price'] = "0";
        }

        return $this->responder->withJson($response, $rtdata);
    }
}

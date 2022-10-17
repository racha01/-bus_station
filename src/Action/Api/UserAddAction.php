<?php

namespace App\Action\Api;

use App\Domain\User\Service\UserFinder;
use App\Domain\User\Service\UserUpdater;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
final class UserAddAction
{
    /**
     * @var Responder
     */
    private $responder;
    private $finder;
    private $updater;

    public function __construct(
        UserFinder $finder,
        UserUpdater $updater,
        Responder $responder,
    ) {
        $this->finder = $finder;
        $this->updater = $updater;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = (array)$request->getParsedBody();

        function utf8_strrev($str)
        {
            preg_match_all('/./us', $str, $ar);
            return join('', array_reverse($ar[0]));
        }
        function pass_encrypt($pass, $show = false)
        {
            //you secret word
            $key1    = 'asdfasf';
            $key2    = 'asdfasdf';
            $loop    = 1;
            $reverse = utf8_strrev($pass);
            if ($show == true) {
            }
            for ($i = 0; $i < $loop; $i++) {
                $md5 = md5($reverse);
                if ($show == true) {
                }
                $reverse_md5 = utf8_strrev($md5);
                if ($show == true) {
                }
                $salt = substr($reverse_md5, -13) . md5($key1) . substr($reverse_md5, 0, 19) . md5($key2);
                if ($show == true) {
                }
                $new_md5 = md5($salt);
                if ($show == true) {
                }
                $reverse = utf8_strrev($new_md5);
                if ($show == true) {
                }
            }
            return md5($reverse);
        }
        
        $encrypt = pass_encrypt($data['password'], true);

        $hash    = password_hash($encrypt, PASSWORD_DEFAULT);

        $data['password'] = $hash;

        $this->updater->insertUser($data);

        return $this->responder->withJson($response, $data);
    }
}

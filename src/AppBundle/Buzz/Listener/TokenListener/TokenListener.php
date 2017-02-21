<?php

/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 21/02/2017
 * Time: 16:09
 */

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Util\Cookie;
use Buzz\Util\CookieJar;

class TokenListener implements ListenerInterface
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function preSend(RequestInterface $request)
    {
        $jar = new CookieJar();
        $cookie = new Cookie();
        $cookie->setName('token');
        $cookie->setValue($this->token);
        $cookie->setAttribute('domain', parse_url($request->getHost(), PHP_URL_HOST));

        $jar->addCookie($cookie);
        $jar->addCookieHeaders($request);
    }

    function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}
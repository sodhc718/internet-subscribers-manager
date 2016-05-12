<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class LoginAction
{
    private $view;
    private $logger;
    private $auth;

    public function __construct(Twig $view, LoggerInterface $logger, $db, $auth)
    {
        $this->db = $db;
        $this->view = $view;
        $this->logger = $logger;
        $this->auth = $auth;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        if(isset($_SESSION['auth'])) {
            return $response->withRedirect('plans-manager');
        }
        if($request->isPost()) {
            $auth_username = key($this->auth);
            $auth_password = $this->auth[key($this->auth)];
            $allPostVar = $request->getParsedBody();
            $username = $allPostVar['username'];
            $password = $allPostVar['password'];
            if($username == $auth_username && $password == $auth_password) {
                $_SESSION['auth'] = 'admin';
                return $response->withRedirect('plans-manager');
            }
        }

        $this->view->render($response, 'login.twig');
        return $response;
    }
}
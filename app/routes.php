<?php
// Routes

$app->get('/', App\controllers\HomeAction::class)
    ->setName('homepage');

$app->get('/plans-manager', App\controllers\PlansManager::class)
    ->setName('plans-manager');

$app->get('/subs-manager', App\controllers\SubscribersManager::class)
    ->setName('subs-manager');

$app->get('/login', App\controllers\LoginAction::class)
    ->setName('login');

$app->post('/login', App\controllers\LoginAction::class)
    ->setName('login');

$app->get('/logout', App\controllers\LogoutAction::class)
    ->setName('logout');
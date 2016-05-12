<?php
// Routes

$app->get('/', App\controllers\HomeAction::class)
    ->setName('homepage');

$app->get('/plans-manager', App\controllers\PlansManager::class)
    ->setName('plans-manager');

$app->get('/get-plan-data', App\controllers\PlansManager::class. ':getPlanData')
    ->setName('get-plan-data');

$app->get('/get-plan-data-id', App\controllers\PlansManager::class. ':getPlanDataByID')
    ->setName('get-plan-data-id');

$app->get('/subs-manager', App\controllers\SubscribersManager::class)
    ->setName('subs-manager');

$app->get('/login', App\controllers\LoginAction::class)
    ->setName('login');

$app->post('/login', App\controllers\LoginAction::class)
    ->setName('login');

$app->get('/logout', App\controllers\LogoutAction::class)
    ->setName('logout');

$app->get('/add-plan', App\controllers\AddPlan::class)
    ->setName('add-plan');

$app->post('/add-plan', App\controllers\AddPlan::class)
    ->setName('add-plan');

$app->get('/delete-plan', App\controllers\DeletePlan::class)
    ->setName('delete-plan');

<?php
// Routes

$app->get('/', App\controllers\HomeAction::class)
    ->setName('homepage');

$app->get('/plans-manager', App\controllers\PlansManager::class)
    ->setName('plans-manager');

$app->get('/subs-manager', App\controllers\SubscribersManager::class)
    ->setName('subs-manager');

$app->get('/add-plan', App\controllers\AddPlan::class)
    ->setName('add-plan');

$app->post('/add-plan', App\controllers\AddPlan::class)
    ->setName('add-plan');

$app->get('/delete-plan', App\controllers\DeletePlan::class)
    ->setName('delete-plan');

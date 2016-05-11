<?php
// Routes

$app->get('/', App\controllers\HomeAction::class)
    ->setName('homepage');

$app->get('/plans-manager', App\controllers\PlansManager::class)
    ->setName('plans-manager');

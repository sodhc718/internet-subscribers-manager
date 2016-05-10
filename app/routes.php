<?php
// Routes

$app->get('/', App\controllers\HomeAction::class)
    ->setName('homepage');

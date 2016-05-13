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

$app->post('/update-plan', App\controllers\PlansManager::class. ':updatePlan')
    ->setName('update-plan');

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

$app->get('/add-subscriber', App\controllers\AddSubscriber::class)
    ->setName('add-subscriber');

$app->post('/add-subscriber', App\controllers\AddSubscriber::class)
    ->setName('add-subscriber');

$app->get('/delete-customer', App\controllers\DeleteCustomer::class)
    ->setName('delete-customer');

$app->get('/get-customer-data-subnum', App\controllers\SubscribersManager::class. ':getCustomerDataBySubNum')
    ->setName('get-customer-data-subnum');

$app->post('/update-subs', App\controllers\SubscribersManager::class. ':updateSubs')
    ->setName('update-subs');

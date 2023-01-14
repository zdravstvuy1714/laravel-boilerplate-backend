<?php

declare(strict_types=1);

/** @var Illuminate\Routing\Router $router */

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

$router->get('/', function () {
    $user = \Modules\User\Entities\User::query()->first();

    Mail::raw('Hi, welcome user!', static function (Message $message) use ($user) {
        $message
            ->to($user->email)
            ->subject('Тема');
    });
});

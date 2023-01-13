<?php

declare(strict_types=1);

namespace Modules\Blog\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

final class NotifyUsersOfANewPosts implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
    }

    public function handle(object $event): void
    {
    }
}

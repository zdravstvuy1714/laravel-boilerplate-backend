<?php

declare(strict_types=1);

namespace Modules\Blog\Events;

use Illuminate\Queue\SerializesModels;

final class BlogPostWasUpdated
{
    use SerializesModels;

    public function __construct()
    {
    }
}

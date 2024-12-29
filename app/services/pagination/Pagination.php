<?php

namespace app\services\pagination;

use app\core\Paginator;

abstract class Pagination
{
    protected Paginator $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Render the pagination.
     */
    abstract public function render(): string;

    /**
     * Helper to generate a page URL.
     */
    protected function generatePageUrl(int $page): string
    {
        return $this->paginator->url($page);
    }
}

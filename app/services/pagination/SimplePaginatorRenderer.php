<?php

namespace app\services\pagination;

use app\core\Paginator;

/**
 * SimplePaginatorRenderer
 *
 * Renders pagination with a fixed range of visible pages.
 */
class SimplePaginatorRenderer extends Pagination
{
    protected int $maxVisiblePages;

    /**
     * Constructor
     *
     * @param Paginator $paginator The paginator instance.
     * @param int $maxVisiblePages Number of visible pages (default: 5).
     */
    public function __construct(Paginator $paginator, int $maxVisiblePages = 5)
    {
        parent::__construct($paginator);
        $this->maxVisiblePages = $maxVisiblePages;
    }

    /**
     * Render the pagination.
     *
     * @return string The HTML string for the pagination.
     */
    public function render(): string
    {
        $output = '<nav class="pagination">';
        $currentPage = $this->paginator->currentPage();
        $lastPage = $this->paginator->lastPage();

        // Determine the fixed page range
        $rangeStart = (int) (ceil($currentPage / $this->maxVisiblePages) - 1) * $this->maxVisiblePages + 1;
        $rangeEnd = min($lastPage, $rangeStart + $this->maxVisiblePages - 1);

        // Previous and First links
        if ($this->paginator->hasPreviousPage()) {
            $output .= '<a href="' . $this->paginator->firstPageUrl() . '">First</a>';
            $output .= '<a href="' . $this->paginator->previousPageUrl() . '">Previous</a>';
        }

        // Page numbers
        for ($page = $rangeStart; $page <= $rangeEnd; $page++) {
            $isActive = $page === $currentPage ? 'active' : '';
            $output .= '<a href="' . $this->paginator->url($page) . '" class="' . $isActive . '">' . $page . '</a>';
        }

        // Next and Last links
        if ($this->paginator->hasMorePages()) {
            $output .= '<a href="' . $this->paginator->nextPageUrl() . '">Next</a>';
            $output .= '<a href="' . $this->paginator->lastPageUrl() . '">Last</a>';
        }

        $output .= '</nav>';
        return $output;
    }
}

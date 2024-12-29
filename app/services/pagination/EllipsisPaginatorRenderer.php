<?php

namespace app\services\pagination;

use app\core\Paginator;

class EllipsisPaginatorRenderer extends Pagination
{
    protected int $centerVisiblePages;

    /**
     * Constructor
     *
     * @param Paginator $paginator
     * @param int $centerVisiblePages Number of visible center pages (default: 3)
     */
    public function __construct(Paginator $paginator, int $centerVisiblePages = 3)
    {
        parent::__construct($paginator);
        $this->centerVisiblePages = $centerVisiblePages;
    }

    /**
     * Render the pagination HTML.
     *
     * @return string
     */
    public function render(): string
    {
        $output = '<nav class="pagination">';
        $currentPage = $this->paginator->currentPage();
        $lastPage = $this->paginator->lastPage();

        // Previous Button
        if ($this->paginator->hasPreviousPage()) {
            $output .= '<a href="' . $this->paginator->previousPageUrl() . '" class="prev">Previous</a>';
        } else {
            $output .= '<span class="prev disabled">Previous</span>';
        }

        // Always show the first three pages
        if ($lastPage <= 3) { 
            for ($page = 1; $page <= min(3, $lastPage); $page++) {
                $isActive = $page === $currentPage ? 'active' : '';
                $output .= '<a href="' . $this->paginator->url($page) . '" class="' . $isActive . '">' . $page . '</a>';
            }
        }

        // Ellipsis before center pages
        if ($currentPage > 4) {
            $output .= '<span class="ellipsis">...</span>';
        }

        // Center pages
        if ($currentPage > 3 && $currentPage < $lastPage - 2) {
            $startPage = max(4, $currentPage - floor($this->centerVisiblePages / 2));
            $endPage = min($lastPage - 3, $currentPage + floor($this->centerVisiblePages / 2));

            for ($page = $startPage; $page <= $endPage; $page++) {
                $isActive = $page === $currentPage ? 'active' : '';
                $output .= '<a href="' . $this->paginator->url($page) . '" class="' . $isActive . '">' . $page . '</a>';
            }
        }

        // Ellipsis after center pages
        if ($currentPage < $lastPage - 3) {
            $output .= '<span class="ellipsis">...</span>';
        }

        // Always show the last three pages
        $startLastPages = max($lastPage - 2, 4);
        for ($page = $startLastPages; $page <= $lastPage; $page++) {
            $isActive = $page === $currentPage ? 'active' : '';
            $output .= '<a href="' . $this->paginator->url($page) . '" class="' . $isActive . '">' . $page . '</a>';
        }

        // Next Button
        if ($this->paginator->hasMorePages()) {
            $output .= '<a href="' . $this->paginator->nextPageUrl() . '" class="next">Next</a>';
        } else {
            $output .= '<span class="next disabled">Next</span>';
        }

        $output .= '</nav>';
        return $output;
    }
}

<?php

namespace app\core;

class Paginator
{
    protected int $currentPage;
    protected int $perPage;
    protected int $totalItems;
    protected int $totalPages;
    protected array $data;
    protected string $path; // Base path for generating URLs
    protected string $pageName = 'page'; // Query string variable for page

    public function __construct(array $data, int $totalItems, int $currentPage = 1, int $perPage = 15, string $path = '')
    {
        $this->data = $data;
        $this->totalItems = $totalItems;
        $this->perPage = $perPage;
        $this->currentPage = max(1, min($currentPage, $this->calculateTotalPages()));
        $this->totalPages = $this->calculateTotalPages();
        $this->path = $path ?: ($_SERVER['REQUEST_URI'] ?? '/');
    }

    /**
     * Calculate total number of pages.
     */
    protected function calculateTotalPages(): int
    {
        return (int) ceil($this->totalItems / $this->perPage);
    }

    /**
     * Get current page number.
     */
    public function currentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * Get items per page.
     */
    public function perPage(): int
    {
        return $this->perPage;
    }

    /**
     * Get total items.
     */
    public function total(): int
    {
        return $this->totalItems;
    }

    /**
     * Get total pages.
     */
    public function lastPage(): int
    {
        return $this->totalPages;
    }

    /**
     * Get data for the current page.
     */
    public function items(): array
    {
        // 데이터에 페이지 아이템 번호 추가
        $offset = $this->getOffset(); // 현재 페이지의 시작 인덱스 계산
        $pageItemStart = $this->totalItems - $offset; // 현재 페이지의 첫 번째 아이템 번호

        // 각 데이터에 페이지 아이템 번호 추가
        return array_map(function ($item, $index) use ($pageItemStart) {
            $item['_no'] = $pageItemStart - $index;
            return $item;
        }, $this->data, array_keys($this->data));
    }

    /**
     * Get the offset for the current page.
     */
    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    /**
     * Determine if on the first page.
     */
    public function onFirstPage(): bool
    {
        return $this->currentPage === 1;
    }

    /**
     * Determine if there is a next page.
     */
    public function hasMorePages(): bool
    {
        return $this->currentPage < $this->totalPages;
    }

    /**
     * Get URL for a specific page.
     */
    public function url(int $page = 1): string
    {
        $path = strtok($this->path, '?'); // Remove query string
        $query = array_merge($_GET, [$this->pageName => $page]); // Add or update page parameter
        return $path . '?' . http_build_query($query);
    }

    /**
     * Determine if there is a previous page.
     */
    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1; // Ensure currentPage > 1
    }

    /**
     * Determine if there is a next page.
     */
    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->totalPages;
    }

    /**
     * Get URL for the next page.
     */
    public function nextPageUrl(): ?string
    {
        return $this->hasMorePages() ? $this->url($this->currentPage + 1) : null;
    }

    /**
     * Get URL for the previous page.
     */
    public function previousPageUrl(): ?string
    {
        return $this->currentPage > 1 ? $this->url($this->currentPage - 1) : null;
    }

    /**
     * Get URL for the first page.
     */
    public function firstPageUrl(): string
    {
        return $this->url(1);
    }

    /**
     * Get URL for the last page.
     */
    public function lastPageUrl(): string
    {
        return $this->url($this->totalPages);
    }

    /**
     * Convert paginator to an array.
     */
    public function toArray(): array
    {
        return [
            'data' => $this->items(),
            'total' => $this->totalItems,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'last_page' => $this->totalPages,
            'first_page_url' => $this->firstPageUrl(),
            'last_page_url' => $this->lastPageUrl(),
            'next_page_url' => $this->nextPageUrl(),
            'prev_page_url' => $this->previousPageUrl(),
            'path' => strtok($this->path, '?'),
            'from' => $this->getOffset() + 1,
            'to' => min($this->getOffset() + $this->perPage, $this->totalItems),
        ];
    }

    /**
     * Convert paginator to JSON.
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Set custom page name for query string.
     */
    public function setPageName(string $name = 'page'): void
    {
        $this->pageName = $name;
    }

    /**
     * Get the current page name.
     */
    public function getPageName(): string
    {
        return $this->pageName;
    }
}

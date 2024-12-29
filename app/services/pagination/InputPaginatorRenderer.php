<?php

namespace app\services\pagination;

class InputPaginatorRenderer extends Pagination
{
    public function render(): string
    {
        $currentPage = $this->paginator->currentPage();
        $lastPage = $this->paginator->lastPage();

        $output = '<div class="pagination-input">';
        $output .= '<input type="number" min="1" max="' . $lastPage . '" value="' . $currentPage . '" 
                    onchange="window.location.href=\'' . $this->generatePageUrl(1) . '&page=\' + this.value" />';
        $output .= '<span>' . $currentPage . ' / ' . $lastPage . '</span>';
        $output .= '</div>';

        return $output;
    }
}

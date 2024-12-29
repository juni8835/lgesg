<?php

namespace app\services\pagination;


class CursorPaginatorRenderer extends Pagination
{
    public function render(): string
    {
        $output = '<div class="cursor-pagination">';
        $output .= '<ul>';

        foreach ($this->paginator->items() as $item) {
            $output .= '<li>' . htmlspecialchars(json_encode($item)) . '</li>';
        }

        $output .= '</ul>';

        if ($this->paginator->hasMorePages()) {
            $output .= '<button onclick="loadMore()">Load More</button>';
            $output .= '<script>
                function loadMore() {
                    fetch("' . $this->paginator->nextPageUrl() . '")
                        .then(response => response.text())
                        .then(data => {
                            document.querySelector(".cursor-pagination ul").innerHTML += data;
                        });
                }
            </script>';
        }

        $output .= '</div>';
        return $output;
    }
}

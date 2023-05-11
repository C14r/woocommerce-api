<?php

namespace C14r\Woocommerce\V3\Traits;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Trait All
 *
 * Provides methods for retrieving all items or paginated items.
 */
trait All
{
    /**
     * Retrieves all items.
     *
     * @param int $per_page The number of items per page.
     *
     * @return \Illuminate\Support\Collection The collection of items.
     */
    public function all(int $per_page = 100)
    {
        $collection = collect($this->per_page($per_page)->page(1)->get());

        $this->do_clear = false;

        for ($page = 2; $page <= $this->getTotalPages(); $page++) {
            $collection = $collection->merge($this->page($page)->get());
        }

        $this->do_clear = true;
        $this->clear();

        return $collection;
    }

    /**
     * Retrieves paginated items.
     *
     * @param int|null $per_page The number of items per page.
     * @param int|null $page The page number.
     * @param array $options Additional options for the paginator.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator The paginated items.
     */
    public function paginate($per_page = 25, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $this->per_page($per_page)->page($page)->get();

        return new LengthAwarePaginator($items, $this->getTotal(), $per_page, $page, $options);
    }

    /**
     * Retrieves the total number of pages.
     *
     * @return int The total number of pages.
     */
    private function getTotalPages(): int
    {
        return (int) $this->getHeader('x-wp-totalpages');
    }

    /**
     * Retrieves the total number of items.
     *
     * @return int The total number of items.
     */
    private function getTotal(): int
    {
        return (int) $this->getHeader('x-wp-total');
    }
}

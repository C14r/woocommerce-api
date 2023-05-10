<?php

namespace C14r\Woocommerce\V3\Traits;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

trait All
{
    public function all(int $per_page = 100)
    {
        $collection = collect($this->per_page($per_page)->page(1)->get());

        $this->do_clear = false;

        for ($page=2; $page <= $this->getTotalPages(); $page++) {
            $collection = $collection->merge($this->page($page)->get());
        }

        $this->do_clear = true;
        $this->clear();

        return $collection;
    }

    public function paginate($per_page = 25, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $this->per_page($per_page)->page($page)->get();

        return new LengthAwarePaginator($items, $this->getTotal(), $per_page, $page, $options);
    }

    

    private function getTotalPages(): int
    {
        return (int) $this->getHeader('x-wp-totalpages');
    }

    private function getTotal(): int
    {
        return (int) $this->getHeader('x-wp-total');
    }
}
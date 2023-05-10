<?php

namespace C14r\Woocommerce\V3\Services;

use C14r\Woocommerce\V3\Enums\ProductStatus;

class ProductService extends Service
{
    public function increseStockQuantity(int $product_id, int $amount = 1): self
    {
        $quantity = $this->getStockQuantity($product_id);

        return $this->setStockQuantity($product_id, $quantity + $amount);
    }

    public function decreseStockQuantity(int $product_id, int $amount = 1): self
    {
        $quantity = $this->getStockQuantity($product_id);

        return $this->setStockQuantity($product_id, $quantity - $amount);
    }

    public function setStockQuantity(int $product_id, int $stock_quantity): self
    {
        return $this->update($product_id, compact('stock_quantity'));
    }

    public function getStockQuantity(int $product_id): int
    {
        return (int) $this->get($product_id)->stock_quantity ?? 0;
    }

    public function setStatus(int $product_id, ProductStatus $status): self
    {
        return $this->update($product_id, compact('status'));
    }

    public function rename(int $product_id, string $name): self
    {
        return $this->update($product_id, compact('name'));
    }

    public function get(int $product_id): object
    {
        return $this->api->product($product_id)->get();
    }

    public function update(int $product_id, array $data): self
    {
        return tap($this, function($service) use ($product_id, $data) {
            $service->api->product($product_id)->update($data);
        });
    }
}
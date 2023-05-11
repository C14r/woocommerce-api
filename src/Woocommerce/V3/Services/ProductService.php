<?php

namespace C14r\Woocommerce\V3\Services;

use C14r\Woocommerce\V3\Enums\ProductStatus;

class ProductService extends Service
{
    /**
     * Increase the stock quantity of a product.
     *
     * @param int $product_id The ID of the product.
     * @param int $amount The amount to increase the stock quantity by. Default is 1.
     * @return self The ProductService instance.
     */
    public function increaseStockQuantity(int $product_id, int $amount = 1): self
    {
        $quantity = $this->getStockQuantity($product_id);

        // Set the new stock quantity by adding the specified amount to the current quantity.
        return $this->setStockQuantity($product_id, $quantity + $amount);
    }

    /**
     * Decrease the stock quantity of a product.
     *
     * @param int $product_id The ID of the product.
     * @param int $amount The amount to decrease the stock quantity by. Default is 1.
     * @return self The ProductService instance.
     */
    public function decreaseStockQuantity(int $product_id, int $amount = 1): self
    {
        $quantity = $this->getStockQuantity($product_id);

        // Set the new stock quantity by subtracting the specified amount from the current quantity.
        return $this->setStockQuantity($product_id, $quantity - $amount);
    }

    /**
     * Set the stock quantity of a product.
     *
     * @param int $product_id The ID of the product.
     * @param int $stock_quantity The new stock quantity.
     * @return self The ProductService instance.
     */
    public function setStockQuantity(int $product_id, int $stock_quantity): self
    {
        // Update the product with the new stock quantity.
        return $this->update($product_id, compact('stock_quantity'));
    }

    /**
     * Get the stock quantity of a product.
     *
     * @param int $product_id The ID of the product.
     * @return int The stock quantity of the product.
     */
    public function getStockQuantity(int $product_id): int
    {
        // Retrieve the product and return its stock quantity.
        return (int) $this->get($product_id)->stock_quantity ?? 0;
    }

    /**
     * Set the status of a product.
     *
     * @param int $product_id The ID of the product.
     * @param ProductStatus $status The new status of the product.
     * @return self The ProductService instance.
     */
    public function setStatus(int $product_id, ProductStatus $status): self
    {
        // Update the product with the new status.
        return $this->update($product_id, compact('status'));
    }

    /**
     * Rename a product.
     *
     * @param int $product_id The ID of the product.
     * @param string $name The new name of the product.
     * @return self The ProductService instance.
     */
    public function rename(int $product_id, string $name): self
    {
        // Update the product with the new name.
        return $this->update($product_id, compact('name'));
    }

    /**
     * Get a product.
     *
     * @param int $product_id The ID of the product.
     * @return object The product object.
     */
    public function get(int $product_id): object
    {
        // Retrieve the product from the API.
        return $this->api->product($product_id)->get();
    }

    /**
     * Update a product with the given data.
     *
     * @param int $product_id The ID of the product.
     * @param array $data The data to update the product with.
     * @return self The ProductService instance.
     */
    public function update(int $product_id, array $data): self
    {
        // Update the product using the API.
        return tap($this, function ($service) use ($product_id, $data) {
            $service->api->product($product_id)->update($data);
        });
    }
}

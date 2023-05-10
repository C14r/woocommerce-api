<?php

namespace C14r\Woocommerce\V3\Traits\Endpoints;

trait Products
{
    /**
     * API-Request for products/attributes/:attribute_id/terms

     * @param int $attribute_id Unique identifier for the attribute of the terms.
     * @return API
     */
    public function productAttributeTerms(int $attribute_id): self
    {
        return $this->endpoint('products/attributes/:attribute_id/terms')->parameters(compact('attribute_id'));
    }

    /**
     * API-Request for products/attributes/:attribute_id/terms/:id

     * @param int $attribute_id Unique identifier for the attribute of the terms.
     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function productAttributeTerm(int $attribute_id, int $id): self
    {
        return $this->endpoint('products/attributes/:attribute_id/terms/:id')->parameters(compact('attribute_id', 'id'));
    }

    /**
     * API-Request for products/attributes/:attribute_id/terms/batch

     * @param int $attribute_id Unique identifier for the attribute of the terms.
     * @return API
     */
    public function productAttributeTermBatch(int $attribute_id): self
    {
        return $this->endpoint('products/attributes/:attribute_id/terms/batch')->parameters(compact('attribute_id'));
    }

    /**
     * API-Request for products/attributes

     * @return API
     */
    public function productAttributes(): self
    {
        return $this->endpoint('products/attributes');
    }

    /**
     * API-Request for products/attributes/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function productAttribute(int $id): self
    {
        return $this->endpoint('products/attributes/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for products/attributes/batch

     * @return API
     */
    public function productAttributeBatch(): self
    {
        return $this->endpoint('products/attributes/batch');
    }

    /**
     * API-Request for products/categories

     * @return API
     */
    public function productCategories(): self
    {
        return $this->endpoint('products/categories');
    }

    /**
     * API-Request for products/categories/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function productCategory(int $id): self
    {
        return $this->endpoint('products/categories/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for products/categories/batch

     * @return API
     */
    public function productCategoryBatch(): self
    {
        return $this->endpoint('products/categories/batch');
    }

    /**
     * API-Request for products/:product_id/reviews

     * @param int $product_id Unique identifier for the variable product.
     * @return API
     */
    public function productReviews(int $product_id): self
    {
        return $this->endpoint('products/:product_id/reviews')->parameters(compact('product_id'));
    }

    /**
     * API-Request for products/:product_id/reviews/:id

     * @param int $product_id Unique identifier for the variable product.
     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function productReview(int $product_id, int $id): self
    {
        return $this->endpoint('products/:product_id/reviews/:id')->parameters(compact('product_id', 'id'));
    }

    /**
     * API-Request for products/:product_id/reviews/batch

     * @param int $product_id Unique identifier for the variable product.
     * @return API
     */
    public function productReviewBatch(int $product_id): self
    {
        return $this->endpoint('products/:product_id/reviews/batch')->parameters(compact('product_id'));
    }

    /**
     * API-Request for products/shipping_classes

     * @return API
     */
    public function productShippingClasses(): self
    {
        return $this->endpoint('products/shipping_classes');
    }

    /**
     * API-Request for products/shipping_classes/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function productShippingClass(int $id): self
    {
        return $this->endpoint('products/shipping_classes/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for products/shipping_classes/batch

     * @return API
     */
    public function productShippingClassBatch(): self
    {
        return $this->endpoint('products/shipping_classes/batch');
    }

    /**
     * API-Request for products/tags

     * @return API
     */
    public function productTags(): self
    {
        return $this->endpoint('products/tags');
    }

    /**
     * API-Request for products/tags/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function productTag(int $id): self
    {
        return $this->endpoint('products/tags/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for products/tags/batch

     * @return API
     */
    public function productTagBatch(): self
    {
        return $this->endpoint('products/tags/batch');
    }

    /**
     * API-Request for products

     * @return API
     */
    public function products(): self
    {
        return $this->endpoint('products');
    }

    /**
     * API-Request for products/:id

     * @param int $id Unique identifier for the resource.
     * @return API
     */
    public function product(int $id): self
    {
        if($this->hasEndpoint())
        {
            return $this->query('product', $id);
        }

        return $this->endpoint('products/:id')->parameters(compact('id'));
    }

    /**
     * API-Request for products/batch

     * @return API
     */
    public function productBatch(): self
    {
        return $this->endpoint('products/batch');
    }

    /**
     * API-Request for products/:product_id/variations

     * @param int $product_id Unique identifier for the variable product.
     * @return API
     */
    public function productVariations(int $product_id): self
    {
        return $this->endpoint('products/:product_id/variations')->parameters(compact('product_id'));
    }

    /**
     * API-Request for products/:product_id/variations/:id

     * @param int $product_id Unique identifier for the variable product.
     * @param int $id Unique identifier for the variation.
     * @return API
     */
    public function productVariation(int $product_id, int $id): self
    {
        return $this->endpoint('products/:product_id/variations/:id')->parameters(compact('product_id', 'id'));
    }

    /**
     * API-Request for products/:product_id/variations/batch

     * @param int $product_id Unique identifier for the variable product.
     * @return API
     */
    public function productVariationsBatch(int $product_id): self
    {
        return $this->endpoint('products/:product_id/variations/batch')->parameters(compact('product_id'));
    }
}
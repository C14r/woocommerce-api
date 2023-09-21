# WooCommerce API Wrapper for PHP

![packagist version](https://img.shields.io/packagist/v/c14r/woocommerce-api)

This package allows users to easily consume the REST API provided by [automattic/woocommerce](https://github.com/automattic/woocommerce) in any Laravel app.

## Installing

The recommended way to install WooCommerce-API is through
[Composer](https://getcomposer.org/).

```bash
composer require c14r/woocommerce-api
```

## .env-File

````env
WOOCOMMERCE_URL=https://www.your-shop.com/
WOOCOMMERCE_KEY=ck_???
WOOCOMMERCE_SECRET=cs_???
WOOCOMMERCE_VERSION=wc/v3
````

## Configuration

If you want to change the default configuration or you want to use multiple connection you can publish the ``config/woocommerce.php`` by ``php artisan vendor:publish --tag=woocommerce-config`

## Table of Content

- [WooCommerce API Wrapper for PHP](#woocommerce-api-wrapper-for-php)
  - [Installing](#installing)
  - [.env-File](#env-file)
  - [Configuration](#configuration)
  - [Table of Content](#table-of-content)
- [ToDos](#todos)
  - [README.md](#readmemd)
  - [Germanized](#germanized)
- [Usage](#usage)
  - [Retrieving an instance](#retrieving-an-instance)
  - [Filtering](#filtering)
  - [Cacheing](#cacheing)
  - [Configuration](#configuration-1)
  - [Pagination](#pagination)
- [Services Classes](#services-classes)
  - [ProductService](#productservice)
  - [CustomerService](#customerservice)
  - [OrderService](#orderservice)
- [API](#api)
  - [Coupons](#coupons)
  - [Customers](#customers)
  - [Orders](#orders)
    - [Order Notes](#order-notes)
    - [Order Refunds](#order-refunds)
  - [Product](#product)
    - [Product Attributes](#product-attributes)
    - [Product Attribute Terms](#product-attribute-terms)
    - [Product Categories](#product-categories)
    - [Product Reviews](#product-reviews)
    - [Product Tags](#product-tags)
    - [Product Variations](#product-variations)
  - [Shipping](#shipping)
    - [Shipping Methods](#shipping-methods)
    - [Shipping Zones](#shipping-zones)
    - [Shipping Zones Locations](#shipping-zones-locations)
    - [Shipping Zones Method](#shipping-zones-method)
  - [Reports](#reports)
    - [Report Sales](#report-sales)
    - [Report Top Seller](#report-top-seller)
  - [Settings](#settings)
  - [Taxes](#taxes)
    - [Tax Classes](#tax-classes)
  - [Webhooks](#webhooks)
  - [Payment Gateways](#payment-gateways)
  - [System](#system)
    - [System Status](#system-status)
    - [System Status Tools](#system-status-tools)

# ToDos

## README.md

The documentation ist still not complete.

## Germanized

https://vendidero.de/dokument/shipments-rest-api

* Shipments
* Cancellations
* Invoices

# Usage

## Retrieving an instance

```php
use C14r\Woocommerce\V3\API;

// via helper function
$api = woo();

// via dependency injection
public function example(API $api)

// via singleton
$api = API::getInstance();
```

## Filtering

## Cacheing

Every `get()` or `all()` request can be cached, you just need to call the `cache()` or `cacheAll()` methods.

```php
$order = $api->order($order_id)->cache(); // instead of ...->get()
$orders = $api->orders()->cacheAll(); // instead of ...->all()
```

## Configuration

## Pagination

Instead of calling `->per_page(25)->page($page)->get()` or `->all()` you can use the default laravel pagination. For more information see the [Laravel Docs](https://laravel.com/docs/10.x/pagination).

```php
$orders = $api->paginate();
```

# Services Classes

Service classes simplify API usage by wrapping API calls into specialized methods, improving code readability, maintainability, and reducing API interaction complexity.

## ProductService

```php
$service->increseStockQuantity(int $product_id, int $amount = 1);
$service->decreseStockQuantity(int $product_id, int $amount = 1);
$service->setStockQuantity(int $product_id, int $stock_quantity);
$service->getStockQuantity(int $product_id);
$service->setStatus(int $product_id, ProductStatus $status);
$service->rename(int $product_id, string $name);
$service->get(int $product_id);
$service->update(int $product_id, array $data);
```

## CustomerService

```php

```

## OrderService

```php
$service->get(int $order_id);
$service->getWithCustomer(int $order_id);
```

# API

## Coupons

```php
// List Coupons
$api->coupons()->get();

// Retrieve an Coupon
$api->coupon($coupon_id)->get();

// Create an Coupon
$api->coupons()->create([
    'code' => '10off',
    'discount_type' => CouponsDiscountType::percent,
    'amount' => 10,
    'individual_use' => true,
    'exclude_sale_items' => true,
    'minimum_amount' => 100.00
]);

// Update an Coupon
$api->coupon($coupon_id)->update([
    'amount' => 5
]);

// Delete an Coupon
$api->coupon($coupon_id)->delete();

// Batch
$api->couponBatch()->post([
    'create' => [
        [
            'code' => '20off',
            'discount_type' => CouponsDiscountType::percent,
            'amount' => 20,
            'individual_use' => true,
            'exclude_sale_items' => true,
            'minimum_amount' => 100.00
        ],
        [
            'code' => '30off',
            'discount_type' => CouponsDiscountType::percent,
            'amount' => 30,
            'individual_use' => true,
            'exclude_sale_items' => true,
            'minimum_amount' => 100.00
        ]
    ],
    'update' => [
        [
            'id' => 719,
            'minimum_amount' => 50.00
        ]
    ],
    'delete' => [
        720
    ]
]);
```

## Customers

```php
// List Customers
$api->customers()->get();

// Retrieve a Customer
$api->customer($customer_id)->get();

// Create a Customer
$api->customers()->create([

]);

// Update a Customer
$api->customer($customer_id)->update([

]);

// Batch
$api->customerBatch()->post([

]);

// Retrieve Customer Downloads
$api->customerDownloads($customer_id)->get();
```

## Orders

```php
// List Orders (paginated)
$api->orders()->get();

// List all Orders
$api->orders()->all(); // or cacheAll($seconds)

// Retrieve an Order
$api->order($order_id)->get();

// Create an Order
$api->orders()->create([
    'title' => 'The Title!',
    'status' => OrderStatus::on_hold
]);

// Update an Order
$api->order($id)->update([
    'status' => OrderStatus::completed
]);

// Delete an order
$api->order($id)->delete();
```

### Order Notes

```php
// List Order Notes per Order
$api->orderNotes($order_id)->get();

// Retrieve an Order Note
$api->orderNote($order_id, $note_id)->get();

// Create an Order Note
$api->orderNotes($order_id)->create([
    'note' => 'Order ok!'
]);

// Delete an Order Note
$api->orderNote($order_id, $note_id)->delete();
```

### Order Refunds

```php
// List Order Refunds per Order
$api->orderRefunds($order_id)->get();

// Retrieve an Order Refund
$api->orderRefund($order_id, $refund_id)->get();

// Create an Order Refund
$api->orderRefunds($order_id)->create([
     'amount' => 30,
     'line_items' => [
       [
           'id' => 111,
           'refund_total' => 10,
           'refund_tax' => [
              [
                 'id' => 222,
                 'amount' => 20
              ]
           ]
       ]
     ]
]);

// Delete an Order Refund
$api->orderRefund($order_id, $refund_id)->delete();
```

## Product

```php
// List Product
$api->products()->get();

// Retrieve a Product
$api->product($product_id)->get();

// Create a Product
$api->product($product_id)->create([
    'name' => 'Premium Quality',
    'type' => 'simple',
    'regular_price' => 21.99,
    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
    'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
    'categories' => [
        [
            'id' => 9
        ],
        [
            'id' => 14
        ]
    ],
    'images' => [
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
        ]
    ]
]);

// Update a Product
$api->product($product_id)->update([
    'regular_price' => 24.54
]);

// Batch
$api->productBatch()->post([
    'create' => [
        [
            'name' => 'Woo Single #1',
            'type' => ProductType::simple,
            'regular_price' => 21.99,
            'virtual' => true,
            'downloadable' => true,
            'downloads' => [
                [
                    'name' => 'Woo Single',
                    'file' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_4_angle.jpg'
                ]
            ],
            'categories' => [
                [
                    'id' => 11
                ],
                [
                    'id' => 13
                ]
            ],
            'images' => [
                [
                    'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_4_angle.jpg'
                ]
            ]
        ],
        [
            'name' => 'New Premium Quality',
            'type' => 'simple',
            'regular_price' => 21.99,
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
            'categories' => [
                [
                    'id' => 9
                ],
                [
                    'id' => 14
                ]
            ],
            'images' => [
                [
                    'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                ],
                [
                    'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
                ]
            ]
        ]
    ],
    'update' => [
        [
            'id' => 799,
            'default_attributes' => [
                [
                    'id' => 6,
                    'name' => 'Color',
                    'option' => 'Green'
                ],
                [
                    'id' => 0,
                    'name' => 'Size',
                    'option' => 'M'
                ]
            ]
        ]
    ],
    'delete' => [
        794
    ]
]);
```

### Product Attributes

```php
// List Product Attributes
$api->productAttributes()->get();

// Retrieve a Product Attributes
$api->productAttribute($attribute_id)->get();

// Create a Product Attributes
$api->productAttributes()->create([
    'name' => 'Color',
    'slug' => 'pa_color',
    'type' => AttributesType::select,
    'order_by' => OrderByAttributes::menu_order,
    'has_archives' => true
]);

// Update a Product Attributes
$api->productAttribute($attribute_id)->update([
    'order_by' => OrderByAttributes::name,
]);

// Batch
$api->productAttributeBatch()->post([
    'create' => [
        [
            'name' => 'Brand'
        ],
        [
            'name' => 'Publisher'
        ]
    ],
    'update' => [
        [
            'id' => 2,
            'order_by' => 'name'
        ]
    ],
    'delete' => [
        1
    ]
]);
```

### Product Attribute Terms

```php
// List Product Attribute Terms
$api->productAttributeTerms($attribute_id)->get();

// Retrieve a Product Attribute Terms
$api->productAttributeTerm($attfibute_id, $term_id)->get();

// Create a Product Attribute Terms
$api->productAttributeTerms($attfibute_id)->create([
    'name' => 'XXS'
]);

// Update a Product Attribute Terms
$api->productAttributeTerm($attfibute_id, $term_id)->update([
    'name' => 'XXS'
]);

// Batch
$api->productAttributeTermBatch()->post([
    'create' => [
        [
            'name' => 'XXS'
        ],
        [
            'name' => 'S'
        ]
    ],
    'update' => [
        [
            'id' => 19,
            'menu_order' => 6
        ]
    ],
    'delete' => [
        21,
        20
    ]
]);
```

### Product Categories

```php
// List Product Categories
$api->productCategories()->get();

// Retrieve a Product Categories
$api->productCategory($category_id)->get();

// Create a Categories
$api->productCategories()->create([
    'name' => 'Clothing',
    'image' => [
        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
    ]
]);

// Update a Categories
$api->productCategory($category_id)->update([
    'description' => 'All kinds of clothes.'
]);

// Batch
$api->productCategoryBatch()->post([
    'create' => [
        [
            'name' => 'Albums'
        ],
        [
            'name' => 'Clothing'
        ]
    ],
    'update' => [
        [
            'id' => 10,
            'description' => 'Nice hoodies'
        ]
    ],
    'delete' => [
        11,
        12
    ]
]);
```

### Product Reviews

```php
// List Product Reviews
$api->productReviews($product_id)->get();

// Retrieve a Product Reviews
$api->productReview($product_id, $review_id)->get();

// Create a Product Reviews
$api->productReviews($product_id)->create([
    'product_id' => 22,
    'review' => 'Nice album!',
    'reviewer' => 'John Doe',
    'reviewer_email' => 'john.doe@example.com',
    'rating' => 5
]);

// Update a Product Reviews
$api->productReview($product_id, $review_id)->update([
    'rating': 5
]);

// Batch
$api->productReviewBatch($product_id)->post([
    'create' => [
        [
            'product_id' => 22,
            'review' => 'Looks fine',
            'reviewer' => 'John Doe',
            'reviewer_email' => 'john.doe@example.com',
            'rating' => 4
        ],
        [
            'product_id' => 22,
            'review' => 'I love this album',
            'reviewer' => 'John Doe',
            'reviewer_email' => 'john.doe@example.com',
            'rating' => 5
        ]
    ],
    'update' => [
        [
            'id' => 7,
            'reviewer' => 'John Doe',
            'reviewer_email' => 'john.doe@example.com',
        ]
    ],
    'delete' => [
        22
    ]
]);
```

### Product Tags

```php
// List Product Tags
$api->productTags()->get();

// Retrieve a Product Tags
$api->productTag($tag_id)->get();

// Create a Product Tags
$api->productTags()->create([
    'name' => 'Leather Shoes'
]);

// Update a Product Tags
$api->productTag($tag_id)->update([
    'description': 'Genuine leather.'
]);

// Batch
$api->productTagBatch()->post([
    'create' => [
        [
            'name' => 'Round toe'
        ],
        [
            'name' => 'Flat'
        ]
    ],
    'update' => [
        [
            'id' => 34,
            'description' => 'Genuine leather.'
        ]
    ],
    'delete' => [
        35
    ]
]);
```

### Product Variations

```php
// List Product Variations
$api->productVariations($product_id)->get();

// Retrieve a Product Variations
$api->productVariation($product_id, $variation_id)->get();

// Create a Product Variations
$api->productVariation($product_id)->create([
    'regular_price' => 9.00,
    'image' => [
        'id' => 423
    ],
    'attributes' => [
        [
            'id' => 9,
            'option' => 'Black'
        ]
    ]
]);

// Update a Product Variations
$api->productVariation($product_id, $variation_id)->update([
    'regular_price' => 10.00
]);

// Batch
$api->productVariationsBatch($product_id)->post([
    'create' => [
        [
            'regular_price' => 10.00,
            'attributes' => [
                [
                    'id' => 6,
                    'option' => 'Blue'
                ]
            ]
        ],
        [
            'regular_price' => 10.00,
            'attributes' => [
                [
                    'id' => 6,
                    'option' => 'White'
                ]
            ]
        ]
    ],
    'update' => [
        [
            'id' => 733,
            'regular_price' => 10.00
        ]
    ],
    'delete' => [
        732
    ]
]);
```

## Shipping

### Shipping Methods

```php
// List Shipping Methods
$api->shippingMethods()->get();

// Retrieve a Shipping Methods
$api->shippingMethod($method_id)->get();

// Create a Shipping Methods
$api->shippingMethods()->create([

]);

// Update a Shipping Methods
$api->shippingMethod($method_id)->update([

]);
```

### Shipping Zones

```php
// List Shipping Zones
$api->shippingZones()->get();

// Retrieve a Shipping Zones
$api->shippingZone($zone_id)->get();

// Create a Shipping Zones
$api->shippingZones()->create([

]);

// Update a Shipping Zones
$api->shippingZone($zone_id)->update([

]);
```

### Shipping Zones Locations

```php
// TODO
```

### Shipping Zones Method

```php
// List Shipping Zones Method
$api->shippingZoneMethods($zone_id)->get();

// Retrieve a Shipping Zones Method
$api->shippingZoneMethod($zone_id, $instance_id)->get();

// Create a Shipping Zones Method
$api->shippingZoneMethods($zone_id)->create([

]);

// Update a Shipping Zones Method
$api->shippingZoneMethod($zone_id, $instance_id)->update([

]);
```

## Reports

```php
// List Reports
$api->reports()->get();
```

### Report Sales

```php
// List Report Sales
$api->xyz()->get();

// Retrieve a Report Sales
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

### Report Top Seller

```php
// List Report Top Seller
$api->xyz()->get();

// Retrieve a Report Top Seller
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

## Settings

```php
// List ettings
$api->xyz()->get();

// Retrieve a ettings
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

## Taxes

```php
// List axes
$api->xyz()->get();

// Retrieve a axes
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

### Tax Classes

```php
// List Tax Classes
$api->xyz()->get();

// Retrieve a Tax Classes
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

## Webhooks

```php
// List ebhooks
$api->xyz()->get();

// Retrieve a ebhooks
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

## Payment Gateways

```php
// List ayment Gateways
$api->xyz()->get();

// Retrieve a ayment Gateways
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

## System

```php
// List ystem
$api->xyz()->get();

// Retrieve a ystem
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

### System Status

```php
// List System Status
$api->xyz()->get();

// Retrieve a System Status
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```

### System Status Tools

```php
// List System Status Tools
$api->xyz()->get();

// Retrieve a System Status Tools
$api->xyz()->get();

// Create a xyz
$api->xyz()->create([

]);

// Update a xyz
$api->xyz()->update([

]);

// Batch
$api->xyz()->post([

]);
```
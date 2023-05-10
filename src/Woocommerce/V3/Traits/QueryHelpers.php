<?php

namespace C14r\Woocommerce\V3\Traits;

use C14r\Woocommerce\V3\Enums\CatalogVisibility;
use C14r\Woocommerce\V3\Enums\CategoryDisplay;
use C14r\Woocommerce\V3\Enums\Context;
use C14r\Woocommerce\V3\Enums\CouponsDiscountType;
use C14r\Woocommerce\V3\Enums\Currency;
use C14r\Woocommerce\V3\Enums\CustomerRole;
use C14r\Woocommerce\V3\Enums\Order;
use C14r\Woocommerce\V3\Enums\OrderStatus;
use C14r\Woocommerce\V3\Enums\Period;
use C14r\Woocommerce\V3\Enums\ProductBackorders;
use C14r\Woocommerce\V3\Enums\ProductType;
use C14r\Woocommerce\V3\Enums\TaxClass;
use C14r\Woocommerce\V3\Enums\TaxStatus;
use Carbon\Carbon;
use UnitEnum;

trait QueryHelpers
{
    public function action(string $value): self
    {
        return $this->query('action', $value);
    }
    
    public function after(string $value): self
    {
        return $this->query('after', $value);
    }
    
    public function amount(string $value): self
    {
        return $this->query('amount', $value);
    }
    
    public function api_refund(bool $value = true): self
    {
        return $this->query('api_refund', $value);
    }
    
    /*public function attribute(string $value): self
    {
        return $this->query('attribute', $value);
    }*/
    
    public function attribute_id(int $value): self
    {
        return $this->query('attribute_id', $value);
    }
    
    public function attribute_term(string $value): self
    {
        return $this->query('attribute_term', $value);
    }
    
    /*public function attributes(array $value): self
    {
        return $this->query('attributes', $value);
    }*/
    
    public function backorders(ProductBackorders $enum): self
    {
        return $this->query('backorders', $enum->value);
    }
    
    public function before(string $value): self
    {
        return $this->query('before', $value);
    }
    
    public function billing(object $value): self
    {
        return $this->query('billing', $value);
    }
    
    public function button_text(string $value): self
    {
        return $this->query('button_text', $value);
    }
    
    public function catalog_visibility(CatalogVisibility $enum = CatalogVisibility::visible): self
    {
        return $this->query('catalog_visibility', $enum->value);
    }
    
    public function categories(array $value): self
    {
        return $this->query('categories', $value);
    }
    
    public function category(string $value): self
    {
        return $this->query('category', $value);
    }
    
    public function city(string $value): self
    {
        return $this->query('city', $value);
    }
    
    public function class(TaxClass $enum = TaxClass::standard): self
    {
        return $this->query('class', $enum->value);
    }
    
    public function code(string $value): self
    {
        return $this->query('code', $value);
    }
    
    public function compound(bool $value): self
    {
        return $this->query('compound', $value);
    }
    
    public function context(Context $enum = Context::view): self
    {
        return $this->query('context', $enum->value);
    }
    
    public function country(string $value): self
    {
        return $this->query('country', $value);
    }
    
    public function coupon_lines(array $value): self
    {
        return $this->query('coupon_lines', $value);
    }
    
    public function cross_sell_ids(array $value): self
    {
        return $this->query('cross_sell_ids', $value);
    }
    
    public function currency(Currency $enum = Currency::USD): self
    {
        return $this->query('currency', $enum->value);
    }
    
    /**
     * @see Traits\Customers
     */
    /*
    public function customer(int $value): self
    {
        return $this->query('customer', $value);
    }
    */
    
    public function customer_id(int $value): self
    {
        return $this->query('customer_id', $value);
    }
    
    public function customer_note(bool|string $value): self
    {
        return $this->query('customer_note', $value);
    }
    
    public function date_created(Carbon $value): self
    {
        return $this->query('date_created', $value);
    }
    
    public function date_created_gmt(Carbon $value): self
    {
        return $this->query('date_created_gmt', $value);
    }
    
    public function date_expires(string $value): self
    {
        return $this->query('date_expires', $value);
    }
    
    public function date_expires_gmt(string $value): self
    {
        return $this->query('date_expires_gmt', $value);
    }
    
    public function date_max(string $value): self
    {
        return $this->query('date_max', $value);
    }
    
    public function date_min(string $value): self
    {
        return $this->query('date_min', $value);
    }
    
    public function date_on_sale_from(Carbon $value): self
    {
        return $this->query('date_on_sale_from', $value);
    }
    
    public function date_on_sale_from_gmt(Carbon $value): self
    {
        return $this->query('date_on_sale_from_gmt', $value);
    }
    
    public function date_on_sale_to(Carbon $value): self
    {
        return $this->query('date_on_sale_to', $value);
    }
    
    public function date_on_sale_to_gmt(Carbon $value): self
    {
        return $this->query('date_on_sale_to_gmt', $value);
    }
    
    public function default_attributes(array $value): self
    {
        return $this->query('default_attributes', $value);
    }
    
    public function delivery_url(string $value): self
    {
        return $this->query('delivery_url', $value);
    }
    
    public function description(string $value): self
    {
        return $this->query('description', $value);
    }
    
    public function dimensions(object $value): self
    {
        return $this->query('dimensions', $value);
    }
    
    public function discount_type(CouponsDiscountType $enum = CouponsDiscountType::fixed_cart): self
    {
        return $this->query('discount_type', $enum->value);
    }
    
    public function display(CategoryDisplay $enum = CategoryDisplay::default): self
    {
        return $this->query('display', $enum->value);
    }
    
    public function download_expiry(int $value = -1): self
    {
        return $this->query('download_expiry', $value);
    }
    
    public function download_limit(int $value = -1): self
    {
        return $this->query('download_limit', $value);
    }
    
    public function downloadable(bool $value): self
    {
        return $this->query('downloadable', $value);
    }
    
    public function downloads(array $value): self
    {
        return $this->query('downloads', $value);
    }
    
    public function dp(int $value = 2): self
    {
        return $this->query('dp', $value);
    }
    
    public function email(string $value): self
    {
        return $this->query('email', $value);
    }
    
    public function email_restrictions(array $value): self
    {
        return $this->query('email_restrictions', $value);
    }
    
    public function enabled(bool $value): self
    {
        return $this->query('enabled', $value);
    }
    
    public function exclude(array $value = []): self
    {
        return $this->query('exclude', $value);
    }
    
    public function exclude_sale_items(bool $value): self
    {
        return $this->query('exclude_sale_items', $value);
    }
    
    public function excluded_product_categories(array $value): self
    {
        return $this->query('excluded_product_categories', $value);
    }
    
    public function excluded_product_ids(array $value): self
    {
        return $this->query('excluded_product_ids', $value);
    }
    
    public function external_url(string $value): self
    {
        return $this->query('external_url', $value);
    }
    
    public function featured(bool $value): self
    {
        return $this->query('featured', $value);
    }
    
    public function fee_lines(array $value): self
    {
        return $this->query('fee_lines', $value);
    }
    
    public function first_name(string $value): self
    {
        return $this->query('first_name', $value);
    }
    
    public function force(bool $value = true): self
    {
        return $this->query('force', $value);
    }
    
    public function free_shipping(bool $value): self
    {
        return $this->query('free_shipping', $value);
    }
    
    public function group(string $value): self
    {
        return $this->query('group', $value);
    }
    
    public function has_archives(bool $value): self
    {
        return $this->query('has_archives', $value);
    }
    
    public function hide_empty(bool $value): self
    {
        return $this->query('hide_empty', $value);
    }
    
    public function id(int|string $value): self
    {
        return $this->query('id', $value);
    }
    
    public function image(object $value): self
    {
        return $this->query('image', $value);
    }
    
    public function images(object $value): self
    {
        return $this->query('images', $value);
    }
    
    public function in_stock(bool $value = true): self
    {
        return $this->query('in_stock', $value);
    }
    
    public function include(array $value = []): self
    {
        return $this->query('include', $value);
    }
    
    public function individual_use(bool $value): self
    {
        return $this->query('individual_use', $value);
    }
    
    public function instance_id(int $value): self
    {
        return $this->query('instance_id', $value);
    }
    
    public function last_name(string $value): self
    {
        return $this->query('last_name', $value);
    }
    
    public function limit_usage_to_x_items(int $value): self
    {
        return $this->query('limit_usage_to_x_items', $value);
    }
    
    public function line_items(array $value): self
    {
        return $this->query('line_items', $value);
    }
    
    public function manage_stock(bool $value): self
    {
        return $this->query('manage_stock', $value);
    }
    
    public function max_price(string $value): self
    {
        return $this->query('max_price', $value);
    }
    
    public function maximum_amount(string $value): self
    {
        return $this->query('maximum_amount', $value);
    }
    
    public function menu_order(int $value): self
    {
        return $this->query('menu_order', $value);
    }
    
    public function message(string $value): self
    {
        return $this->query('message', $value);
    }
    
    public function meta_data(array $value): self
    {
        return $this->query('meta_data', $value);
    }
    
    public function method_id(string $value): self
    {
        return $this->query('method_id', $value);
    }
    
    public function min_price(string $value): self
    {
        return $this->query('min_price', $value);
    }
    
    public function minimum_amount(string $value): self
    {
        return $this->query('minimum_amount', $value);
    }
    
    public function name(string $value): self
    {
        return $this->query('name', $value);
    }
    
    public function note(string $value): self
    {
        return $this->query('note', $value);
    }
    
    public function offset(int $value): self
    {
        return $this->query('offset', $value);
    }
    
    public function on_sale(bool $value): self
    {
        return $this->query('on_sale', $value);
    }
    
    /*public function order(Order $enum = Order::asc): self
    {
        return $this->query('order', $enum->value);
    }*/
    
    public function order_by(string|UnitEnum $value): self
    {
        if($value instanceof \UnitEnum)
        {
            return $this->query('order_by', $value->value);
        }

        return $this->query('order_by', $value);
    }
    
    public function order_id(int $value): self
    {
        return $this->query('order_id', $value);
    }
    
    public function orderby(string|UnitEnum $value): self
    {
        return $this->order_by($value);
    }
    
    public function page(int $value = 1): self
    {
        return $this->query('page', $value);
    }
    
    public function parent(array $value = []): self
    {
        return $this->query('parent', $value);
    }
    
    public function parent_exclude(array $value = []): self
    {
        return $this->query('parent_exclude', $value);
    }
    
    public function parent_id(int $value): self
    {
        return $this->query('parent_id', $value);
    }
    
    public function password(string $value): self
    {
        return $this->query('password', $value);
    }
    
    public function payment_method(string $value): self
    {
        return $this->query('payment_method', $value);
    }
    
    public function payment_method_title(string $value): self
    {
        return $this->query('payment_method_title', $value);
    }
    
    public function per_page(int $value = 10): self
    {
        return $this->query('per_page', $value);
    }
    
    public function period(Period $enum): self
    {
        return $this->query('period', $enum->value);
    }
    
    public function postcode(string $value): self
    {
        return $this->query('postcode', $value);
    }
    
    public function priority(int $value = 1): self
    {
        return $this->query('priority', $value);
    }
    
    /*public function product(int $value): self
    {
        return $this->query('product', $value);
    }*/
    
    public function product_categories(array $value): self
    {
        return $this->query('product_categories', $value);
    }
    
    public function product_id(int $value): self
    {
        return $this->query('product_id', $value);
    }
    
    public function product_ids(array $value): self
    {
        return $this->query('product_ids', $value);
    }
    
    public function purchase_note(string $value): self
    {
        return $this->query('purchase_note', $value);
    }
    
    public function rate(string $value): self
    {
        return $this->query('rate', $value);
    }
    
    public function rating(int $value): self
    {
        return $this->query('rating', $value);
    }
    
    public function reason(string $value): self
    {
        return $this->query('reason', $value);
    }
    
    public function reassign(int $value = 0): self
    {
        return $this->query('reassign', $value);
    }
    
    public function refunded_by(int $value): self
    {
        return $this->query('refunded_by', $value);
    }
    
    public function regular_price(string $value): self
    {
        return $this->query('regular_price', $value);
    }
    
    public function review(string $value): self
    {
        return $this->query('review', $value);
    }
    
    public function reviews_allowed(bool $value = true): self
    {
        return $this->query('reviews_allowed', $value);
    }
    
    public function role(CustomerRole $enum = CustomerRole::customer): self
    {
        return $this->query('role', $enum->value);
    }
    
    public function sale_price(string $value): self
    {
        return $this->query('sale_price', $value);
    }
    
    public function search(string $value): self
    {
        return $this->query('search', $value);
    }
    
    public function secret(string $value): self
    {
        return $this->query('secret', $value);
    }
    
    public function set_paid(bool $value): self
    {
        return $this->query('set_paid', $value);
    }
    
    /*public function settings(object $value): self
    {
        return $this->query('settings', $value);
    }*/
    
    public function shipping(bool $value = true): self
    {
        return $this->query('shipping', $value);
    }
    
    public function shipping_class(string $value): self
    {
        return $this->query('shipping_class', $value);
    }
    
    public function shipping_lines(array $value): self
    {
        return $this->query('shipping_lines', $value);
    }
    
    public function short_description(string $value): self
    {
        return $this->query('short_description', $value);
    }
    
    public function sku(string $value): self
    {
        return $this->query('sku', $value);
    }
    
    public function slug(string $value): self
    {
        return $this->query('slug', $value);
    }
    
    public function sold_individually(bool $value): self
    {
        return $this->query('sold_individually', $value);
    }
    
    public function state(string $value): self
    {
        return $this->query('state', $value);
    }
    
    public function status(OrderStatus $enum): self
    {
        return $this->query('status', $enum->value);
    }
    
    public function stock_quantity(int $value): self
    {
        return $this->query('stock_quantity', $value);
    }
    
    public function success(bool $value): self
    {
        return $this->query('success', $value);
    }
    
    public function tag(string $value): self
    {
        return $this->query('tag', $value);
    }
    
    public function tags(array $value): self
    {
        return $this->query('tags', $value);
    }
    
    public function tax_class(TaxClass $enum): self
    {
        return $this->query('tax_class', $enum->value);
    }
    
    public function tax_status(TaxStatus $enum = TaxStatus::taxable): self
    {
        return $this->query('tax_status', $enum->value);
    }
    
    public function title(string $value): self
    {
        return $this->query('title', $value);
    }
    
    public function topic(string $value): self
    {
        return $this->query('topic', $value);
    }
    
    public function transaction_id(string $value): self
    {
        return $this->query('transaction_id', $value);
    }
    
    public function type(ProductType $enum): self
    {
        return $this->query('type', $enum->value);
    }
    
    public function upsell_ids(array $value): self
    {
        return $this->query('upsell_ids', $value);
    }
    
    public function usage_limit(int $value): self
    {
        return $this->query('usage_limit', $value);
    }
    
    public function usage_limit_per_user(int $value): self
    {
        return $this->query('usage_limit_per_user', $value);
    }
    
    public function username(string $value): self
    {
        return $this->query('username', $value);
    }
    
    public function value(mixed $value): self
    {
        return $this->query('value', $value);
    }
    
    public function virtual(bool $value): self
    {
        return $this->query('virtual', $value);
    }
    
    public function visible(bool $value): self
    {
        return $this->query('visible', $value);
    }
    
    public function webhook_id(int $value): self
    {
        return $this->query('webhook_id', $value);
    }
    
    public function weight(string $value): self
    {
        return $this->query('weight', $value);
    }
    
    public function zone_id(int $value): self
    {
        return $this->query('zone_id', $value);
    }
}
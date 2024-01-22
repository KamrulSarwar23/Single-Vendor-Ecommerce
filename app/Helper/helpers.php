<?php


// Set Sidebar item Active

use App\Models\WishList;
use Illuminate\Support\Facades\Session;

function setActive(array $route)
{

    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return "active";
            }
        }
    }
}


// Check if product have discount
function checkProductDiscount($product)
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

// Calculaete discount percent

function calculateDiscountPercent($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice - $discountPrice;

    $discountPercent = round(($discountAmount / $originalPrice) * 100);

    return $discountPercent;
}

// Check the product type

function ProductType($type): string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;

        case 'featured_product':
            return 'Featured';
            break;

        case 'top_product':
            return 'Top';
            break;

        case 'best_product':
            return 'Best';
            break;

        default:
            return '';
            break;
    }
}

// get total cart count

function getTotalCartCount()
{
    $total = 0;
    foreach (Cart::content() as $product) {
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }

    return $total;
}

// get payable total amount

function getMainCartCount()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subtotal = getTotalCartCount();
        if ($coupon['discount_type'] == 'amount') {
            $total = $subtotal - $coupon['discount'];
            return  $total;
        } elseif ($coupon['discount_type'] == 'percent') {
            $discount = ($subtotal * $coupon['discount'] / 100);
            $total = $subtotal - $discount;
            return $total;
        }
    } else {
        return getTotalCartCount();
    }
}


// get cart discount
function getCartDiscount()
{
    if (Session::has('coupon')) {
        $coupon = Session::get('coupon');
        $subtotal = getTotalCartCount();
        if ($coupon['discount_type'] == 'amount') {
            return  $coupon['discount'];
        } elseif ($coupon['discount_type'] == 'percent') {
            $discount = ($subtotal * $coupon['discount'] / 100);
            return  $discount;
        }
    } else {
        return 0;
    }
}

// get selected shipping fee

function getShippingFee()
{
    if (Session::has('shipping_method')) {
        return Session::get('shipping_method')['cost'];
    } else {
        return 0;
    }
}

// payable amount for shipping

function getFinalPayableAmount()
{
    return getMainCartCount() + getShippingFee();
}

function limitText($text, $limit = 20)
{
    return \Str::limit($text, $limit);
}




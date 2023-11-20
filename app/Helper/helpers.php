<?php


// Set Sidebar item Active
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

function ProductType(string $type): string
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



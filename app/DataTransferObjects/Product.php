<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;

class Product
{
    public int $id;
    public string $productType;
    public float $productValue;
    public Carbon $createdAt;

    public function __construct($id, $product_type, $product_value, $created_at)
    {
        $this->id = $id;
        $this->productType = $product_type;
        $this->productValue = $product_value;
        $this->createdAt = Carbon::parse($created_at);
    }
}

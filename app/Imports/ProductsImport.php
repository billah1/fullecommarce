<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

//        dd(explode(',', $row['category_id']));
        $product = Product::create([
            'currency_id' => $row['currency_id'],
            'created_by' => $row['created_by'],
            'code' => generateProductCode(),
            'name' => $row['name'],
            'description' => $row['description'],
            'tags' => $row['tags'],
            'price' => $row['price'],
            'stock' => $row['stock'],
            'is_active' => 1,
            'has_coupon' => 0,
        ]);
        foreach (explode(',', $row['category_id']) as $category) {
            $product->productCategory()->create([
                'product_id' => $product->id,
                'category_id' => $category,
            ]);
        }


        return $product;
    }
}

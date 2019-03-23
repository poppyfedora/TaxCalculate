<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tax extends Model
{

    const TAX_ID_FOOD = 1,
        TAX_ID_TOBACCO = 2,
        TAX_ID_ENTERTAINMENT = 3;

    const TAX_CODES = [
      self::TAX_ID_FOOD => [
          'NAME' => 'Food & Beverage',
          'REFUNDABLE' => 1
      ],
        self::TAX_ID_TOBACCO => [
            'NAME' => 'Tobacco',
            'REFUNDABLE' => 0
        ],
        self::TAX_ID_ENTERTAINMENT => [
            'NAME' => 'Entertainment',
            'REFUNDABLE' => 0
        ]
    ];

    protected $table = 'tax';

    public static function defaultQuery($hideDelete = true) {
        $query = DB::table('tax');
        if ($hideDelete) {
            $query->whereNull('tax.deleted_at');
        }
    }
    
    public static function calculateBill($items) {
        $priceSubtotal = 0;
        $taxSubtotal = 0;

        $bills = [];
        $temp_items = [];
        foreach ($items as $item) {
            $tax = self::calculateTax($item['tax_code'], $item['price']);
            $taxSubtotal += $tax;
            $priceSubtotal += $item['price'];

            array_push($temp_items, [
                'name' => $item['name'],
                'tax_code' => $item['tax_code'],
                'type' => self::TAX_CODES[$item['tax_code']]['NAME'],
                'refundable' => self::TAX_CODES[$item['tax_code']]['REFUNDABLE'],
                'price' => $item['price'],
                'tax' => $tax,
                'amount' => $tax + $item['price']
            ]);
        }

        $bills['items'] = $temp_items;
        $bills['price_subtotal'] = $priceSubtotal;
        $bills['tax_subtotal'] = $taxSubtotal;
        $bills['grand_total'] = $priceSubtotal + $taxSubtotal;
        return $bills;
    }

    public static function calculateTax($tax_id, $price) {
        $tax = 0;
        switch ($tax_id) {
            case self::TAX_ID_FOOD :
                $tax = (0.1) * $price;
                break;

            case self::TAX_ID_TOBACCO :
                $tax = 10 + (0.02 * $price);
                break;

            case self::TAX_ID_ENTERTAINMENT :
                $tax = ($price >= 100) ? ((0.01) * ($price - 100)) : 0;
                break;

            default:
                break;
        }
        return $tax;
    }
}

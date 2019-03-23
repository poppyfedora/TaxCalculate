<?php
/**
 * Created by PhpStorm.
 * User: poppy
 * Date: 23/03/19
 * Time: 13:43
 */

namespace App\Http\Controllers;


use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaxController
{
    /**
     * @api           {post} /api/calculate Calculate Bills
     * @apiVersion    1.0.0
     * @apiName       Calculate
     * @apiGroup      Tax
     * @apiPermission using header
     *
     * @apiDescription Calculate bills and the detail tax for each item
     *
     * @apiParam {Object[]} items Items that will be calculated
     * @apiParam {string} items.name Name of item
     * @apiParam {Number} items.tax_code Tax code of the item
     * @apiParam {Number} items.price Price of the item
     *
     * @apiParamExample {json} Request Example:
     *     {
     *          "items" : [
     *              {
     *                  "name" : "Lucky Stretch",
     *                  "tax_code" : 2,
     *                  "price" : 1000
     *              },
     *             {
     *                  "name" : "Big Mac",
     *                  "tax_code" : 1,
     *                  "price" : 1000
     *             },
     *             {
     *                  "name" : "Movie",
     *                  "tax_code" : 3,
     *                  "price" : 150
     *             }
     *          ]
     *    }
     *
     * @apiSuccess {Object}  bills  Details of bills
     * @apiSuccess {Object[]}  bills.items  Details of items that has been calculated
     * @apiSuccess {Number}  bills.price_subtotal  Subtotal of price bills
     * @apiSuccess {Number}  bills.tax_subtotal  Subtotal of tax bills
     * @apiSuccess {Number}  bills.grand_total  Grand total of subtotal price and tax from the bills
     *
     * @apiSuccessExample {json} Success Response:
     *     {
     *      "error": [],
     *      "data": {
     *          "bills": {
     *             items": [
     *              {
     *                  "name": "Lucky Stretch",
     *                  "tax_code": 2,
     *                  "type": "Tobacco",
     *                  "refundable": 0,
     *                  "price": 1000,
     *                  "tax": 30,
     *                  "amount": 1030
     *              },
     *              {
     *                  "name": "Big Mac",
     *                  "tax_code": 1,
     *                  "type": "Food & Beverage",
     *                  "refundable": 1,
     *                  "price": 1000,
     *                  "tax": 100,
     *                  "amount": 1100
     *              },
     *              {
     *                  "name": "Movie",
     *                  "tax_code": 3,
     *                  "type": "Entertainment",
     *                  "refundable": 0,
     *                  "price": 150,
     *                  "tax": 0.5,
     *                  "amount": 150.5
     *              }
     *            ],
     *          "price_subtotal": 2150,
     *          "tax_subtotal": 130.5,
     *          "grand_total": 2280.5
     *          }
     *       }
     *    }
     *
     * @apiError RequestNotValid       Request format not valid
     *
     * @apiErrorExample {json} RequestNotValid:
     *     {
     *      "error": [
     *          {
     *              "code": 404,
     *              "message": "The items.0.price must be an integer."
     *          }
     *     ],
     *     "data": []
     *     }
     *
     */
    /**
     * @param Request $request
     * @return array
     */
    public static function calculate(Request $request) {
        $rules = [
            'items' => 'required | array | min:1',
            'items.*.name' => 'required | string',
            'items.*.tax_code' => 'required | int | in:1,2,3',
            'items.*.price' => 'required | int | min:0'
        ];

        $errors = [];
        $data = [];

        $validator = self::validateRequest($request, $rules);
        if (count($validator) > 0) {
            $errors = $validator;
        } else {
            $items = $request->items;
            $bills = Tax::calculateBill($items);
            $data['bills'] = $bills;
        }

        return [
            'error' => $errors,
            'data' => $data
        ];
    }

    private static function validateRequest($request, $rules) {
        if (! is_array($request)) {
            $validator = Validator::make($request->all(), $rules);
        } else {
            $validator = Validator::make($request, $rules);
        }

        $errors = array();
        if ($validator->fails()) {
            $message = $validator->messages();
            $i = 0;
            foreach ($rules as $key => $value) {
                if ($message->has($key)) {
                    if (strpos($key, '*')) {
                        $a = array_keys($message->messages());
                        $mssg = $message->get($a[$i])[0];
                        $i++;
                    } else {
                        $mssg = $message->get($key)[0];
                    }
                    array_push($errors,[
                        'code' => 404,
                        'message' => $mssg
                    ]);
                }
            }
        }
        return $errors;
    }
};
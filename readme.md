<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Tax Calculator

This is project of Tax Calculator Challenge, contains:
1. API (token and calculate)
2. Docs of API ==> 127.0.0.1/TaxCalculate/apidoc/
3. Docker file (still not working)

The project is built by PHP using Laravel framework and using mySQL as database.

Steps:
1. First of all, since the composer is not workin', you have to install PHP (so you have to install Apache)
2. And then you must install composer
3. Install laravel via composer : `composer global require "laravel/installer=~1.1"`
4. Install mysql
5. Create database: `tax_calculator`
6. And set up your connection db in file `.env`

To start project:

1. `php artisan migrate` (to create table that needed)
2. `php artisan db:seed --class=ItemsTableSeeder` (to add data items)
3. `php artisan serve` (running on 127.0.0.1:8000)


-----------
API:

1. Get Token:
- Endpoint: [GET] localhost:8000/api/api-token/generate
- Request: -
- Response: 4c6a6ca7c772da604f33b80218acd5a9


2. Calculate
- Endpoint: [POST] localhost:8000/api/tax/calculate
- Request: (JSON)
```
{
	"items" : [
		{
			"name" : "Lucky Stretch",
			"tax_code" : 2,
			"price" : 1000
		},
		{
			"name" : "Big Mac",
			"tax_code" : 1,
			"price" : 1000
		},
		{
			"name" : "Movie",
			"tax_code" : 3,
			"price" : 150
		}
	]
}
```
- Header:
 - Content-Type : application/json
 - API-TOKEN : (get from api/api-token/generate)
- Response:
```
{
  "error": [],
  "data": {
    "bills": {
      "items": [
        {
          "name": "Lucky Stretch",
          "tax_code": 2,
          "type": "Tobacco",
          "refundable": 0,
          "price": 1000,
          "tax": 30,
          "amount": 1030
        },
        {
          "name": "Big Mac",
          "tax_code": 1,
          "type": "Food & Beverage",
          "refundable": 1,
          "price": 1000,
          "tax": 100,
          "amount": 1100
        },
        {
          "name": "Movie",
          "tax_code": 3,
          "type": "Entertainment",
          "refundable": 0,
          "price": 150,
          "tax": 0.5,
          "amount": 150.5
        }
      ],
      "price_subtotal": 2150,
      "tax_subtotal": 130.5,
      "grand_total": 2280.5
    }
  }
}
```
-----------
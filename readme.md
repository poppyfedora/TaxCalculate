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

1. php artisan migrate (to create table that needed)
2. php artisan db:seed --class=ItemsTableSeeder (to add data items)
3. php artisan serve (running on 127.0.0.1:8000)


-----------
API:

1. Get Token:
- Endpoint: [GET] localhost:8000/api/api-token/generate
- Request: -
- Response: 4c6a6ca7c772da604f33b80218acd5a9


2. Calculate
- Endpoint: [POST] localhost:8000/api/tax/calculate
- Request: (JSON)

&nbsp;{
&nbsp;&nbsp;"items" : [
&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;"name" : "Lucky Stretch",
&nbsp;&nbsp;&nbsp;&nbsp;"tax_code" : 2,
&nbsp;&nbsp;&nbsp;&nbsp;"price" : 1000
&nbsp;&nbsp;&nbsp;},
&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;"name" : "Big Mac",
&nbsp;&nbsp;&nbsp;&nbsp;"tax_code" : 1,
&nbsp;&nbsp;&nbsp;&nbsp;"price" : 1000
&nbsp;&nbsp;&nbsp;},
&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;"name" : "Movie",
&nbsp;&nbsp;&nbsp;&nbsp;"tax_code" : 3,
&nbsp;&nbsp;&nbsp;&nbsp;"price" : 150
&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;]
&nbsp;}

- Header:
&nbsp;&nbsp;Content-Type : application/json
&nbsp;&nbsp;API-TOKEN : (get from api/api-token/generate)
- Response:
&nbsp;{
&nbsp;&nbsp;"error": [],
&nbsp;&nbsp;"data": {
&nbsp;&nbsp;&nbsp;"bills": {
&nbsp;&nbsp;&nbsp;&nbsp;"items": [
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Lucky Stretch",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"tax_code": 2,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "Tobacco",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"refundable": 0,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"price": 1000,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"tax": 30,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"amount": 1030
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Big Mac",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"tax_code": 1,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "Food & Beverage",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"refundable": 1,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"price": 1000,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"tax": 100,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"amount": 1100
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "Movie",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"tax_code": 3,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"type": "Entertainment",
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"refundable": 0,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"price": 150,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"tax": 0.5,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"amount": 150.5
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;],
&nbsp;&nbsp;&nbsp;&nbsp;"price_subtotal": 2150,
&nbsp;&nbsp;&nbsp;&nbsp;"tax_subtotal": 130.5,
&nbsp;&nbsp;&nbsp;&nbsp;"grand_total": 2280.5
&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;}
&nbsp;}
-----------
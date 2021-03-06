define({ "api": [
  {
    "type": "post",
    "url": "/api/calculate",
    "title": "Calculate Bills",
    "version": "1.0.0",
    "name": "Calculate",
    "group": "Tax",
    "permission": [
      {
        "name": "using header"
      }
    ],
    "description": "<p>Calculate bills and the detail tax for each item</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Object[]",
            "optional": false,
            "field": "items",
            "description": "<p>Items that will be calculated</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "items.name",
            "description": "<p>Name of item</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "items.tax_code",
            "description": "<p>Tax code of the item</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "items.price",
            "description": "<p>Price of the item</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request Example:",
          "content": " {\n      \"items\" : [\n          {\n              \"name\" : \"Lucky Stretch\",\n              \"tax_code\" : 2,\n              \"price\" : 1000\n          },\n         {\n              \"name\" : \"Big Mac\",\n              \"tax_code\" : 1,\n              \"price\" : 1000\n         },\n         {\n              \"name\" : \"Movie\",\n              \"tax_code\" : 3,\n              \"price\" : 150\n         }\n      ]\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "bills",
            "description": "<p>Details of bills</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "bills.items",
            "description": "<p>Details of items that has been calculated</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "bills.price_subtotal",
            "description": "<p>Subtotal of price bills</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "bills.tax_subtotal",
            "description": "<p>Subtotal of tax bills</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "bills.grand_total",
            "description": "<p>Grand total of subtotal price and tax from the bills</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success Response:",
          "content": " {\n  \"error\": [],\n  \"data\": {\n      \"bills\": {\n         items\": [\n          {\n              \"name\": \"Lucky Stretch\",\n              \"tax_code\": 2,\n              \"type\": \"Tobacco\",\n              \"refundable\": 0,\n              \"price\": 1000,\n              \"tax\": 30,\n              \"amount\": 1030\n          },\n          {\n              \"name\": \"Big Mac\",\n              \"tax_code\": 1,\n              \"type\": \"Food & Beverage\",\n              \"refundable\": 1,\n              \"price\": 1000,\n              \"tax\": 100,\n              \"amount\": 1100\n          },\n          {\n              \"name\": \"Movie\",\n              \"tax_code\": 3,\n              \"type\": \"Entertainment\",\n              \"refundable\": 0,\n              \"price\": 150,\n              \"tax\": 0.5,\n              \"amount\": 150.5\n          }\n        ],\n      \"price_subtotal\": 2150,\n      \"tax_subtotal\": 130.5,\n      \"grand_total\": 2280.5\n      }\n   }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "RequestNotValid",
            "description": "<p>Request format not valid</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "RequestNotValid:",
          "content": "{\n \"error\": [\n     {\n         \"code\": 404,\n         \"message\": \"The items.0.price must be an integer.\"\n     }\n],\n\"data\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/TaxController.php",
    "groupTitle": "Tax"
  }
] });

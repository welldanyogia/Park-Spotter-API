# Park-Spotter-API

{ "openapi": "3.0.0", "info": { "title": "ParkSpotter API",
"description": "API documentation for ParkSpotter application",
"version": "1.0.0" }, "paths": { "/login": { "post": { "summary": "User
login", "tags": \["Authentication"\], "requestBody": { "required": true,
"content": { "application/json": { "schema": {
"$ref": "#/components/schemas/LoginRequest" }  }  }  },  "responses": {  "200": {  "description": "Successful login",  "content": {  "application/json": {  "schema": {  "type": "object",  "properties": {  "token": { "type": "string" },  "user": { "$ref":
"#/components/schemas/UserResource" } } } } } }, "401": { "description":
"Invalid credentials", "content": { "application/json": { "schema": {
"type": "object", "properties": { "error": { "type": "string" } } } } }
} } } }, "/register": { "post": { "summary": "User registration",
"tags": \["Authentication"\], "requestBody": { "required": true,
"content": { "application/json": { "schema": {
"$ref": "#/components/schemas/RegisterRequest" }  }  }  },  "responses": {  "200": {  "description": "Successful registration",  "content": {  "application/json": {  "schema": {  "type": "object",  "properties": {  "message": { "type": "string" },  "user": { "$ref":
"#/components/schemas/UserResource" } } } } } }, "422": { "description":
"User already registered", "content": { "application/json": { "schema":
{ "type": "object", "properties": { "error": { "type": "string" } } } }
} } } } }, "/search-parking": { "get": { "summary": "Search parking
lots", "tags": \["Parking Lots"\], "parameters": \[ {
"$ref": "#/components/parameters/SearchParkingParams" }  ],  "responses": {  "200": {  "description": "Successful search",  "content": {  "application/json": {  "schema": {  "type": "object",  "properties": {  "data": { "$ref":
"#/components/schemas/ParkingLotResource" } } } } } }, "404": {
"description": "Parking Lot not found", "content": { "application/json":
{ "schema": { "type": "object", "properties": { "error": { "type":
"string" } } } } } } } } }, "/filter-parking": { "get": { "summary":
"Filter parking lots", "tags": \["Parking Lots"\], "parameters": \[ {
"$ref": "#/components/parameters/FilterParkingParams" }  ],  "responses": {  "200": {  "description": "Successful filter",  "content": {  "application/json": {  "schema": {  "type": "object",  "properties": {  "data": { "$ref":
"#/components/schemas/ParkingLotResource" } } } } } }, "404": {
"description": "Parking Lot not found", "content": { "application/json":
{ "schema": { "type": "object", "properties": { "error": { "type":
"string" } } } } } } } } }, "/parking-details/{id}": { "get": {
"summary": "Get parking lot details", "tags": \["Parking Lots"\],
"parameters": \[ {
"$ref": "#/components/parameters/ParkingDetailsParam" }  ],  "responses": {  "200": {  "description": "Successful retrieval",  "content": {  "application/json": {  "schema": {  "type": "object",  "properties": {  "data": { "$ref":
"#/components/schemas/ParkingLotResource" } } } } } }, "404": {
"description": "Parking Lot not found", "content": { "application/json":
{ "schema": { "type": "object", "properties": { "error": { "type":
"string" } } } } } } } } } }, "components": { "schemas": {
"LoginRequest": { "type": "object", "properties": { "email": { "type":
"string" }, "password": { "type": "string" } } }, "RegisterRequest": {
"type": "object", "properties": { "username": { "type": "string" },
"email": { "type": "string" }, "password": { "type": "string" },
"phone_number": { "type": "string" } } }, "UserResource": { "type":
"object", "properties": { "id": { "type": "integer" }, "username": {
"type": "string" }, "email": { "type": "string" }, "phone_number": {
"type": "string" } } }, "ParkingLotResource": { "type": "object",
"properties": { "id": { "type": "integer" }, "name": { "type": "string"
}, "address": { "type": "string" }, "opening_hours": { "type": "string"
}, "price": { "type": "number" }, "distance": { "type": "number" } } }
}, "parameters": { "SearchParkingParams": { "name": "name", "in":
"query", "description": "Search by parking lot name", "required": false,
"schema": { "type": "string" } }, "FilterParkingParams": { "name":
"price_max", "in": "query", "description": "Filter by maximum price",
"required": false, "schema": { "type": "number" }, "name": "distance",
"in": "query", "description": "Filter by maximum distance", "required":
false, "schema": { "type": "number" } }, "ParkingDetailsParam": {
"name": "id", "in": "path", "description": "ID of the parking lot",
"required": true, "schema": { "type": "integer" } } } } }

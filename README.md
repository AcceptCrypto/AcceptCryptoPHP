# Munt PHP library
Documentation: https://docs.getmunt.com

The PHP library is meant for verifying the payment in the back-end. It's a good practise to keep verifying the payment till its fully confirmed.

### Getting started
You can either install our library using composer `composer require svenvdz/muntphp` or download the source code directly from [GitHub](https://github.com/)

### Integrating

#### Checking payment id
Check if the payment has been successful from the above returned payment id.
```PHP
$tx = Munt::tx({{ID}}, {{API KEY}});
```
The response will be as follows;
1. error
	- Boolean, returns if the request has encountered any errors.
2. message
	- String, only returns after an error has occurred.
3. paid
	- Boolean, returns if the payment has been paid.
4. confirmed
	- Boolean, returns if the payment has been fully confirmed.

#### Checking email
Check if the given email address has paid successfully.
```PHP
$email = Munt::email({{EMAIL}}, {{API KEY}});
```
The response will be as follows;
1. error
	- Boolean, returns if the request has encountered any errors.
2. message
	- String, only returns after an error has occurred.
3. paid
	- Boolean, returns if the payment has been paid.
4. confirmed
	- Boolean, returns if the payment has been fully confirmed.

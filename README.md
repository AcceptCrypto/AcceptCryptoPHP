# AcceptCrypto PHP library
Documentation: https://docs.acceptcryp.to

The PHP library is meant for creating custom checkout forms and verifying a payment in the back-end. It's a good practise to keep verifying the payment till its fully confirmed.

### Getting started
You can either install our library using composer `composer require acceptcrypto/acceptcryptophp` or download the source code directly from [GitHub](https://github.com/acceptcrypto/acceptcryptophp)

### Integrating

#### Start checkout process
Add an email address to a payment automatically, to make sure customers use the same email as they did on your website for example. Email address is optional but recommended.
```PHP
$response = AcceptCrypto::checkout({{TOKEN}}, {{CUSTOMER EMAIL ADDRESS}});
```
The response will be as followed;
1. error
	- Boolean, returns if the request has encountered any errors.
2. message
	- String, only returns after an error has occurred
3. token
	- String, payment token to be used in our Javascript library or API.
4. url
	- String, can be redirected to to let the user pay

#### Create a custom checkout form
This code can be used to create a custom checkout form in the back-end rather than on our dashboard. The background and customer email address are both optional parameters but recommended. The background color will be the AcceptCrypto color #FABD58 by default.
```PHP
$response = AcceptCrypto::custom({{NAME}}, {{AMOUNT}}, {{CURRENCY}}, {{BACKGROUND}}, {{CUSTOMER EMAIL ADDRESS}}, {{API KEY}});
```
The response will be as followed;
1. error
	- Boolean, returns if the request has encountered any errors.
2. message
	- String, only returns after an error has occurred
3. token
	- String, payment token to be used in our Javascript library or API.
4. url
	- String, can be redirected to to let the user pay

#### Checking payment id
Check if the payment has been successful from the above returned payment id.
```PHP
$tx = AcceptCrypto::tx({{ID}}, {{API KEY}});
```
The response will be as followed;
1. error
	- Boolean, returns if the request has encountered any errors.
2. message
	- String, only returns after an error has occurred.
3. paid
	- Boolean, returns if the payment has been paid.
4. confirmed
	- Boolean, returns if the payment has been fully confirmed.
5. date
	- Timestamp, returns when the payment was made.

#### Checking email
Check if the given email address has paid successfully.
```PHP
$email = AcceptCrypto::email({{EMAIL}}, {{API KEY}});
```
The response will be as followed;
1. error
	- Boolean, returns if the request has encountered any errors.
2. message
	- String, only returns after an error has occurred.
3. paid
	- Boolean, returns if the payment has been paid.
4. confirmed
	- Boolean, returns if the payment has been fully confirmed.
5. lastPaid
	- Timestamp, returns the date when the email has paid last.
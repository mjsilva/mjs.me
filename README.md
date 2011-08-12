#MJS.ME

* [Demo](http://mjs.me/)
* Version: 2.1

## Description

MJS.ME allows you to shrink your huge link.

##Development Team

* Manuel Joao Silva - Lead Developer ([http://manueljoaosilva.com](http://manueljoaosilva.com))

##License

MJS.ME is released under the MIT License.

## Installation
* Download and extract the application to your web root folder
* In the root folder run: ***php oil install***
* Create your database
* Edit file ***fuel/app/config/db.php*** with your DB configs
* Add ***SetEnv FUEL_ENV production*** to file ***public/.htaccess***
* Run command ***php oil migrate*** this should create DB schema

##Changelog

<pre>
## v2.1
* Added migration DB schema
* Several clean ups and small fixes

## v2.0
* Authentication
* Api
* Small bug fixes

## v1.2.2
* CSS fix

## v1.2.1
* Fixed bug with url hit increment

## v1.2
* Update framework Core
* Added protection against invalid URLs and loop redirects

## v1.1
* Copy is now working
* Added growl like notifications
</pre>
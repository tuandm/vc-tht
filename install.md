## Take-Home Task
### Background
Colonizing the Moon is going to be step one to colonize Mars. Phase 3 of the colonization would
require having some sort of economy.
Trading, traveling and other types of business will be the start of creating a sustainable economy.

### Project
Vestiaire Collective would be the one to start with the lunar fashion project. The purpose of the
project is to take a fashion stand in space wear.
And as part of the project, we need to estimate the time it takes our shipments to arrive at Lunar
Colony, and your task is to help us:
- by creating a microservice, with an API that takes the earth time in UTC when the shipment
  left the warehouse, and
- calculate the time of arrival to Lunar Colony, the time return should be in LTS.
  Your service will need to be ready for direct deployment in our lunar branch data center.

### Getting started
#### Prerequisites
- This project is based on Laravel framework. Please be ready for the latest [Laravel](https://laravel.com)   

#### Installation
1. Clone the project, run composer to setup basic a Laravel project
2. Run this command to generate documentation
```
php artisan scribe:generate
```
3. Start server
```
php artisan serve
```
Then go to http://127.0.0.1:8000/docs 

#### Tests
```
php artisan test
```
Tests include UnitTest for `lunar_time` helper and API tests for the shipment estimation API.

### Acknowledgements
- [lunar_date](https://dev.kakaopor.hu/stuffs/lunar_date.php.txt) helper by Gabor Heja (gheja)
- [Scribe](https://scribe.knuckles.wtf/) for API documentation

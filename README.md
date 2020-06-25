# Squa Blog

This blog uses Laravel 7, I recommend to use the integrated Docker or in case you want to install it from scratch take into account the following requirements.

- PHP >= 7.2.5
- Extensions
    - BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- MySQL 5.7
- Redis 14

## Feed Server

This project has a cron that brings the publications of another platform from time to time, by default it is set to 2 minutes for testing purposes, but it could be every 20 minutes so as not to saturate the services. 

## Cache
This project use redis as cache server to minimize the impact on the data layer by ensuring service in cases of high data concurrency.  

## Install

Clone this repository

Install Composer dependencies
```bash
composer install
```
Install Node Dependencies 
```bash
npm install
```

### Deploy on Docker
```bash
docker-compose up
```

Migrate database and seeds

```bash
docker-compose exec php-fpm php artisan migrate:fresh --seed
```

# Use

Admin login
   - Email: admin@squa.com
   - Pass: Squa123456
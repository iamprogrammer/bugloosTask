<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Install `PHP` and `composer`

#### * first install `composer` then open project directory in `cmd` and run these command to build laravel project 

- `composer update` 
- `php artisan key:generate`
- `php artisan serve`



# About this project

There is a log file that contains log lines from multiple microservices. This file is very large and has almost 100 million lines. A small sample of this log file can be found in `logs.txt`
What are your tasks?

#### 1 - Create a console command that parses the log file and inserts the data into the database.

- To run command use : `php artisan parse:logFile`

#### 2 - Design a REST API endpoint `/logs/count` which returns a count of rows that match the filter criteria. This endpoint accepts filters via GET HTTP verb and allows zero or more filter parameters.

- To run api to get count of logs with/without filter use this route:`/api/logs/count?serviceNames=order `
- Other params that you can use are : `['statusCode','startDate','endDate']`
- params can use together

#### 3 - You can run feature test by using:` php artisan test --filter LogsTest `

#### 4 - We could make test to test validation ,all filter params  and test command 

#### 5 - We could use model to add the logic of filtering and counting, but I used Repository pattern to make my code cleaner and more reusable.

#### 6 - We can use OpenApi/swagger to make document .  

#### 7 - I wanted to use jwt to login user with token and make the api secure , but it was not requested in the challenge text.

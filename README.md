# Decision Table Task

This is a PHP application built with Docker.

## Prerequisites

To run this application, you need to have Docker installed on your machine. You can download Docker from the official website: [https://www.docker.com/](https://www.docker.com/)

## Getting Started

1. Clone this repository to your local machine:
```shell
git clone git@github.com:gilyaev/decision-table.git
```
2. Navigate to the project's root directory:
```shell
cd decision-table
```
3. Build the Docker image using the provided Dockerfile:
```shell
docker build -t decision-table-app .
```
4. Run the Docker container with the built image:
```shell
docker run -d -p 8000:8000 --name decision-table-app decision-table-app
```
5. Run console app
```shell
 docker exec -it decision-table-app sh -c "cd public && php index.php"
```
6. Run unittest
```shell
docker exec -it decision-table-app ./vendor/bin/phpunit tests/
```


## Task
![alt text](https://github.com/gilyaev/decision-table/blob/master/public/assets/task.png)


docker run -d -p 8000:8000 -v ~/test/decision-table/public:/var/www/html/public -v ~/test/decision-table/src:/var/www/html/src -v ~/test/decision-table/tests:/var/www/html/tests my-php-app
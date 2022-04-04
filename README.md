# Hotel Api

A simple REST API that returns room availability in a range of dates.

## Requirements

### PHP 7
## Installation

1) Clone the project
```bash
  cd hotel-api
```
2) Install necessary packages
```bash
  composer install
``` 
3) Import the ```db.sql``` file to your Database

4) Rename the ```config_template.php``` to ```config.php```

5) Add your Database connection info in ```config.php```
## Run Locally
1) Run the server on localhost:8080
```bash
  php -S localhost:8080
```
2) Using a REST client (eg. Postman) call the following GET endpoint
```bash
  GET localhost:8080/available/rooms
```
JSON Body 
```bash
  {
    "check_in": "2022-03-20",
    "check_out": "2022-03-30"
  }
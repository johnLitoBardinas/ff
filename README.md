<p align="center"><a href="https://www.ffcustomerdata.xyz" target="_blank"><img src="https://fixandfree.herokuapp.com/svg/fandf.co_horizontal.svg" width="400"></a></p>

&nbsp;

## Personal Care Services - AUTOMATED SUBSCRIPTION APPLICATION

---
## 🛠️ Application Containers

#### 1. [**Laravel 7**](https://laravel.com/)
#### 2. [**Composer**](https://getcomposer.org/)
#### 3. [**MySQL**](https://www.mysql.com/)
#### 4. [**NPM**](https://www.npmjs.com/)
#### 5. [**PHP 7.4**](https://www.php.net/releases/7_4_0.php)




---

## 🚀 Local Setup

> **Requires [Docker 18+](https://docs.docker.com/release-notes/)**

### Bring Up all the containers
> `docker-compose up -d --build`

### Bring Down all containers
> `docker-compose down --rmi=local`

---

## 📝 Local Linting + Testing

### _For Testing 👇_
* [**PHPUNIT**](https://phpunit.de/)
* [**PHP Insights**](https://phpinsights.com/)

### Run this to lint your code using the [**PSR 12**](https://www.php-fig.org/psr/psr-12/meta/).
> `docker-compose run --rm composer lint:psr12`

### Run below command to check your PHP Insights Score
The acceptable code score for
* **CODE** - **88%**
* **COMPLEXITY** - **88%**
* **Architecture** - **88%**
* **Style** - **88%**
<br/> so make your code **PASS** that threshold.

> using the composer container `docker-compose run --rm composer run test:insights`
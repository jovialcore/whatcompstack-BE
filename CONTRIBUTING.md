## ✨ What-Company-Stack Backend and Admin

### Contribution git flow
To make a pull request, create a branch on the github repo. Typically, the branch name should be the name of the issue you are making a pull request for. If there are no exisiting issues, you should still create a branch and make a pull request to the branch you just created . Please do not make a pull request to dev branch or main.  

Once a pull request has been made, the maintainer will pull that branch and test the recent changes before taking the next action. 


### Installation

Before you begin, ensure you have met the following requirements:

- [PHP](https://www.php.net/) >= 8.x
- [Composer](https://getcomposer.org/) installed
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/) (for frontend assets)

### Installation

```bash
git clone  https://github.com/jovialcore/whatcompstack-BE.git
cd whatcompstack-BE
composer install
npm install
cp .env.example .env
```
### Configuration
```bash
php artisan key:generate
```

### Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### Running the application

```bash
php artisan serve
```

### Running the application via docker
You can also run the BE via a container if you are experiencing difficulty with the local setup

#### Prerequiste
Before you begin make sure you have the docker daemon installed and running on your PC. If you don't have docker installed, you have to either download [docker desktop](https://www.docker.com/products/docker-desktop/) or [OrbStack](https://orbstack.dev/download), and install it. Note OrbStack only works on Mac

#### Building and Running the container using docker-compose
Open a new terminal, navigate to the root directory of the repo, and run the next set of commands to configure and start the container.
- `docker-compose build` to build the container
- `docker-compose run app composer install` to install the PHP packages
- `docker-compose run app npm install` to install the node packages
- `docker-compose run app php artisan migrate` to run the migrations
- `docker-compose run app php artisan db:seed` to seed the database
- `docker-compose up -d app` to start the container
- Launch the app by opening `http://localhost:8000/` on your web browser

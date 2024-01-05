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

# Covid monitor
This application is made using PHP and mongo db database, its main idea is to keep the Moroccan people informed about the last statistics of Covid 19 on Morrocan territory

# requirement
PHP >= 8.1
Node >= 18
mongodb
mongodb php extention installed and enabled

# Instruction to install the application
```
git clone ...
cd covid
composer install
npm install
```
> Serve it as you want

# Usage
If you want to dynamically load the data, you need to run this command it will load the data into your mongodb database, the **cron.js** file works each 5 minutes to check some hosted files into a repositories you can use what ever you want as entry, the only thing is that you need to follow the same json structure to keep things working.

Check the files from here [data files](https://github.com/AyatANSSAIEN/Covid19)
```
cd database
node cron.js
```
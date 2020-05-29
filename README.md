# Library_test_task
Here you can find the final project of my test task. To use it you need to follow the next steps:

1. Make a server. If you are using "Windows" use OpenServer or if it is "MacOs" use Mamp.
2. After you have prepared your server, you need to install composer. For this open the console/terminal and go to the folder with the project. After this, use this to install composer:<br>
            <p>php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"<br>
            php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"<br>
            php composer-setup.php<br>
            php -r "unlink('composer-setup.php');"<br></p>
 3. Now when you are done with your composer install laravel. You need to install it only once, if you do not have it yet, install.<br>
            <p>composer global require laravel/installer</p>
 4. Create a database. For this project MySQL was used.
 5. Move to the folder where you would like to create your project. Create a project using console/terminal. Then you need to clone my project to your computer.
            <p>composer create-project --prefer-dist laravel/laravel "type your name here"</p>
 6. Connect the project with your database. All connections must be done in ".env" file (you will need to create it as I have added env file to gitignore).
 7. Make a migration:
            <p>php artisan migrate:fresh</p>
 8. After everything was done you need either to open your server name or if did not create it:
            <p>php artisan serve</p>
 9. Now on the home page you can choose what you want to see:           
 ![home page](https://github.com/Infinyti/Library_test_task/blob/master/Instruction%20img/pic_1.PNG)
 10. When you are on either "book page" or "authors page" you will not see anythig, so creat the author first.
 11. As a final result you will get something like this (and of course all buttons work): 
 ![author page](https://github.com/Infinyti/Library_test_task/blob/master/Instruction%20img/pic_3.PNG)
 ![book page](https://github.com/Infinyti/Library_test_task/blob/master/Instruction%20img/pic_2.PNG)
 

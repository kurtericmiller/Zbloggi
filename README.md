# Zbloggi
## Blogging software powered by Zend Framework
If you were ever curious about what it would take to create blogging software using Zend Framework, well then, today is your lucky day. Zbloggi is written completely in PHP and Zend Framework (with a smattering of JavaScript gizmos thrown in for good measure, though we didn't write those of course.)

And your curiosity will serve you well because you'll find the documentation slim at best and non-existent at worst so it will behoove you to jump in and start digging.

### Requirements
You'll need some type of XAMP installation on your platform. The following component versions are being used successfully and should be thought of as minimums:

- PHP 5.2.17
- MySQL 5.1.61
- Apache 2.2.20
- Zend Framework 1.11.11

Other versions should also work. For instance we tried it on a current WAMP install with PHP v.5.3.8, Apache v.2.2.21 and MySQL v.5.5.16 and all worked fine. YMMV.

### Installation
Grab the source in the manner that is your wont and stick it where you will.

Use docs/README.txt to help set up an Apache virtual host pointing to your installed public directory. (Don't forget to update your 'hosts' file)

Create a new database with the name of your choice.

Use the 'dev.sql' file in the 'sql' directory to create the database tables and load your initial data.

You'll need to set your own resources.db.params parameters in 'application/configs/application.ini' and, if you'll be testing, in the testing section. Attend to the timezone also as well as notifier email settings while you're there.

Make sure the Zend library is somewhere in your PHP include_path otherwise the whole enterprise is for naught.

Fire up a browser and point it to your new virtual host. If all's gone well you should see the default site, 'Your Moment of Zend.' Log in as 'admin/password' and you'll be able to access the admin section. Create a new profile while you're logged in also.


## Configuration
### The 'application.ini' file:
You'll need to set the salt parameter to something of your own chosing. The current value will allow you to log in using 'admin/password' only. The best way to tackle this is to create your new profile. Once you're at your profile display page use your favorite editor to edit 'application/configs/application.ini' and set your new salt value. Back on the profile page click on 'Change Password' and enter your new password which will now be created with the new salt value. (Quick tip: You can manually set a password using phpmyadmin. Pull up and edit, not inline edit, the user record you want to change and using the SHA1 function and setting the password field to "newpassword${salt}" replacing ${salt} with your new salt value should do the trick)

### The 'index.php' file:
The APPLICATION_ENV variable defaults to 'development'. Change it or keep it as you see fit.

## Testing
### The 'RssIndexControllerTest.php' file:
This file uses the url, 'ymozend.tst', which is configured to use the testing database here at YMOZ central. This obviously, baring a miracle, won't work for you. You'll need to set up a vhost that sets the APPLICATION_ENV variable to 'testing' so the app can pull data from your own testing database.


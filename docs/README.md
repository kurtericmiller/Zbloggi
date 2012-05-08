## Configuration
### The 'application.ini' file:
You'll need to set your own resources.db.params parameters in the bootstrap section and, if you'll be testing, in the testing section.

You'll need to set the salt parameter to something of your chosing. Since this has been munged none of the existing user passwords will work if you load the supplied user data.

### The 'index.php' file:
The APPLICATION_ENV variable defaults to 'development'. Change as you see fit.

## Testing
### The 'RssIndexControllerTest.php' file:
This file uses the url, 'bruce.test', which is configured to use the testing database here at YMOZ central. This obviously, baring a miracle, won't work for you. You'll need to set up a vhost that sets the APPLICATION_ENV variable to 'testing' so the app can pull data from your own testing database.



# The Camagru Project

This is a first project from Web Branch of School 42.

[Click Here](https://sleepy-waters-92816.herokuapp.com/index.php) to see it in action. I deployed it to Heroku.

## Summary

> The goal of this project is to build a web application a little more complex than the previous ones with a little less means.

## Subject

### User features

* The application should allow a user to sign up by asking at least a valid emailaddress, a username and a password with at least a minimum level of complexity.

* At the end of the registration process, a user should confirm his account via a unique link sent at the email address fullfiled in the registration form.

* The user should then be able to connect to your application, using his username and his password. He also should be able to tell the application to send a password reinitialisation mail, if he forget his password.

* The user should be able to disconnect in one click at any time on any page.

* Once connected, an user should modify his username, mail address or password.

### Gallery features

* This part is to be public and must display all the images edited by all the users, ordered by date of creation. It should also allow (only) a connected user to like them and/or comment them.

* When an image receives a new comment, the author of the image should be notified by email. This preference must be set as true by default but can be deactivated in user’s preferences.

* The list of images must be paginated, with at least 5 elements per page.

### Editing Features

This part should be accessible only to users that are authentified/connected and gently reject all other users that attempt to access it without being successfully logged in.

This page should contain 2 sections:

* A main section containing the preview of the user’s webcam, the list of superposable images and a button allowing to capture a picture.

* A side section displaying thumbnails of all previous pictures taken.

* Superposable images must be selectable and the button allowing to take the picture should be inactive (not clickable) as long as no superposable image has been selected.

* The creation of the final image (so among others the superposing of the two images) must be done on the server side, in PHP.

* Because not everyone has a webcam, you should allow the upload of a user image instead of capturing one with the webcam.

* The user should be able to delete his edited images, but only his, not other users’ creations.

### Constraints and Mandatory things

To sum up things, your Über application should respect the following technologic choices:

* Authorized languages:

  * [Server] PHP
  * [Client] HTML - CSS - JavaScript (only with browser natives API)

* Authorized frameworks:

  * [Server] None
  * [Client] CSS Frameworks tolerated, unless it adds forbidden JavaScript.

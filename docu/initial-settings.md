# Initial settings after installation

# 1. setup E-Mail-Support

Agila vocca has a register & login form like the ones you might know form other websites.

Without the settings, it won't work!

Navigate to your local .env-File and change these settings:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST="127.0.0.1"
MAIL_PORT="1025"
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Please take a look at Your E-Mail-provider-settings for the right things to fill in. 
If possible, use encryption and don't use your private email-address, use an extra address.

If you set up everything correct, the login process works that way:
When a user clicks "register" and fills out the form (and sends it), an email is sent to the given address.
When the user enters the code, the user is registered and can login from now on.

But the user can only do vocabulary-tests. He can't create stuff.

# 2. more rights for users
You have to have a user with a higher role:

| user    | role                                                                 |
|---------|----------------------------------------------------------------------|
| pupil   | can do tests + change own profile settings                           |
| teacher | + can edit/delete/create vocabularies, chapters, books               |
| rector  | + can edit/delete/create languages                                   |
| admin   | + can administrate user accounts + app settings (not yet implemented |

There are two ways to do that:

### 2.1 Giving users more rights with php artisan - command
`php artisan` is the command for running command in your shell for administrating things 
- log into ddev with `ddev ssh`  or `docker exec -it your-container-name bash`
- go to the app directory, usually: `cd /var/www/html`
- run the command `php artisan user:assignrole the-user@e-mail.com admin` 
  - (If you want to set another role, use `pupil`,`teacher`, `rector`. New users have the role `pupil` ).

### 2.2 Giving users more rights at database
- Log in into your applications' database, for example with phpmyadmin or another program to manage mariaDB-Connections.
- Execute the following command: 
  - `UPDATE users SET role='admin' WHERE email='the-user@e-mail.com;`


If the user was logged in, he/she has to reload the page.

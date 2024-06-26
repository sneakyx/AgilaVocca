# Agila Vocca - Installation Guide

This guide provides instructions for installing the Agila Vocca application on different environments.


## 1.1 Local Installation with DDEV

To install the project locally with DDEV, the user should follow these steps:

1. Install DDEV on your system if it's not yet installed. You can find DDEV installation instructions on the [official DDEV documentation](https://ddev.readthedocs.io/en/stable/#installation)
   
2. Clone the project repository to your local machine.
3. Navigate to the project directory.
```cd <project-directory> ```
4. Launch the project with DDEV. `ddev start`. During installation root passwort is necessary for installing certs.
5. log into webserver with `ddev ssh` and run script ./docker/laravel_setup_script.sh
6. check the settings in `.env`-File. You might want to change the following setting for local development
   - `APP_ENV=local`
   - `APP_DEBUG=true`
   - `TELESCOPE_ENABLED=true`

## or 1.2 Server Installation with Docker and Docker-Compose (files not finished yet)

To install the project on a server with Docker and Docker-Compose, the user should follow these steps:

1. Install Docker and Docker-Compose on the server if they're not yet installed. 
   - Installation guide: https://docs.docker.com/engine/install/ 
2. Clone the project repository on the server.
3. Navigate to the project directory. `cd <project-directory>/docker`
4. First-run of this service: `docker-compose up setup` (for installation of dependencies) 
5. When the installation is finished, use `docker-compose up app`
6. make sure you have something in front of this container that handels ssl-termination and support certificates


## or 1.3 Installation on a webspace without terminal access
For installation on a webspace without terminal access, a prepared version of the project is required.
1. Create a prepared version of the project on a local machine or server.
2. ZIP the AgilaVocca-Folder
3. Upload the ZIP-File to your webspace
4. (when you update the project, don't zip the .env file- these are the special settings for your project!)
5. unzip the file to the destination folder
6. remove folders `.ddev`, `.idea`
7. set the starting folder for your domain to `agilavocca/public`
8. Use the control panel of the provider to configure other settings as needed
9. Set up database access as required by the project. (TODO: Add an empty database for user)
10. Set up everything in .env-File (TODO: explain the .env-File)
Please note that the specific steps may vary depending on your server configuration and hosting provider.

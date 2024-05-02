# AgilaVocca

![Logo Agila Vocca](public/images/logo-full-size.webp)
<sub><sup><sub><sup>(Logo generated bei AI)</sup></sub></sub></sub>

...is a regular vocabulary learning program to show some laravel code.

## history and features of a version once upon a time

When I was 14 years old I programmed a vocabulary learning programm because I wanted to get rid of the gamification
elements of the other programms that existed at this time. It should be a straight-forward-application, no distraction.
It should be possible to learn the vocabulary very fast and effective. My idea in this time was to repeat all vocabulary
until it was written once the right way, even though some words had to be repeated more than one time.
Every false spelling is an error and one point is subtracted. So you can reach a sum of lower than zero.

The summary is not suitable for sensitive persons - but for persons with high intrinsic motivation - so please stand
clear and use another program if you need gamification and extrinsic motivation.

The programm was back in time programmed with Turbo Pascal. This repository is based on Laravel.

# Installation

Please start with [basis installation](docu/basis-installation.md). Agila Vocca should run 
- locally with ddev in developer mode 
- or with docker/docker-compose
- or on webspace

After basis installation, you have to setup E-Mail-support and create an admin. 
For this step see [initial settings](docu/initial-settings.md).

# First steps when everything works

Let me explain the data structure:

Every Vocabulary belongs to a chapter. Every Chapter belongs to a book. 
Every book has to two languages: the foreign language and the native language.

As admin (or rector) you have to create languages (minimum 2). 
The next step would be the creation of a book. After that you can create chapters.

The last step is creating vocabularies.


## technics

- [Laravel](https://laravel.com/)
- [MariaDB](https://mariadb.org/)
- [ddev](https://ddev.readthedocs.io/en/stable/)

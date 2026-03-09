## Multilingual Support

AgilaVocca supports multiple languages for the user interface. Users can select their preferred language in the settings.

### Supported Languages
- English (en)
- Deutsch (de)
- Français (fr)
- Español (es)

### Adding a New Language
1. Create a new language file in `resources/lang/<code>/` (e.g., `resources/lang/it/general.php`).
2. Add translations for all keys in `general.php`, `messages.php`, and `settings.php`.
3. Update the `LanguageController` to include the new language in the selection.

---
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

Please start with [basic installation](docu/basic-installation.md). Agila Vocca should run 
- locally with ddev in developer mode 
- or with docker/docker-compose (docker-files not finished yet)
- or on webspace

After basis installation, you have to setup E-Mail-support and create an admin. 
For this step see [initial settings](docu/initial-settings.md).

# First steps when everything works

Let me explain the data structure:

Every Vocabulary belongs to a chapter. Every Chapter belongs to a book. 
Every book has two languages: the foreign language and the native language.

As admin (or rector) you have to create languages (minimum 2). 
The next step would be the creation of a book. After that you can create chapters.

The last step is creating vocabularies.


# Artisan Commands for Import/Export

AgilaVocca provides Artisan commands for importing and exporting vocabularies in JSON or JSON-Newline format.

## Export Vocabularies

Export vocabularies from a book or lesson:

```bash
# Export a book to JSON
php artisan vocab:export --book=1 --file=vocab.json --format=json

# Export a lesson to JSON-Newline
php artisan vocab:export --lesson=1 --file=vocab.jsonl --format=json-newline
```

**Options:**
- `--book`: ID of the book to export.
- `--lesson`: ID of the lesson to export.
- `--file`: Path to the output file (default: stdout).
- `--format`: Output format (`json` or `json-newline`).


## Import Vocabularies

Import vocabularies into a book or lesson:

```bash
# Import into a new book
php artisan vocab:import --file=vocab.json --new-book --format=json

# Import into an existing lesson (add to existing vocabularies)
php artisan vocab:import --file=vocab.jsonl --lesson=1 --format=json-newline

# Import with dry-run (simulate without changes)
php artisan vocab:import --file=vocab.json --book=1 --dry-run
```

**Options:**
- `--file`: Path to the input file (required).
- `--book`: ID of the existing book to import into.
- `--lesson`: ID of the existing lesson to import into.
- `--new-book`: Create a new book.
- `--new-lesson`: Create a new lesson.
- `--clear-book`: Clear the book before importing.
- `--clear-lesson`: Clear the lesson before importing.
- `--dry-run`: Simulate the import without making changes.
- `--format`: Input format (`json` or `json-newline`).


## technics

- [Laravel](https://laravel.com/)
- [MariaDB](https://mariadb.org/)
- [ddev](https://ddev.readthedocs.io/en/stable/)

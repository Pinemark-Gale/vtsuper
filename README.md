# VT Super Documentation

=========================================

***Vermont Substance Abuse and Prevention Website***

**Pinemark Studio** *Gale Proulx*

---

# Table of Contents

[Application Structure](#application-structure)

[Custom Middleware](#custom-middleware)

[Database Seeding & Factories](#database-seeding--factories)

[Database Structure](#database-structure)

[Dependencies](#dependencies)

[Recommended Developer Environment](#recommended-developer-environment)

[Useful Commands](#useful-commands)

[Useful Links](#useful-links)

[<< Previous Section](#vt-super-documentation) | [Content Table](#table-of-contents) | [Next Section >>](#application-structure)

---

# Application Structure

Laravel is the php framework used to construct this website. For more in depth info on how Laravel works and how to set up a local testing environment, go to the [Laracasts](https://laracasts.com/series/laravel-8-from-scratch/) website. It's a great place to understand what Laravel does and the workflow.

Before we can understand where objects are housed, it is important to understand the terminology of Laravel. Below is a table of some of the common terms used in Laravel.

| Term           | Explanation                                                                                                                                                                                                                                                                                                                                                                                    |
| -------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Model          | A php class based on a database table. This class should be in charge of managing relationships between classes and the modification of data. It is the last step when making a database request.                                                                                                                                                                                              |
| Eloquent Model | Similar to a Model, an Eloquent Model is a php class that contains special Laravel functions. In Laravel it's assumed that each table in a database will need basic functions like finding all instances of a table, or the first row, maybe the last. Rather than writing and rewriting these functions, an Eloquent Model offers them out of box with improved syntax and easy to read code. |
| View           | The code that generates HTML pages. May contain just HTML or a combination of HTML and php. Typically multiple views are included in one web page.                                                                                                                                                                                                                                             |
| Layouts        | Templates for pages. Helps avoid reusing code on separate files. If, for example, the header navigation is included in every view, then using a layout can make that repetitive code consolidate into one place, so every view can just include the layout.                                                                                                                                    |
| Routes         | A master record of what controller and function should handle a specific http request. Functionality is usually quite limited to just routing where a request should go, never including the actual function definition itself.                                                                                                                                                                |
| Controller     | The list of php functions that pertain to handling http requests. Controllers are usually the intermediate step between Models and Routing/Views.                                                                                                                                                                                                                                              |

The following table below will outline the directory structure and where to find files. This should make troubleshooting a little easier. For the purposes of this program, the app, database, resources, and routes directories are the most commonly used directories.

| Directory | Purpose/Contents                                |
| --------- | ----------------------------------------------- |
| app       | Stores model and controller files.              |
| database  | Stores migration, factories, and seeders files. |
| resources | Stores views, styling, and Javascript.          |
| storage   | Contains all logs.                              |

[<< Previous Section](#table-of-contents) | [Content Table](#table-of-contents) | [Next Section >>](#custom-middleware)

---

# Custom Middleware

Some php functions are run constantly whenever some or all requests are made to the server. Middleware is here to easily implement these intercepting functions throughout a Laravel app.

You can find all Middleware in the directory below.

```
App/Http/Middleware
```

If you'd like to add Middleware to reference in routes go to the following file. Do note that the top section references Middleware that is run for every request, while the bottom references Middleware that is run every time it is called.

```
App/Http/kernal.php
```

Any custom Middleware that has been added to this web app will be documented below.

## Admin Privilege

In order to support admin-only views the Admin Privilege Middleware was needed. Any route that has ```middleware('admin')``` specified means a user needs to be signed in as an admin in order to access that view.

Make sure to not make privilege checks inside controllers. It is a much better practice to use this Middleware and avoid duplicate code.

[<< Previous Section](#table-of-contents) | [Content Table](#table-of-contents) | [Next Section >>](#database-seeding--factories)

---

# Database Seeding & Factories

Testing a local testing environment can be challenging without a dataset. Rather than spending the time to make fake data, Laravel comes with seeders and factories.

**Seeders**

Since Laravel already has Eloquent models, Laravel made a special class type called seeders which essential just create and save models automatically when the ```php artisan migrate --seed``` command is called. Rather than writing a SQL query to make these insert statements, you can now run them from the console and they are clearly stated in the web application itself. Do note you can also run ```php artisan migrate:fresh -seed``` which will automatically wipe the database and add the seeder models into the database.

**Factories**

While seeders are nice, they still require you to make each row of data. Laravel offers factories which essentially creates models and automatically generates names, emails, urls, etc. with the Faker module. Even better, multiple models can be made by just specifying how many models you want to make when calling a factory.

Essentially, factories simplify the process of writing multiple rows of data and inserting it into the database with just one line of code. Now all data is dynamically created making it look like your web application is already being used. This makes it much easier to develop and test.

[<< Previous Section](#application-structure) | [Content Table](#table-of-contents) | [Next Section >>](#database-structure)

---

# Database Structure

**Users**

| Variable          | Type   | FK  | Description                             |
| ----------------- | ------ | --- | --------------------------------------- |
| id                | int    |     | primary key for the Users table         |
| privilege_id      | int    | X   | foreign key from the Privilege table    |
| school_id         | int    | X   | foreign key from the School table       |
| name              | string |     | name of the user                        |
| email             | string |     | email of the user                       |
| email_verified_at | date   |     | confirmation if email has been verified |
| password          | string |     | password for the user account           |
| rememberToken     |        |     | token to skip auto-logout               |

**Schools**

| Variable | Type   | FK  | Description                         |
| -------- | ------ | --- | ----------------------------------- |
| id       | int    |     | primary key for the Schools table   |
| name     | string |     | name of the school                  |
| district | string |     | district that the school resides in |

**Source**

| Variable | Type   | FK  | Description                      |
| -------- | ------ | --- | -------------------------------- |
| id       | int    |     | primary key for the source table |
| source   | string |     | source of a resource             |

**Privileges**

| Variable | Type   | FK  | Description                                            |
| -------- | ------ | --- | ------------------------------------------------------ |
| id       | int    |     | primary key for the Privilege table                    |
| title    | string |     | label for the privilege (i.e. admin, student, teacher) |

**Resource**

| Variable         | Type   | FK  | Description                                 |
| ---------------- | ------ | --- | ------------------------------------------- |
| id               | int    |     | primary key for the resource table          |
| resource_type_id | int    | X   | foreign key from the Resource Type table    |
| source_id        | int    | X   | foreign key from the Source table           |
| name             | string |     | name of the resource                        |
| link             | string |     | url to the resource                         |
| description      | text   |     | a description of what the resource contains |

**Resource Type**

| Variable | Type   | FK  | Description                        |
| -------- | ------ | --- | ---------------------------------- |
| id       | int    |     | primary key for the template table |
| type     | string |     | the type of resource               |

**Resource Tags**

| Variable | Type | FK  | Description                            |
| -------- | ---- | --- | -------------------------------------- |
| id       | int  |     | primary key for the template table     |
| tag      | int  |     | a tag to be associated with a resource |

**Resource Resource Tags**

| Variable        | Type | FK  | Description                        |
| --------------- | ---- | --- | ---------------------------------- |
| id              | int  |     | primary key for the template table |
| resource_id     | int  | X   | foreign key of the resource        |
| resource_tag_id | int  | X   | foreign key of the tag             |

**Template Table**

| Variable | Type | FK  | Description                        |
| -------- | ---- | --- | ---------------------------------- |
| id       | int  |     | primary key for the template table |
|          |      |     |                                    |
|          |      |     |                                    |

[<< Previous Section](#database-seeding--factories) | [Content Table](#table-of-contents) | [Next Section >>](#dependencies)

---

# Dependencies

## Laravel Breeze

The authentication of Laravel was initialized through Laravel Breeze which means not all controller functions are in the controller folder. For user registration and login you may need to look in the following directory...

```
/vendor/laravel/breeze/stubs/inertia-common/app/Http/Controllers/Auth
```

Do note that Auth routes are still defined in the ```routes``` directory, so there's no need to go into the vendor folder for changing routes.

[<< Previous Section](#database-structure) | [Content Table](#table-of-contents) | [Next Section >>](#recommended-developer-environment)

---

# Recommended Developer Environment

This section contains a list of recommended setups for editing the web application. This is by no means a requirement but more of a guide to make development easier if a developer has never had experience developing in Laravel.

**OS**

Linux based systems are best. Mac OS and Linux flavors such as Pop! OS do a fantastic job at getting the majority of a local testing environment natively setup. It is absolutely possible to develop in Windows, but LAMP stacks don't run natively so you'll have to depend on something like XAMPP (unless using a Docker container).

**Coding IDE**

Visual Studio Code does a great job at recognizing Laravel's library and it's open source. PHP Storm is another option (albeit paid) that Laravel developers use but it is proprietary.

**Markdown IDE**

I love using a simple program such a Mark Text for editing markdown documents such as this one! Being open source is definitely a plus.

**MySQL Workbench**

We are using MySQL, so the open source program MySQL Workbench gets the job done. There are absolutely nicer looking programs out there, but this one is free and in reality it will hardly be used.

[<< Previous Section](#dependencies) | [Content Table](#table-of-contents) | [Next Section >>](#useful-commands)

---

# Useful Commands

```
php artisan serve
```

Will set up a local testing environment on http://127.0.0.1:8000.

```
npm run watch
```

Activate SCSS compiler. This function was activated by replacing the .css line in [webpack.mix.js](https://github.com/Pinemark-Gale/vtsuper/blob/main/webpack.mix.js "webpack.mix.js") with a .scss line which points the compiler to the app.scss file location, compiles the scss styling, and converts it to css which is placed in the public directory under app.css.

When making any styling changes, it is highly recommended that this command be run. If you'd like to only compile the scss styling once, run ```npm run dev``` which will do a single time compile.

```
php artisan migrate:fresh --seed
```

Only used for the local testing environment, this command will refresh the entire database and provide fake data as defined by files under the database/factories and database/seeders directories. (Keep in mind that creating one type of object might call factories on other types of objects. For example, when creating a user an accompanying school and privilege will be made, circumventing the need to call the school and privilege factories independently.)

```
php artisan tinker
```

Used for local testing, tinker will allow you to write php commands to test models. For example, while using tinker it is possible to test ```users = User::all()``` to see if all users are retrieved, what the data structure looks like, and any potential eloquent connection that have been made. This console allows for rapid testing of new code without testing in a browser.

[<< Previous Section](#recommended-developer-environment) | [Content Table](#table-of-contents) | [Next Section >>](#useful-links)

---

# Useful Links

[Laravel Documentation](https://laravel.com/docs/8.x/)

Pretty much any questions not answered in this readme can find answers in the Laravel documentation. Their search engine is extremely useful.

[Installation - Local Testing Environment](https://laravel.com/docs/8.x/#your-first-laravel-project)

For instructions on how to set up a local testing environment just follow the installation instructions in the Laravel documentation for whatever OS you are using. Use this Git repo to initialize. (This project was originally developed on a Mac so some unexpected errors may occur if using Linux or Windows.)

Typically it is recommended to avoid Docker just to avoid troubleshooting containers. If you're confident in using Docker then by all means run a docker container.

[Laracasts - Laravel 8 From Scratch](https://laracasts.com/series/laravel-8-from-scratch/episodes/1)

An amazing 9h 48m video series going through all the basics of Laravel. Easily the best place to learn how to use Laravel even if you have no experience.

[Faker Formatters](https://fakerphp.github.io/)

If you're trying to make factories, this website is a great reference to know what Faker formatters there are. (You can also just look into the Faker function in your IDE.)

[<< Previous Section](#useful-commands) | [Content Table](#table-of-contents) | [Next Section >>](#none)

---

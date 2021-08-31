# VT Super Documentation

=========================================

***Vermont Substance Abuse and Prevention Website***

**Pinemark Studio** *Gale Proulx*

---

# Table of Contents

[Application Structure](#application-structure)

[Database Structure](#database-structure)

[Useful Commands](#useful-commands)



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





[<< Previous Section](#table-of-contents) | [Content Table](#table-of-contents) | [Next Section >>](#database-structure)

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

**Privilege**

| Variable | Type   | FK  | Description                                            |
| -------- | ------ | --- | ------------------------------------------------------ |
| id       | int    |     | primary key for the Privilege table                    |
| title    | string |     | label for the privilege (i.e. admin, student, teacher) |

**Template Table**

| Variable | Type | FK  | Description                        |
| -------- | ---- | --- | ---------------------------------- |
| id       | int  |     | primary key for the template table |
|          |      |     |                                    |
|          |      |     |                                    |



[<< Previous Section](#application-structure) | [Content Table](#table-of-contents) | [Next Section >>](#useful-commands)

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

[<< Previous Section](#database-structure) | [Content Table](#table-of-contents) | [Next Section >>](#none)

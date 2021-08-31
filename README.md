VT Super Documentation

====================

***Vermont Substance Abuse and Prevention Website***

**Pinemark Studio** *Gale Proulx*



# Table of Contents

[Useful Commands](#useful-commands)

---

# Application Structure

Here I will explain how the structure of this application works.





[<< Previous Section](#table-of-contents) | [Content Table](#table-of-contents) | [Next Section >>](#useful-commands)

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

[<< Previous Section](#application-structure) | [Content Table](#table-of-contents) | [Next Section >>](#none)

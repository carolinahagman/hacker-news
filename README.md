<img src="/public/assets/screenshot/Screenshot 2021-01-14 at 17.20.32.png" width="45%"> 
<img src="/public/assets/screenshot/Screenshot 2021-01-14 at 17.21.17.png" width="45%">

# Hacker News

The assignment was to create a site that works like [Hacker News](https://news.ycombinator.com/)

## Built With

- PHP
- HTML
- TailwindCSS
- Sqlite
- Javascript

<details><summary>Features</summary>

- [x] As a user I should be able to create an account.

- [x] As a user I should be able to login.

- [x] As a user I should be able to logout.

- [x] As a user I should be able to edit my account email, password and biography.

- [x] As a user I should be able to upload a profile avatar image.

- [x] As a user I should be able to create new posts with title, link and description.

- [x] As a user I should be able to edit my posts.

- [x] As a user I should be able to delete my posts.

- [x] As a user I'm able to view most upvoted posts.

- [x] As a user I'm able to view new posts.

- [x] As a user I should be able to upvote posts.

- [x] As a user I should be able to remove upvote from posts.

- [x] As a user I'm able to comment on a post.

- [x] As a user I'm able to edit my comments.

- [x] As a user I'm able to delete my comments.

- [x] As a user I'm able to delete my account along with all posts, upvotes and comments.

- [ ] As a user I'm able to reply to comments. (Backlog)

- [ ] As a user I'm able to resetting my password with email. (Working on it)
</details>

<details><summary> Requirements </summary>

- The application should be written in HTML, CSS, JavaScript, SQL and PHP.

- The application should be built using a SQLite database with at least four different tables.

- The application should be pushed to a public repository on [GitHub](https://github.com/).

- The application should be responsive and be built using the method mobile-first.

- The application should be implement secure [hashed passwords](https://secure.php.net/manual/en/function.password-hash.php) when signing up.

- The project should contain the files and directories in the [`resources`](resources) folder in the root of your repository.

- The project should implement an [accessible](https://a11yproject.com/checklist/) [graphical user interface](https://en.m.wikipedia.org/wiki/Graphical_user_interface).

- The project should [declare strict types](https://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration.strict) in files containing only PHP code.

- The project should not include any coding errors, warning or notices.

</details>

## Installation

You need [PHP](https://www.php.net/) to view this project.

Clone the repository to your computer

```
$ git clone https://github.com/carolinahagman/hacker-news.git
```

Start a local server in the command line

```
$ php -S localhost:8000
```

Open the index.php file in your preferred browser

## Author

- Carolina Hagman

## Tested by

- [Reka Madarasz](https://github.com/mreka91)
- [Amanda Fager](https://github.com/amandafager)

## Code Review by

- [Rikard Segerkvist](https://github.com/rikardseg)

<strong>/public/index.php: 14-28</strong> Good idea to use the functionality of switch here to get a good overview
of your different sortingmethods.

<strong>app/users/logout.php: 6</strong>Could be an idea to also use session_unset()
before session_destroy() here, but it's probably not necessary.

<strong>app/users/login.php: 21</strong> Error message might be a little bit misleading, considering
that we're not checking if password is verified until further down on line 28.

<strong>public/create.php: 11-12</strong> Might want to move up "Create account" text along with
ending </ h1> tag so that they are on the same line as opening < h1>.

<strong>public/app/users/editProfile.php</strong> Instead of checking every single input field
you could update all fields in one sql query even if all fields are not changed
to achieve less code, but that's just a thought.

<strong>public/app/users/functions.php: 201</strong> Here the variables in the function
are declared but not used inside of the function, I assume it had
a different purpose originally but now it only returns 1.

<strong>public/app/users/functions.php: 279</strong> and 286 Still two commented diedumps here
used for testing that could be removed now, not a big deal.

<strong>public/assets/custom-styles, tailwind.css</strong> Really nice and clean design on your application!

<strong>public/app/posts/delete.php</strong> Seems like this file isn't
currently being used to delete anything.

<strong>public/app/posts/upvote.php: 19-27</strong> A commented if
statement here that could be removed, but no big deal.

Incredible work on your application, Carolina!
Very clean code, could barely find anything to comment on.

dash; Rikard Segerkvist

## License

This project is licensed under the MIT License - see the LICENSE file for details

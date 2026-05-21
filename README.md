# myMilestone Tracker

A milestone tracker web application built with PHP, MySQL, and simple frontend pages.

## Overview

myMilestone Tracker helps users sign up, sign in, create goals, view a calendar, and track completed milestones over time.

## Main Pages

- `loginPage.php` — Login screen for existing users.
- `Sign Up Page.php` — Registration screen for new users.
- `Milestone Tracker.php` — Home page with navigation and app overview.
- `Goals.php` — Create goals, view existing goals, and mark them complete.
- `Timeline.php` — Shows completed goals in a timeline view.
- `Calender.php` — Displays a monthly calendar view.

## Login and Authentication

The login system is implemented in the `Login-1` folder:

- `Login-1/login.inc.php`
- `Login-1/signup.inc.php`
- `Login-1/LoginAuth.php`
- `Login-1/logout.php`
- `Login-1/dbh.inc.php` — database connection file (ignored by Git)
- `Login-1/config_session.inc.php` — session config file (ignored by Git)

## Database

The app uses a MySQL database and expects at least two tables:

- `registration` — stores registered users
- `goalentries` — stores goal entries, completion state, and dates

Example structure inferred from code:

- `registration`: `Username`, `user_password`, `fname`, etc.
- `goalentries`: `goal_id`, `Username`, `entries`, `entryDate`, `completed`

## Setup

1. Copy `Login-1/dbh.inc.php.example` to `Login-1/dbh.inc.php`.
2. Set your local database credentials in `Login-1/dbh.inc.php`.
3. Copy `Login-1/config_session.inc.php.example` to `Login-1/config_session.inc.php`.
4. Start your local PHP server or place the project into your web server root.
5. Create the database and the required tables.
6. Open `loginPage.php` in your browser to register and log in.

## Styles and Assets

- CSS files are stored in `StyleSheets/`
- Images are stored in `Images/`

## Notes

- Sensitive local config files are excluded from Git via `.gitignore`.
- Use the `.example` files to keep environment-specific settings out of source control.
- `create_goal.php` handles adding new goals, and `GoalCompleted.php` updates completion status.


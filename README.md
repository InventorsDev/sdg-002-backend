# MedTime ⏰ (Backend)

[![BuildAndTest](https://github.com/InventorsDev/sdg-002-backend/actions/workflows/BuildAndTest.yml/badge.svg)](https://github.com/InventorsDev/sdg-002-backend/actions/workflows/BuildAndTest.yml)


A web/mobile app that:

- Helps people set reminders to take their drugs

- Detect fall via mobile device API, and prompt the user asking if they are okay or not....and if the user should not reply within `N minutes/seconds` it should automatically send an SMS to people they have added as their favorite contacts.

  

### Proposed architecture/structure

From the app index page, the user can easily set a reminder to take a particular drug. They get to set:

* The no. of hours they take the drug

* Total no. of days they will be taking the drug. and finally

* The no. of pills they will be taking for each interval

  

And, once its time to take their drug, the user will be reminded (via **push notification**)

  

____

  

***For fall detection***, the user will have the option of selecting maximum of **3 people** from their contact list to set as their *favorite contacts*.

  

And once the app detects a fall from the device, it will prompt the user asking if they are okay or not.

and if the user should not reply within a particular time-frame, all of their favorite contacts will be alerted via **SMS** you along with the last ***recorded location*** of the user.

## Project Setup
`clone repo && cd to project`
Run
``composer install``

copy `.env.example` to `.env`

run `php artisan key:generate`

Setup your database connection in .env

run `php artisan migrate` to migrate



### Connected repo

<strong>Front-end</strong>  <a  href="https://github.com/InventorsDev/sdg-002">sdg-002</a>
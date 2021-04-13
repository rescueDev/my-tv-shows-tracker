# My Tv Tracker

Track your favourite tv-shows progress

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

##### work in progress...

## General info

### Login/Register user first
<p>You can register multiple users and log each one</p>

### Profile
<p>User dashboard with personal information and avatar upload option</p>

### Progress
<p>In this section will be visible all tv-shows in progress, you can delete or check as watched the single show.
    Clicking on each one you can see all show details, seasons and episodes.  
</p>

### Watched
<p>All watched show are displayed here</p>

### Discover
<p>In this section you can search for any tv show, add one to your progress.</p>

## Setup

1) Clone this repository
`````
git clone 
`````
2) enter folder
 `````
cd my-tv-show-tracker
``````
3)check .env file and type your DBMS password 

<br>

4)Create a new database named my-tv-show-tracker in PhpMyAdmin or other 

<br>

5)Run migration from terminal 


````    php artisan migrate --refresh ````

6) Start backend server and frontend

   `````
    php artisan serve
    
    npm run watch
    ``````
    <br>
7) Open your browser and go to localhost:8000 or other port number you previously set.



## Technologies
Project is created with:
* Laravel 7
* Php: 7.4.13
* VueJs: 2.6

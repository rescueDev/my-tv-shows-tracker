# My Tv Tracker

Track your favourite tv-shows progress

## Table of contents
* [General info](#general-info)
* [Setup](#setup)
* [Technologies](#technologies)


##### the project is still in progress...

## General info

### Login/Register user first
You can register multiple users and log each one

### Profile
User dashboard with personal information and avatar upload option

### Progress
In this section will be visible all tv-shows in progress, you can delete or check as watched the single show.
Clicking on each one you can see all show details, seasons and episodes.  


### Watched
All watched show are displayed here.

### Discover
In this section you can search for any tv show, add one to your progress.

## Setup

1) Clone this repository:
`````
git clone https://github.com/sa-borgia3/my-tv-shows-tracker.git
`````
2) enter folder
 `````
cd my-tv-show-tracker
``````
3) Rename .envcopy file to .env and add your TMDB api key to MIX_VUE_APP_TMDB_KEY (register one if you don't have it).

<br>

4) Create a new database named my-tv-show-tracker in PhpMyAdmin or other. 

<br>

5) Run migration from terminal: 

````
    php artisan migrate --refresh
````

6) Start backend server and frontend.

 ````
    php artisan serve
    
    npm run dev && npm run watch 
    
 ````
 
7) Open your browser and go to localhost:8000 or other port number you previously set.



## Technologies
Project is created with:
* Laravel: 7.30.4
* Php: 7.4.13
* VueJs: 2.6.12
* The Movie Db API: 3


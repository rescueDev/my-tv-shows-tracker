# My Tv Tracker

<p> Track your favourite tv-shows progress</p>

<h1>Login/Register user first</h1>
<p>You can register multiple users and log each one</p>

<h1>Profile</h1>
<p>User dashboard with personal information and avatar upload option</p>

<h1>Progress</h1>
<p>In this section will be visible all tv-shows in progress, you can delete or check as watched the single show.
    Clicking on each one you can see all show details, seasons and episodes.  
</p>

<h1>Discover</h1>
<p>In this section you can search for any tv show, add one to your progress.</p>

<strong>Installation</strong>

1) Clone this repository
`````
git clone 
`````
2) enter folder
 `````
cd my-tv-show-tracker
``````
3)check .env file and type your DBMS password
4)Create a new database named my-tv-show-tracker in PhpMyAdmin or other
5)Run migration from terminal 
    php artisan migrate --refresh

6) Start backend server and frontend

   `````
    php artisan serve
    
    npm run watch
    ``````
7) Open your browser and go to localhost:8000 or other port number you previously set.



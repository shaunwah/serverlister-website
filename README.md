# ServerLister

NOTE: I built this as a personal project of mine and it's pretty much unfinished. Use at your own risk! I may do a rewrite in the future.

The Minecraft server list project. ServerLister is a website that allows anyone to list and advertise their own Minecraft server publicly. Its features include:

* Self-service server verification for owners
* Built-in ReCAPTCHA protection
* Better server ranking system
* User-first design

## Setup Guide
1. Clone **.env* to get started.
2. Use **php artisan migrate** and **php artisan db:populate** to set up the database.
3. Create a symbolic link from 'public/storage' to 'storage/app/public' by typing **php artisan storage:link**
4. Finally, add the **php artisan schedule:run** to Cron jobs.

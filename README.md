# ServerLister
The Minecraft server list project

## Step 1
Before doing anything, type **php artisan migrate** and **php artisan db:populate** to set up the database.

## Step 2
Create a symbolic link from 'public/storage' to 'storage/app/public' by typing **php artisan storage:link**

## Step 3
Finally, add the **php artisan schedule:run** to Cron jobs.

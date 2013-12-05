livestagram
===========

Instagram real-time feed built on CodeIgniter.

I wanted to quickly build an application in PHP that can display a live feed of Instagram photos based on a specific hashtag. I set up an Instagram Subscription to a hashtag, and when Instagram hits my callback page, I search for new photos with the tag and enter them in my database. On the frontend page I'm using AJAX long polling of my server to check for new data.

This application allows for an adminstrator to "ban" photos using a simple admin panel. The admin panel receives a live feed from Instagram with virtually no delay, and the frontend page has a 2 minute delay.

This project was built as a subdirectory to a website, so it would be yoursite.com/livestagram. Obviously this can be changed to be a root directory. 


Update 12.04.2013  
-------------------------  

I realized I forgot a few things when I first committed, namely the htaccess file for mod rewrite of the index page. I also fixed some issues with the Subscribe model that wasn't loading properly because of some syntax issues.

** If you can't get the .htaccess file to work, then just append index.php to the URL, like http://yoursite.com/livestagram/index.php/install/ 


Live Demonstration with hashtag #superman  
-------------------------  

Frontend:  
http://markgoldsmith.me/livestagram/   

Admin:  
http://markgoldsmith.me/livestagram/admin/login/  
User: admin  
Pass: password***  


Steps to get the app going  
-------------------------------  
To install the database tables:  
http://yoursite.com/livestagram/install/  

To create an Instagram client  
http://instagram.com/developer/clients/manage/

To set the configuration for your Instagram client  
Modify application/config/Instagram_api.php, add the credentials from the Instagram client page 

To authenticate your Instagram account:  
http://yoursite.com/livestagram/connect/  

To set up a new hashtag:  
http://yoursite.com/livestagram/subscribe/  



Helpful tips  
-------------------------------  
// Check your hashtag subscriptions  
GET https://api.instagram.com/v1/subscriptions?client_secret=CLIENT-SECRET&client_id=CLIENT-ID  
This is easy to do in the Instagram API console - http://instagram.com/developer/api-console/  

// To delete all hashtags subscriptions  
DELETE https://api.instagram.com/v1/subscriptions?client_secret=CLIENT-SECRET&object=all&client_id=CLIENT-ID  
In API console - http://instagram.com/developer/api-console/  

// Read more about Instagram Real-time photo updates here:  
http://instagram.com/developer/realtime/  


Special thanks  
-------------------------------  
Thanks to the developers of these libraries which I utilized:  
Slides JS - https://github.com/nathansearles/Slides  
CodeIgniter Instagram Library - https://github.com/ianckc/CodeIgniter-Instagram-Library  
Clear Admin for simple admin panel to moderate photos - https://github.com/antonrodin/Clear-Admin

Special thanks to Greg Thompson for his helpful blog post:  
http://thegregthompson.com/instagram-real-time-api-php/

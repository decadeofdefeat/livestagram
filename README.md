livestagram
===========

Instagram real-time feed built on CodeIgniter.

I wanted to quickly build an application in PHP that can display a live feed of Instagram photos based on a specific hashtag. I set up an Instagram Subscription to a hashtag, and when Instagram hits my callback page, I search for new photos with the tag and enter them in my database. On the frontend page I'm using AJAX long polling of my server to check for new data.

This application allows for an adminstrator to "ban" photos using a simple admin panel. The admin panel receives a live feed from Instagram with virtually no delay, and the frontend page has a 2 minute delay.

This project was built as a subdirectory to a website, so it would be yoursite.com/livestagram. Obviously this can be changed to be a root directory.  


To install the database tables:  
http://yoursite.com/livestagram/install/  


To set the configuration for your Instagram client  
Modify application/config/Instagram_api.php  


To authenticate your Instagram account:  
http://yoursite.com/livestagram/connect/  


To set up a new hashtag:  
http://yoursite.com/livestagram/subscribe/  


Thanks to the developers of these libraries which I utilized:  
Slides JS - https://github.com/nathansearles/Slides  
CodeIgniter Instagram Library - https://github.com/ianckc/CodeIgniter-Instagram-Library  
Clear Admin for simple admin panel to moderate photos - https://github.com/antonrodin/Clear-Admin

Special thanks to Greg Thompson for his helpful blog post:  
http://thegregthompson.com/instagram-real-time-api-php/

livestagram
===========

Instagram real time feed built on CodeIgniter.

I wanted to quickly build an application in PHP that can display a live feed of Instagram photos based on a specific hashtag. I set up an Instagram Subscription to a hashtag, and when Instagram hits my callback page, I search for new photos with the tag and enter them in my database. On the frontend page I'm using AJAX long polling of my server to check for new data.

My project was built as a subdirectory to a website, so it would be yoursite.com/livestagram
To authenticate your Instagram account:
http://yoursite.com/livestagram/connect/

To set up a new hashtag:
http://yoursite.com/livestagram/subscribe/

Thanks to the writers of these libraries which I utilized:
Slides JS for the photo slider - https://github.com/nathansearles/Slides
CodeIgnither Instagram Library - https://github.com/ianckc/CodeIgniter-Instagram-Library
Clear Admin for simple admin panel to moderate photos - https://github.com/antonrodin/Clear-Admin


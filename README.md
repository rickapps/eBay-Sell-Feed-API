# eBay-Sell-Feed-API
Demonstrates how to programmatically upload a file to eBay and get the results using eBay's new **Sell Feed API** replacement for FileExchange. 

To use this code in your PHP project, you only need two files:

*application/eBayRepository.php*  
*application/conf/PHPConstants.php*  

`<?php`   
    `$eBayRep = new eBayRepository(YourAuthorizationCode, YourRefreshToken);`   
    `$taskID = $eBayRep->sendToEbay('FileYouWantToUpload');`    
    `$json = $eBayRep->getResults($taskID);`      
`?>`  

These four eBay API calls are utilized:

[createTask](https://developer.ebay.com/api-docs/sell/feed/resources/task/methods/createTask)

[uploadFile](https://developer.ebay.com/api-docs/sell/feed/resources/task/methods/uploadFile)

[getTask](https://developer.ebay.com/api-docs/sell/feed/resources/task/methods/getTask)

[0Auth2/token](https://developer.ebay.com/api-docs/static/oauth-refresh-token-request.html)

## Installation
1. Install [curl](https://curl.se) on your machine if not already installed.
2. Ensure folder /public_html is browsable on your webserver.
3. Set permissions on /public_html/export so your webserver can write to it.
4. Set permissions in php.ini so the application can upload files. 
5. Edit the file PHPConstants. You only need to generate an authorization code once. Instructions can be found here. You will need to generate a refresh token about every 18 months. Instructions can be found here. Your values are specific to the eBay sandbox and the eBay production environments.




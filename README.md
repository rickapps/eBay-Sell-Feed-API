# eBay-Sell-Feed-API
Demonstrates how to upload a file to eBay and get the results using eBay's new **Sell Feed API** replacement for FileExchange. 

To use this code in your PHP project, you only need two files:

*application/eBayRepository.php*  
*application/conf/PHPConstants.php*  

`<?php`   
    `$eBayRep = new eBayRepository(YourAuthorizationCode, YourRefreshToken);`   
    `$taskID = $eBayRep->sendToEbay('FileYouWantToUpload');`    
    `$json = $eBayRep->getResults($taskID);`      
`?>`  

These four eBay API calls are utilized: [createTask](https://developer.ebay.com/api-docs/sell/feed/resources/task/methods/createTask), [uploadFile](https://developer.ebay.com/api-docs/sell/feed/resources/task/methods/uploadFile), 
[getTask](https://developer.ebay.com/api-docs/sell/feed/resources/task/methods/getTask), and [0Auth2/token](https://developer.ebay.com/api-docs/static/oauth-refresh-token-request.html)

## Notes
Many csv files that work fine on eBay's production environment will be marked 'Failed' in the sandbox environment. Don't waste time trying to debug export file structure in the sandbox. Make use of the action *VerifyAdd* to avoid accruing listing fees in the production environment.

eBay does not list csv files marked 'Failed' on the *Upload History* page in *My eBay*.

eBay API will often mark a file that contains an invalid category id as 'Failed' and offer no error message to explain why.

eBay's API documentation for *uploadFile* says to use option 'fileName' to specify the file you want to upload. This always gave me errors. I changed the option to 'file' and it started working.

In the production environment, you will get timed out if you make too many createTask calls in a short time period. If this happens, wait one hour before trying again. The timeout does not seem to apply to the sandbox environment.

Use [Postman](https://postman.com) to help with debugging API calls. It will make your work much easier.  It provides more helpful options than the [API Explorer](https://developer.ebay.com/my/api_test_tool?index=0) in eBay Developer tools. 

## Installation

To run the website:
1. Install [curl](https://curl.se) on your machine if not already installed.
2. Ensure the project folder */public_html* is browsable on your webserver.
3. Set permissions on */public_html/export* so your webserver can write to it.
4. Set permissions in php.ini so the application can upload files. 
5. Edit the file *PHPConstants*. You only need to generate an authorization code once. Instructions can be found [here](https://developer.ebay.com/api-docs/static/oauth-base64-credentials.html). You will need to generate a refresh token about every 18 months. Instructions can be found [here](https://gist.github.com/rickapps/1be821cd515f8cc946f292b715f893db). Your values are specific to the eBay sandbox and the eBay production environments.

![Screenshot 1](/docs/images/feedAPI_1.png)
![Screenshot 2](/docs/images/feedAPI_2.png)
![Screenshot 3](/docs/images/feedAPI_3.png)






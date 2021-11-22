<?php
/**********************************************
 * @author RickApps
 * @link https://github.com/rickapps/eBay-Sell-Feed-API
 * @license http://opensource.org/licenses/MIT MIT License
***********************************************/

class eBayrepository 
{
    private $token;
    private $tokenExpires;
    private $authorization;
    private $refreshToken;
    
    public function __construct(string $auth, string $refresh)
    {
        $this->authorization = $auth;
        $this->refreshToken = $refresh;
    }

    // Return true if status code < 400.
    // Only use on curl commands that imploy -i option.
    public function headerOK($headers)
    {
        $status = 0;
        if (is_array($headers))
        {
            $response = explode(' ', $headers[0], 3);
            if (count($response) > 2)
            {
                $status = intval($response[1]);    
            }
        }
        return $status > 0 && $status < 400; 
    }

    // Obtain a specified value from an http header array.
    // The status code is stored under key 'Status'. Curl only
    // returns header information if you use the -i or -v options.
    public function parseHeaders($headers, $key)
    {
        // Define the $response_headers array for later use
        $response_headers = [];

        // Get the first line (The Status Code)
        $size = count($headers);
        $response_headers['Status'] = 'None';
        if ($size > 0) {
            $response_headers['Status'] = trim($headers[0]);
        }
        // Last item is blank so we ignore it.
        for ($i = 1; $i < $size-1; $i++) 
        {
            $matches = explode(":", $headers[$i], 2);
            $response_headers["{$matches[0]}"] = trim($matches[1]);
        }
        $value = 'Unknown';
        // Did we find our key? Don't need to parse entire $headers,
        // but code is here for future in case we want to store array.
        if (isset($response_headers[$key])) {
            $value = $response_headers[$key];
        }
        return $value;
    }

    // User token is obtained using developer's AppID:CertID and a refresh token.
    // A token expires in about two hours. Refresh tokens are stored in database and last about a year.
    public function getUserToken()
    {
        $token = 'unknown';
        // Do we already have a valid token?
        if (isset($_SESSION['UToken']) && $_SESSION['UExpire'] > time())
        {
            $token = $_SESSION['UToken'];
        }
        else {
            // Use cURL program to obtain a token
            unset($out);
            $cmdOptions = ' -sS -X POST https://api.ebay.com/identity/v1/oauth2/token '
                . '-H "Content-Type: application/x-www-form-urlencoded" '
                . '-H "Authorization: Basic ' . $this->authorization . '" '
                . '-d "grant_type=refresh_token" '
                . '-d "refresh_token=' . urlencode($this->refreshToken) . '" '
                . '-d "scope=' . urlencode('https://api.ebay.com/oauth/api_scope/sell.inventory') . '"';
            // Do not use escapeshellarg() here. It really messes up your command line.
            exec(CURL_PGM . $cmdOptions . " 2>&1", $out, $status);
            $expires = 0;
            $val = '';
            if ($status == 0) 
            {
                $val = json_decode($out[0]);
                $token = $val->access_token;
                $expires = $val->expires_in;
                $_SESSION['UToken'] = $token;
                // Expire our token two minutes before it actually does
                // Currently a token lasts two hours.
                $_SESSION['UExpire'] = time() + $expires - 120;
            }
            else
            {
                // Should raise an exception here
                print_r($out);
            }
        }
        return $token;
    }

    // Get the task id needed to upload files 
    public function getTaskID($token)
    {
        unset($out);
        $options = " -sS -i -X POST https://api.ebay.com/sell/feed/v1/task";
        $headers = ' -H "X-EBAY-C-MARKETPLACE-ID:EBAY_US" '
                  . '-H "Content-Type: application/json" '
                  . '-H "Accept: application/json" '
                  . '-H "Authorization:Bearer ' . $token . '"';

        $body = ' --data-raw "{ \"feedType\" : \"FX_LISTING\", \"schemaVersion\" : \"1.0\" }"';
        // Create a request
        $request = CURL_PGM . $options . $headers . $body . " 2>&1";
        exec($request, $out, $status);

        $location = 'unknown';
        if ($this->headerOK($out))
        {
            $location = $this->parseHeaders($out, 'location');
        }
        else
        {
            error_log("Error in getTaskID");
            error_log(implode(" ", $out));
            throw new Exception("GetTaskID failed\r\n" . $out[0]);  

        }
        return $location;
    } 

    public function uploadFile($token, $task, $fileName)
    {
        if (WINDOWS)
        {
            // Bugger up the file name. Windows likes it. Gets really upset if you don't.
            $fileName = str_replace('/', '\\', $fileName);
        }
        unset($out);
        $fmt = '%s/upload_file';
        $cmd = sprintf($fmt, $task);
        $options = " -sS -i -X POST ";
        $headers = ' -H "Authorization:Bearer ' . $token . '"';
        $body = ' --form \'file=@"' . $fileName . '"\' '
               . '--form \'name="file"\' ' 
               . '--form \'type="form-data"\'';

        if (WINDOWS)
        {
            // Windows cmd does not deal well with single quotes. We must escape all
            // double quotes, then convert our single quotes to double quotes.
            $body = str_replace('"', '\\"', $body);
            $body = str_replace('\'', '"', $body);
        }
        // Create a request
        exec(CURL_PGM . $options . $cmd . $headers . $body . " 2>&1", $out, $status);
        if ($status > 0 || !$this->headerOK($out))
        {
            error_log("uploadFile failed");
            error_log(implode(" ", $out));
            error_log(CURL_PGM . $options . $cmd . $headers . $body . " 2>&1");
            throw new Exception("uploadFile failed");
        }

        return $out;
    }

    public function getUploadStatus($token, $location)
    {
        unset($out);
        $options = " -sS -i -X GET ";
        $headers = ' -H "Content-Type: application/json" '
                  . '-H "Accept: application/json" '
                  . '-H "Authorization:Bearer ' . $token . '"';
        // Create a request
        exec(CURL_PGM . $options . $location . $headers . " 2>&1", $out, $status);
        if ($status > 0 || !$this->headerOK($out))
        {
            error_log("getUploadStatus failed");
            error_log(implode(' ', $out));
            throw new Exception("getUploadStatus failed");
        }
        // If there were no errors, the body should be in the last element of the array
        return $out[count($out)-1];
    }
}
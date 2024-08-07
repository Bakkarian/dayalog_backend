<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dayalog API Usage</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
                    body .content .python-example code { display: none; }
            </style>


    <script src="{{ asset("/vendor/scribe/js/theme-default-4.35.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                                            <button type="button" class="lang-button" data-language-name="python">python</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Handle user registation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-tokens-create">
                                <a href="#authentication-POSTapi-tokens-create">Generate Authorization token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-forgot-password">
                                <a href="#authentication-POSTapi-forgot-password">Handle an incoming password reset link request.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-reset-password">
                                <a href="#authentication-POSTapi-reset-password">Handle an incoming new password request.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-verify-email--id---hash-">
                                <a href="#authentication-GETapi-verify-email--id---hash-">Mark the authenticated user's email address as verified.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-email-verification-notification">
                                <a href="#authentication-POSTapi-email-verification-notification">Send a new email verification notification.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                                <a href="#authentication-POSTapi-logout">Destroy an authenticated session.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-devices" class="tocify-header">
                <li class="tocify-item level-1" data-unique="devices">
                    <a href="#devices">Devices</a>
                </li>
                                    <ul id="tocify-subheader-devices" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="devices-GETapi-devices">
                                <a href="#devices-GETapi-devices">Display a listing of the devices.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="devices-POSTapi-devices">
                                <a href="#devices-POSTapi-devices">Add a new device.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="devices-GETapi-devices--id-">
                                <a href="#devices-GETapi-devices--id-">Get information on a device</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="devices-PUTapi-devices--id-">
                                <a href="#devices-PUTapi-devices--id-">Update the specified device.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="devices-DELETEapi-devices--id-">
                                <a href="#devices-DELETEapi-devices--id-">Remove the specified device.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-dispatch" class="tocify-header">
                <li class="tocify-item level-1" data-unique="dispatch">
                    <a href="#dispatch">Dispatch</a>
                </li>
                                    <ul id="tocify-subheader-dispatch" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="dispatch-GETapi-dispatches">
                                <a href="#dispatch-GETapi-dispatches">Display a listing of the resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dispatch-POSTapi-dispatches">
                                <a href="#dispatch-POSTapi-dispatches">Store a newly created resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dispatch-GETapi-dispatches--id-">
                                <a href="#dispatch-GETapi-dispatches--id-">Display the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dispatch-PUTapi-dispatches--id-">
                                <a href="#dispatch-PUTapi-dispatches--id-">Update the specified resource in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dispatch-DELETEapi-dispatches--id-">
                                <a href="#dispatch-DELETEapi-dispatches--id-">Remove the specified resource from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dispatch-PUTapi-dispatches--dispatch_id--status--newStatus-">
                                <a href="#dispatch-PUTapi-dispatches--dispatch_id--status--newStatus-">Change status of a dispatch</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-drivers" class="tocify-header">
                <li class="tocify-item level-1" data-unique="drivers">
                    <a href="#drivers">Drivers</a>
                </li>
                                    <ul id="tocify-subheader-drivers" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="drivers-GETapi-drivers">
                                <a href="#drivers-GETapi-drivers">Display a listing of the drivers.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="drivers-POSTapi-drivers">
                                <a href="#drivers-POSTapi-drivers">Store a newly created drivers.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="drivers-GETapi-drivers--id-">
                                <a href="#drivers-GETapi-drivers--id-">Display the specified resource.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="drivers-PUTapi-drivers--id-">
                                <a href="#drivers-PUTapi-drivers--id-">Update the specified driver.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="drivers-DELETEapi-drivers--id-">
                                <a href="#drivers-DELETEapi-drivers--id-">Remove driver from the system.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="drivers-POSTapi-drivers--driver_id--vehicles--vehicle_id-">
                                <a href="#drivers-POSTapi-drivers--driver_id--vehicles--vehicle_id-">Assign Vehicle to Driver</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="drivers-DELETEapi-drivers--driver_id--vehicles--vehicle_id-">
                                <a href="#drivers-DELETEapi-drivers--driver_id--vehicles--vehicle_id-">Remove Vehicle from Driver</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-orders" class="tocify-header">
                <li class="tocify-item level-1" data-unique="orders">
                    <a href="#orders">Orders</a>
                </li>
                                    <ul id="tocify-subheader-orders" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="orders-GETapi-orders">
                                <a href="#orders-GETapi-orders">Display a listing of the orders.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-POSTapi-orders">
                                <a href="#orders-POSTapi-orders">Add an order to the system</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-GETapi-orders--id-">
                                <a href="#orders-GETapi-orders--id-">Get all details of an order</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-PUTapi-orders--id-">
                                <a href="#orders-PUTapi-orders--id-">Update Update order details.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-DELETEapi-orders--id-">
                                <a href="#orders-DELETEapi-orders--id-">Delete an order.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-POSTapi-orders--order_id--vehicle--vehicle_id-">
                                <a href="#orders-POSTapi-orders--order_id--vehicle--vehicle_id-">Attach Vehicle to an order</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-DELETEapi-orders--order_id--vehicle--vehicle_id-">
                                <a href="#orders-DELETEapi-orders--order_id--vehicle--vehicle_id-">Detach Vehicle from an order</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="orders-PUTapi-orders--order_id--status--newStatus-">
                                <a href="#orders-PUTapi-orders--order_id--status--newStatus-">Change Order status</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-users" class="tocify-header">
                <li class="tocify-item level-1" data-unique="users">
                    <a href="#users">Users</a>
                </li>
                                    <ul id="tocify-subheader-users" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="users-GETapi-user">
                                <a href="#users-GETapi-user">GET api/user</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-vehicles" class="tocify-header">
                <li class="tocify-item level-1" data-unique="vehicles">
                    <a href="#vehicles">Vehicles</a>
                </li>
                                    <ul id="tocify-subheader-vehicles" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="vehicles-GETapi-vehicles">
                                <a href="#vehicles-GETapi-vehicles">Display a listing of the vehicles.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vehicles-POSTapi-vehicles">
                                <a href="#vehicles-POSTapi-vehicles">Add vehicle to the system</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vehicles-GETapi-vehicles--id-">
                                <a href="#vehicles-GETapi-vehicles--id-">Get vehicle details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vehicles-PUTapi-vehicles--id-">
                                <a href="#vehicles-PUTapi-vehicles--id-">Update vehicle information.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vehicles-DELETEapi-vehicles--id-">
                                <a href="#vehicles-DELETEapi-vehicles--id-">Delete a vehicle.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vehicles-PUTapi-vehicles--vehicle--attach-device">
                                <a href="#vehicles-PUTapi-vehicles--vehicle--attach-device">Attach device to a vehicle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vehicles-PUTapi-vehicles--vehicle_id--detach-devices">
                                <a href="#vehicles-PUTapi-vehicles--vehicle_id--detach-devices">Remove devices attached to a vehicle.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                        <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 4, 2024</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Documentation for dayalog api</p>
<aside>
    <strong>Base URL</strong>: <code>https://dayalog.co</code>
</aside>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-register">Handle user registation</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"vvwegqytmu\",
    \"email\": \"luettgen.daphney@example.com\",
    \"patasente_id\": \"architecto\",
    \"phone_number\": \"voluptatem\",
    \"password\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "vvwegqytmu",
    "email": "luettgen.daphney@example.com",
    "patasente_id": "architecto",
    "phone_number": "voluptatem",
    "password": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/register';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'vvwegqytmu',
            'email' =&gt; 'luettgen.daphney@example.com',
            'patasente_id' =&gt; 'architecto',
            'phone_number' =&gt; 'voluptatem',
            'password' =&gt; 'consequatur',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/register'
payload = {
    "name": "vvwegqytmu",
    "email": "luettgen.daphney@example.com",
    "patasente_id": "architecto",
    "phone_number": "voluptatem",
    "password": "consequatur"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 26
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Registered successfully&quot;,
    &quot;user&quot;: {
        &quot;name&quot;: &quot;vvwegqytmu&quot;,
        &quot;email&quot;: &quot;luettgen.daphney@example.com&quot;,
        &quot;patasente_id&quot;: &quot;architecto&quot;,
        &quot;phone_number&quot;: &quot;voluptatem&quot;,
        &quot;updated_at&quot;: &quot;2024-05-04T19:55:44.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-05-04T19:55:44.000000Z&quot;,
        &quot;id&quot;: 5
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="vvwegqytmu"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vvwegqytmu</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="luettgen.daphney@example.com"
               data-component="body">
    <br>
<p>This field is required when none of <code>phone_number</code> and <code>patasente_id</code> are present.  Must be a valid email address. Must not be greater than 255 characters. Example: <code>luettgen.daphney@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patasente_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="patasente_id"                data-endpoint="POSTapi-register"
               value="architecto"
               data-component="body">
    <br>
<p>TODO : rename to patasente merchant code. This field is required when none of <code>email</code> and <code>phone_number</code> are present. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-register"
               value="voluptatem"
               data-component="body">
    <br>
<p>This field is required when none of <code>email</code> and <code>patasente_id</code> are present. Example: <code>voluptatem</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-tokens-create">Generate Authorization token.</h2>

<p>
</p>



<span id="example-requests-POSTapi-tokens-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/tokens/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_id\": \"consectetur\",
    \"password\": \"2f3(h\'\",
    \"token_name\": \"quis\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/tokens/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": "consectetur",
    "password": "2f3(h'",
    "token_name": "quis"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/tokens/create';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'user_id' =&gt; 'consectetur',
            'password' =&gt; '2f3(h\'',
            'token_name' =&gt; 'quis',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/tokens/create'
payload = {
    "user_id": "consectetur",
    "password": "2f3(h'",
    "token_name": "quis"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-tokens-create">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 25
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;These credentials do not match our records.&quot;,
    &quot;errors&quot;: {
        &quot;user_id&quot;: [
            &quot;These credentials do not match our records.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-tokens-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tokens-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tokens-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tokens-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tokens-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tokens-create" data-method="POST"
      data-path="api/tokens/create"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tokens-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tokens/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tokens-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tokens-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="POSTapi-tokens-create"
               value="consectetur"
               data-component="body">
    <br>
<p>Example: <code>consectetur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-tokens-create"
               value="2f3(h'"
               data-component="body">
    <br>
<p>Example: <code>2f3(h'</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token_name"                data-endpoint="POSTapi-tokens-create"
               value="quis"
               data-component="body">
    <br>
<p>Example: <code>quis</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-forgot-password">Handle an incoming password reset link request.</h2>

<p>
</p>



<span id="example-requests-POSTapi-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/forgot-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"dkoepp@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "dkoepp@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/forgot-password';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'dkoepp@example.com',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/forgot-password'
payload = {
    "email": "dkoepp@example.com"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-forgot-password">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 24
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;We can&#039;t find a user with that email address.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;We can&#039;t find a user with that email address.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-forgot-password" data-method="POST"
      data-path="api/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-forgot-password"
               value="dkoepp@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>dkoepp@example.com</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-reset-password">Handle an incoming new password request.</h2>

<p>
</p>



<span id="example-requests-POSTapi-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"token\": \"in\",
    \"email\": \"cartwright.mireille@example.net\",
    \"password\": \"qui\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "in",
    "email": "cartwright.mireille@example.net",
    "password": "qui"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/reset-password';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'token' =&gt; 'in',
            'email' =&gt; 'cartwright.mireille@example.net',
            'password' =&gt; 'qui',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/reset-password'
payload = {
    "token": "in",
    "email": "cartwright.mireille@example.net",
    "password": "qui"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-reset-password">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 23
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The password field confirmation does not match. (and 1 more error)&quot;,
    &quot;errors&quot;: {
        &quot;password&quot;: [
            &quot;The password field confirmation does not match.&quot;,
            &quot;The password field must be at least 8 characters.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reset-password" data-method="POST"
      data-path="api/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-reset-password"
               value="in"
               data-component="body">
    <br>
<p>Example: <code>in</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-reset-password"
               value="cartwright.mireille@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>cartwright.mireille@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-reset-password"
               value="qui"
               data-component="body">
    <br>
<p>Example: <code>qui</code></p>
        </div>
        </form>

                    <h2 id="authentication-GETapi-verify-email--id---hash-">Mark the authenticated user&#039;s email address as verified.</h2>

<p>
</p>



<span id="example-requests-GETapi-verify-email--id---hash-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/verify-email/dicta/accusantium" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/verify-email/dicta/accusantium"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/verify-email/dicta/accusantium';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/verify-email/dicta/accusantium'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-verify-email--id---hash-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-verify-email--id---hash-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-verify-email--id---hash-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-verify-email--id---hash-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-verify-email--id---hash-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-verify-email--id---hash-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-verify-email--id---hash-" data-method="GET"
      data-path="api/verify-email/{id}/{hash}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-verify-email--id---hash-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/verify-email/{id}/{hash}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-verify-email--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-verify-email--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-verify-email--id---hash-"
               value="dicta"
               data-component="url">
    <br>
<p>The ID of the verify email. Example: <code>dicta</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>hash</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hash"                data-endpoint="GETapi-verify-email--id---hash-"
               value="accusantium"
               data-component="url">
    <br>
<p>Example: <code>accusantium</code></p>
            </div>
                    </form>

                    <h2 id="authentication-POSTapi-email-verification-notification">Send a new email verification notification.</h2>

<p>
</p>



<span id="example-requests-POSTapi-email-verification-notification">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/email/verification-notification" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/email/verification-notification"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/email/verification-notification';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/email/verification-notification'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-email-verification-notification">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-email-verification-notification" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-email-verification-notification"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-email-verification-notification"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-email-verification-notification" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-email-verification-notification">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-email-verification-notification" data-method="POST"
      data-path="api/email/verification-notification"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-email-verification-notification', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/email/verification-notification</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-email-verification-notification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-email-verification-notification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-logout">Destroy an authenticated session.</h2>

<p>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/logout';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="devices">Devices</h1>

    

                                <h2 id="devices-GETapi-devices">Display a listing of the devices.</h2>

<p>
</p>



<span id="example-requests-GETapi-devices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/devices" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/devices"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/devices';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/devices'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-devices">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 49,
            &quot;name&quot;: &quot;Solomon&quot;,
            &quot;uniqueid&quot;: &quot;265412&quot;,
            &quot;lastupdate&quot;: &quot;2023-10-20 19:15:22&quot;,
            &quot;positionid&quot;: 29323,
            &quot;groupid&quot;: null,
            &quot;attributes&quot;: &quot;{}&quot;,
            &quot;phone&quot;: null,
            &quot;model&quot;: &quot;Phone Model&quot;,
            &quot;contact&quot;: null,
            &quot;category&quot;: null,
            &quot;disabled&quot;: 0,
            &quot;status&quot;: &quot;offline&quot;,
            &quot;geofenceids&quot;: null,
            &quot;expirationtime&quot;: null,
            &quot;motionstate&quot;: 0,
            &quot;motiontime&quot;: null,
            &quot;motiondistance&quot;: 0,
            &quot;overspeedstate&quot;: 0,
            &quot;overspeedtime&quot;: null,
            &quot;overspeedgeofenceid&quot;: 0,
            &quot;motionstreak&quot;: 0,
            &quot;lastPosition&quot;: {
                &quot;id&quot;: 29323,
                &quot;protocol&quot;: &quot;osmand&quot;,
                &quot;deviceid&quot;: 49,
                &quot;servertime&quot;: &quot;2023-10-20T16:15:22.000000Z&quot;,
                &quot;devicetime&quot;: &quot;2023-10-20 19:15:18&quot;,
                &quot;fixtime&quot;: &quot;2023-10-20 19:15:18&quot;,
                &quot;valid&quot;: 1,
                &quot;latitude&quot;: 0.3764655,
                &quot;longitude&quot;: 32.6551186,
                &quot;altitude&quot;: 0,
                &quot;speed&quot;: 0,
                &quot;course&quot;: 0,
                &quot;address&quot;: null,
                &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:19.0,\&quot;distance\&quot;:751.12,\&quot;totalDistance\&quot;:53108.43,\&quot;motion\&quot;:false}&quot;,
                &quot;accuracy&quot;: 1500,
                &quot;network&quot;: &quot;null&quot;
            }
        },
        {
            &quot;id&quot;: 50,
            &quot;name&quot;: &quot;Afasha&quot;,
            &quot;uniqueid&quot;: &quot;43989383484834&quot;,
            &quot;lastupdate&quot;: null,
            &quot;positionid&quot;: null,
            &quot;groupid&quot;: null,
            &quot;attributes&quot;: &quot;{}&quot;,
            &quot;phone&quot;: null,
            &quot;model&quot;: &quot;tk340&quot;,
            &quot;contact&quot;: null,
            &quot;category&quot;: null,
            &quot;disabled&quot;: 0,
            &quot;status&quot;: &quot;offline&quot;,
            &quot;geofenceids&quot;: null,
            &quot;expirationtime&quot;: null,
            &quot;motionstate&quot;: 0,
            &quot;motiontime&quot;: null,
            &quot;motiondistance&quot;: 0,
            &quot;overspeedstate&quot;: 0,
            &quot;overspeedtime&quot;: null,
            &quot;overspeedgeofenceid&quot;: 0,
            &quot;motionstreak&quot;: 0,
            &quot;lastPosition&quot;: null
        },
        {
            &quot;id&quot;: 48,
            &quot;name&quot;: &quot;Afasha&quot;,
            &quot;uniqueid&quot;: &quot;835881&quot;,
            &quot;lastupdate&quot;: &quot;2024-03-28 22:09:21&quot;,
            &quot;positionid&quot;: 66949,
            &quot;groupid&quot;: null,
            &quot;attributes&quot;: &quot;{}&quot;,
            &quot;phone&quot;: null,
            &quot;model&quot;: null,
            &quot;contact&quot;: null,
            &quot;category&quot;: null,
            &quot;disabled&quot;: 0,
            &quot;status&quot;: &quot;offline&quot;,
            &quot;geofenceids&quot;: null,
            &quot;expirationtime&quot;: null,
            &quot;motionstate&quot;: 0,
            &quot;motiontime&quot;: &quot;2024-03-28 22:09:20&quot;,
            &quot;motiondistance&quot;: 102575587.22,
            &quot;overspeedstate&quot;: 0,
            &quot;overspeedtime&quot;: null,
            &quot;overspeedgeofenceid&quot;: 0,
            &quot;motionstreak&quot;: 1,
            &quot;lastPosition&quot;: {
                &quot;id&quot;: 66949,
                &quot;protocol&quot;: &quot;osmand&quot;,
                &quot;deviceid&quot;: 48,
                &quot;servertime&quot;: &quot;2024-03-28T19:09:21.000000Z&quot;,
                &quot;devicetime&quot;: &quot;2024-03-28 22:09:20&quot;,
                &quot;fixtime&quot;: &quot;2024-03-28 22:09:20&quot;,
                &quot;valid&quot;: 1,
                &quot;latitude&quot;: 0.3576947,
                &quot;longitude&quot;: 32.5976538,
                &quot;altitude&quot;: 1178,
                &quot;speed&quot;: 0.00365728,
                &quot;course&quot;: 0,
                &quot;address&quot;: null,
                &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:45.0,\&quot;distance\&quot;:0.02,\&quot;totalDistance\&quot;:1.0257558722E8,\&quot;motion\&quot;:false}&quot;,
                &quot;accuracy&quot;: 30,
                &quot;network&quot;: &quot;null&quot;
            }
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://dayalog_api.test/api/devices?page=1&quot;,
        &quot;last&quot;: &quot;http://dayalog_api.test/api/devices?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://dayalog_api.test/api/devices?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://dayalog_api.test/api/devices&quot;,
        &quot;per_page&quot;: 25,
        &quot;to&quot;: 3,
        &quot;total&quot;: 3
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-devices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-devices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-devices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-devices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-devices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-devices" data-method="GET"
      data-path="api/devices"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-devices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/devices</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="devices-POSTapi-devices">Add a new device.</h2>

<p>
</p>



<span id="example-requests-POSTapi-devices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/devices" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"voluptatem\",
    \"uniqueid\": \"bdlgmbxvceofqzf\",
    \"model\": \"omnis\",
    \"tc_user_id\": 457.52519
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/devices"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "voluptatem",
    "uniqueid": "bdlgmbxvceofqzf",
    "model": "omnis",
    "tc_user_id": 457.52519
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/devices';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'voluptatem',
            'uniqueid' =&gt; 'bdlgmbxvceofqzf',
            'model' =&gt; 'omnis',
            'tc_user_id' =&gt; 457.52519,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/devices'
payload = {
    "name": "voluptatem",
    "uniqueid": "bdlgmbxvceofqzf",
    "model": "omnis",
    "tc_user_id": 457.52519
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-devices">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-devices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-devices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-devices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-devices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-devices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-devices" data-method="POST"
      data-path="api/devices"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-devices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/devices</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-devices"
               value="voluptatem"
               data-component="body">
    <br>
<p>Example: <code>voluptatem</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>uniqueid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="uniqueid"                data-endpoint="POSTapi-devices"
               value="bdlgmbxvceofqzf"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>bdlgmbxvceofqzf</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="POSTapi-devices"
               value="omnis"
               data-component="body">
    <br>
<p>Example: <code>omnis</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tc_user_id</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tc_user_id"                data-endpoint="POSTapi-devices"
               value="457.52519"
               data-component="body">
    <br>
<p>Example: <code>457.52519</code></p>
        </div>
        </form>

                    <h2 id="devices-GETapi-devices--id-">Get information on a device</h2>

<p>
</p>



<span id="example-requests-GETapi-devices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/devices/49" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/devices/49"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/devices/49';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/devices/49'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-devices--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 57
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 49,
        &quot;name&quot;: &quot;Solomon&quot;,
        &quot;uniqueid&quot;: &quot;265412&quot;,
        &quot;lastupdate&quot;: &quot;2023-10-20 19:15:22&quot;,
        &quot;positionid&quot;: 29323,
        &quot;groupid&quot;: null,
        &quot;attributes&quot;: &quot;{}&quot;,
        &quot;phone&quot;: null,
        &quot;model&quot;: &quot;Phone Model&quot;,
        &quot;contact&quot;: null,
        &quot;category&quot;: null,
        &quot;disabled&quot;: 0,
        &quot;status&quot;: &quot;offline&quot;,
        &quot;geofenceids&quot;: null,
        &quot;expirationtime&quot;: null,
        &quot;motionstate&quot;: 0,
        &quot;motiontime&quot;: null,
        &quot;motiondistance&quot;: 0,
        &quot;overspeedstate&quot;: 0,
        &quot;overspeedtime&quot;: null,
        &quot;overspeedgeofenceid&quot;: 0,
        &quot;motionstreak&quot;: 0,
        &quot;lastPosition&quot;: {
            &quot;id&quot;: 29323,
            &quot;protocol&quot;: &quot;osmand&quot;,
            &quot;deviceid&quot;: 49,
            &quot;servertime&quot;: &quot;2023-10-20T16:15:22.000000Z&quot;,
            &quot;devicetime&quot;: &quot;2023-10-20 19:15:18&quot;,
            &quot;fixtime&quot;: &quot;2023-10-20 19:15:18&quot;,
            &quot;valid&quot;: 1,
            &quot;latitude&quot;: 0.3764655,
            &quot;longitude&quot;: 32.6551186,
            &quot;altitude&quot;: 0,
            &quot;speed&quot;: 0,
            &quot;course&quot;: 0,
            &quot;address&quot;: null,
            &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:19.0,\&quot;distance\&quot;:751.12,\&quot;totalDistance\&quot;:53108.43,\&quot;motion\&quot;:false}&quot;,
            &quot;accuracy&quot;: 1500,
            &quot;network&quot;: &quot;null&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-devices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-devices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-devices--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-devices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-devices--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-devices--id-" data-method="GET"
      data-path="api/devices/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-devices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/devices/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-devices--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-devices--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-devices--id-"
               value="49"
               data-component="url">
    <br>
<p>The ID of the device. Example: <code>49</code></p>
            </div>
                    </form>

                    <h2 id="devices-PUTapi-devices--id-">Update the specified device.</h2>

<p>
</p>



<span id="example-requests-PUTapi-devices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/devices/49" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/devices/49"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/devices/49';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/devices/49'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-devices--id-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 56
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-devices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-devices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-devices--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-devices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-devices--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-devices--id-" data-method="PUT"
      data-path="api/devices/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-devices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/devices/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/devices/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-devices--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-devices--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-devices--id-"
               value="49"
               data-component="url">
    <br>
<p>The ID of the device. Example: <code>49</code></p>
            </div>
                    </form>

                    <h2 id="devices-DELETEapi-devices--id-">Remove the specified device.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-devices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/devices/49" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/devices/49"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/devices/49';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/devices/49'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-devices--id-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 55
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-devices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-devices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-devices--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-devices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-devices--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-devices--id-" data-method="DELETE"
      data-path="api/devices/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-devices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/devices/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-devices--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-devices--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-devices--id-"
               value="49"
               data-component="url">
    <br>
<p>The ID of the device. Example: <code>49</code></p>
            </div>
                    </form>

                <h1 id="dispatch">Dispatch</h1>

    

                                <h2 id="dispatch-GETapi-dispatches">Display a listing of the resource.</h2>

<p>
</p>



<span id="example-requests-GETapi-dispatches">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/dispatches" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/dispatches"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/dispatches';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/dispatches'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-dispatches">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 32
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;order_vehicle_id&quot;: 1,
            &quot;origin&quot;: &quot;Bukoto Kisasi&quot;,
            &quot;destination&quot;: &quot;Ndeeba&quot;,
            &quot;notes&quot;: &quot;Wabodda&quot;,
            &quot;status&quot;: &quot;transit&quot;,
            &quot;created_at&quot;: &quot;2024-03-28T10:37:24.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-03-28T10:37:41.000000Z&quot;,
            &quot;deleted_at&quot;: null
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://dayalog_api.test/api/dispatches?page=1&quot;,
        &quot;last&quot;: &quot;http://dayalog_api.test/api/dispatches?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://dayalog_api.test/api/dispatches?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://dayalog_api.test/api/dispatches&quot;,
        &quot;per_page&quot;: 25,
        &quot;to&quot;: 1,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dispatches" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dispatches"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dispatches"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dispatches" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dispatches">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dispatches" data-method="GET"
      data-path="api/dispatches"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dispatches', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dispatches</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dispatches"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dispatches"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="dispatch-POSTapi-dispatches">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTapi-dispatches">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/dispatches" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"order_vehicle_id\": \"viayzqdnddztojkvbosmnxx\",
    \"origin\": \"odio\",
    \"destination\": \"doloribus\",
    \"notes\": \"deserunt\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/dispatches"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_vehicle_id": "viayzqdnddztojkvbosmnxx",
    "origin": "odio",
    "destination": "doloribus",
    "notes": "deserunt"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/dispatches';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'order_vehicle_id' =&gt; 'viayzqdnddztojkvbosmnxx',
            'origin' =&gt; 'odio',
            'destination' =&gt; 'doloribus',
            'notes' =&gt; 'deserunt',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/dispatches'
payload = {
    "order_vehicle_id": "viayzqdnddztojkvbosmnxx",
    "origin": "odio",
    "destination": "doloribus",
    "notes": "deserunt"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-dispatches">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 31
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The selected order vehicle id is invalid.&quot;,
    &quot;errors&quot;: {
        &quot;order_vehicle_id&quot;: [
            &quot;The selected order vehicle id is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dispatches" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dispatches"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dispatches"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dispatches" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dispatches">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dispatches" data-method="POST"
      data-path="api/dispatches"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dispatches', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dispatches</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dispatches"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dispatches"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_vehicle_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_vehicle_id"                data-endpoint="POSTapi-dispatches"
               value="viayzqdnddztojkvbosmnxx"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>viayzqdnddztojkvbosmnxx</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>origin</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="origin"                data-endpoint="POSTapi-dispatches"
               value="odio"
               data-component="body">
    <br>
<p>Example: <code>odio</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>destination</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="destination"                data-endpoint="POSTapi-dispatches"
               value="doloribus"
               data-component="body">
    <br>
<p>Example: <code>doloribus</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-dispatches"
               value="deserunt"
               data-component="body">
    <br>
<p>Example: <code>deserunt</code></p>
        </div>
        </form>

                    <h2 id="dispatch-GETapi-dispatches--id-">Display the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETapi-dispatches--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/dispatches/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/dispatches/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/dispatches/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/dispatches/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-dispatches--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 30
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_vehicle_id&quot;: 1,
        &quot;origin&quot;: &quot;Bukoto Kisasi&quot;,
        &quot;destination&quot;: &quot;Ndeeba&quot;,
        &quot;notes&quot;: &quot;Wabodda&quot;,
        &quot;status&quot;: &quot;transit&quot;,
        &quot;created_at&quot;: &quot;2024-03-28T10:37:24.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:37:41.000000Z&quot;,
        &quot;deleted_at&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dispatches--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dispatches--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dispatches--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dispatches--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dispatches--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dispatches--id-" data-method="GET"
      data-path="api/dispatches/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dispatches--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dispatches/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dispatches--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dispatches--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-dispatches--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the dispatch. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="dispatch-PUTapi-dispatches--id-">Update the specified resource in storage.</h2>

<p>
</p>



<span id="example-requests-PUTapi-dispatches--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/dispatches/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/dispatches/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/dispatches/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/dispatches/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-dispatches--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 29
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_vehicle_id&quot;: 1,
        &quot;origin&quot;: &quot;Bukoto Kisasi&quot;,
        &quot;destination&quot;: &quot;Ndeeba&quot;,
        &quot;notes&quot;: &quot;Wabodda&quot;,
        &quot;status&quot;: &quot;transit&quot;,
        &quot;created_at&quot;: &quot;2024-03-28T10:37:24.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:37:41.000000Z&quot;,
        &quot;deleted_at&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-dispatches--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-dispatches--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-dispatches--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-dispatches--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-dispatches--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-dispatches--id-" data-method="PUT"
      data-path="api/dispatches/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-dispatches--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/dispatches/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/dispatches/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-dispatches--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-dispatches--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-dispatches--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the dispatch. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="dispatch-DELETEapi-dispatches--id-">Remove the specified resource from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-dispatches--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/dispatches/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/dispatches/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/dispatches/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/dispatches/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-dispatches--id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
x-ratelimit-limit: 60
x-ratelimit-remaining: 28
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-dispatches--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-dispatches--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-dispatches--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-dispatches--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-dispatches--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-dispatches--id-" data-method="DELETE"
      data-path="api/dispatches/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-dispatches--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/dispatches/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-dispatches--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-dispatches--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-dispatches--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the dispatch. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="dispatch-PUTapi-dispatches--dispatch_id--status--newStatus-">Change status of a dispatch</h2>

<p>
</p>



<span id="example-requests-PUTapi-dispatches--dispatch_id--status--newStatus-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/dispatches/1/status/nesciunt" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/dispatches/1/status/nesciunt"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/dispatches/1/status/nesciunt';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/dispatches/1/status/nesciunt'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-dispatches--dispatch_id--status--newStatus-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 27
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-dispatches--dispatch_id--status--newStatus-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-dispatches--dispatch_id--status--newStatus-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-dispatches--dispatch_id--status--newStatus-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-dispatches--dispatch_id--status--newStatus-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-dispatches--dispatch_id--status--newStatus-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-dispatches--dispatch_id--status--newStatus-" data-method="PUT"
      data-path="api/dispatches/{dispatch_id}/status/{newStatus}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-dispatches--dispatch_id--status--newStatus-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/dispatches/{dispatch_id}/status/{newStatus}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-dispatches--dispatch_id--status--newStatus-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-dispatches--dispatch_id--status--newStatus-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>dispatch_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="dispatch_id"                data-endpoint="PUTapi-dispatches--dispatch_id--status--newStatus-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the dispatch. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>newStatus</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="newStatus"                data-endpoint="PUTapi-dispatches--dispatch_id--status--newStatus-"
               value="nesciunt"
               data-component="url">
    <br>
<p>Example: <code>nesciunt</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>string</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="string"                data-endpoint="PUTapi-dispatches--dispatch_id--status--newStatus-"
               value="in_progress"
               data-component="url">
    <br>
<p>$newStatus The new status value (possible values:    'pending',  'in_progress', 'completed' Example: <code>in_progress</code></p>
            </div>
                    </form>

                <h1 id="drivers">Drivers</h1>

    

                                <h2 id="drivers-GETapi-drivers">Display a listing of the drivers.</h2>

<p>
</p>



<span id="example-requests-GETapi-drivers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/drivers" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-drivers">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 54
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 2,
            &quot;license&quot;: null,
            &quot;created_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://dayalog_api.test/api/drivers?page=1&quot;,
        &quot;last&quot;: &quot;http://dayalog_api.test/api/drivers?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://dayalog_api.test/api/drivers?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://dayalog_api.test/api/drivers&quot;,
        &quot;per_page&quot;: 25,
        &quot;to&quot;: 1,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-drivers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-drivers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-drivers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-drivers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-drivers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-drivers" data-method="GET"
      data-path="api/drivers"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-drivers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/drivers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-drivers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-drivers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="drivers-POSTapi-drivers">Store a newly created drivers.</h2>

<p>
</p>



<span id="example-requests-POSTapi-drivers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/drivers" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-drivers">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 53
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-drivers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-drivers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-drivers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-drivers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-drivers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-drivers" data-method="POST"
      data-path="api/drivers"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-drivers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/drivers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-drivers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-drivers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>license</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="license"                data-endpoint="POSTapi-drivers"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-drivers"
               value=""
               data-component="body">
    <br>
<p>This field is required when <code>user_id</code> is <code>null</code>.</p>
        </div>
        </form>

                    <h2 id="drivers-GETapi-drivers--id-">Display the specified resource.</h2>

<p>
</p>



<span id="example-requests-GETapi-drivers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/drivers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-drivers--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 52
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 2,
        &quot;license&quot;: null,
        &quot;created_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-drivers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-drivers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-drivers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-drivers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-drivers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-drivers--id-" data-method="GET"
      data-path="api/drivers/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-drivers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/drivers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-drivers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-drivers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-drivers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the driver. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="drivers-PUTapi-drivers--id-">Update the specified driver.</h2>

<p>
</p>



<span id="example-requests-PUTapi-drivers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/drivers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-drivers--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 51
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 2,
        &quot;license&quot;: null,
        &quot;created_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-drivers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-drivers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-drivers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-drivers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-drivers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-drivers--id-" data-method="PUT"
      data-path="api/drivers/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-drivers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/drivers/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/drivers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-drivers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-drivers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-drivers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the driver. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>driver</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="driver"                data-endpoint="PUTapi-drivers--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="PUTapi-drivers--id-"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="drivers-DELETEapi-drivers--id-">Remove driver from the system.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-drivers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/drivers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-drivers--id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
x-ratelimit-limit: 60
x-ratelimit-remaining: 50
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-drivers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-drivers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-drivers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-drivers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-drivers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-drivers--id-" data-method="DELETE"
      data-path="api/drivers/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-drivers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/drivers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-drivers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-drivers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-drivers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the driver. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="drivers-POSTapi-drivers--driver_id--vehicles--vehicle_id-">Assign Vehicle to Driver</h2>

<p>
</p>



<span id="example-requests-POSTapi-drivers--driver_id--vehicles--vehicle_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/drivers/1/vehicles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers/1/vehicles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers/1/vehicles/1';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers/1/vehicles/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-drivers--driver_id--vehicles--vehicle_id-">
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 49
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vehicle is already attached to a driver.&quot;,
    &quot;driver&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 2,
        &quot;license&quot;: null,
        &quot;created_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:28:02.000000Z&quot;,
        &quot;laravel_through_key&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-drivers--driver_id--vehicles--vehicle_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-drivers--driver_id--vehicles--vehicle_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-drivers--driver_id--vehicles--vehicle_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-drivers--driver_id--vehicles--vehicle_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-drivers--driver_id--vehicles--vehicle_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-drivers--driver_id--vehicles--vehicle_id-" data-method="POST"
      data-path="api/drivers/{driver_id}/vehicles/{vehicle_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-drivers--driver_id--vehicles--vehicle_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/drivers/{driver_id}/vehicles/{vehicle_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-drivers--driver_id--vehicles--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-drivers--driver_id--vehicles--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>driver_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="driver_id"                data-endpoint="POSTapi-drivers--driver_id--vehicles--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the driver. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vehicle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vehicle_id"                data-endpoint="POSTapi-drivers--driver_id--vehicles--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="drivers-DELETEapi-drivers--driver_id--vehicles--vehicle_id-">Remove Vehicle from Driver</h2>

<p>
</p>



<span id="example-requests-DELETEapi-drivers--driver_id--vehicles--vehicle_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/drivers/1/vehicles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/drivers/1/vehicles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/drivers/1/vehicles/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/drivers/1/vehicles/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-drivers--driver_id--vehicles--vehicle_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 48
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vehicle removed successfully.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-drivers--driver_id--vehicles--vehicle_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-drivers--driver_id--vehicles--vehicle_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-drivers--driver_id--vehicles--vehicle_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-drivers--driver_id--vehicles--vehicle_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-drivers--driver_id--vehicles--vehicle_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-drivers--driver_id--vehicles--vehicle_id-" data-method="DELETE"
      data-path="api/drivers/{driver_id}/vehicles/{vehicle_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-drivers--driver_id--vehicles--vehicle_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/drivers/{driver_id}/vehicles/{vehicle_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-drivers--driver_id--vehicles--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-drivers--driver_id--vehicles--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>driver_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="driver_id"                data-endpoint="DELETEapi-drivers--driver_id--vehicles--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the driver. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vehicle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vehicle_id"                data-endpoint="DELETEapi-drivers--driver_id--vehicles--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="orders">Orders</h1>

    

                                <h2 id="orders-GETapi-orders">Display a listing of the orders.</h2>

<p>
</p>



<span id="example-requests-GETapi-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-orders">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 40
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;from&quot;: 2,
            &quot;to&quot;: 2,
            &quot;patasente_purchase_order_id&quot;: null,
            &quot;reference&quot;: &quot;1c4f1e85-c90b-4841-8bd3-d9caa4f18a96&quot;,
            &quot;notes&quot;: &quot;Notes&quot;,
            &quot;status&quot;: &quot;completed&quot;,
            &quot;created_at&quot;: &quot;2024-03-28T10:36:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-03-28T13:34:13.000000Z&quot;,
            &quot;payload&quot;: &quot;{\&quot;to\&quot;: 2, \&quot;from\&quot;: 2, \&quot;notes\&quot;: \&quot;Notes\&quot;, \&quot;orderItems\&quot;: [{\&quot;id\&quot;: \&quot;8550d100-9a29-4fed-86a9-063eb4d2b9f0\&quot;, \&quot;qty\&quot;: \&quot;23\&quot;, \&quot;item\&quot;: \&quot;Beans\&quot;, \&quot;price\&quot;: \&quot;2300\&quot;, \&quot;qty_measure\&quot;: \&quot;Litres\&quot;}]}&quot;,
            &quot;items&quot;: [
                {
                    &quot;id&quot;: &quot;8550d100-9a29-4fed-86a9-063eb4d2b9f0&quot;,
                    &quot;qty&quot;: &quot;23&quot;,
                    &quot;item&quot;: &quot;Beans&quot;,
                    &quot;price&quot;: &quot;2300&quot;,
                    &quot;qty_measure&quot;: &quot;Litres&quot;
                }
            ],
            &quot;assignedVehicles&quot;: [
                {
                    &quot;order_vehicle_ref&quot;: 1,
                    &quot;vehicle&quot;: {
                        &quot;id&quot;: 1,
                        &quot;device&quot;: [
                            {
                                &quot;id&quot;: 49,
                                &quot;name&quot;: &quot;Solomon&quot;,
                                &quot;uniqueid&quot;: &quot;265412&quot;,
                                &quot;lastupdate&quot;: &quot;2023-10-20 19:15:22&quot;,
                                &quot;positionid&quot;: 29323,
                                &quot;groupid&quot;: null,
                                &quot;attributes&quot;: &quot;{}&quot;,
                                &quot;phone&quot;: null,
                                &quot;model&quot;: &quot;Phone Model&quot;,
                                &quot;contact&quot;: null,
                                &quot;category&quot;: null,
                                &quot;disabled&quot;: 0,
                                &quot;status&quot;: &quot;offline&quot;,
                                &quot;geofenceids&quot;: null,
                                &quot;expirationtime&quot;: null,
                                &quot;motionstate&quot;: 0,
                                &quot;motiontime&quot;: null,
                                &quot;motiondistance&quot;: 0,
                                &quot;overspeedstate&quot;: 0,
                                &quot;overspeedtime&quot;: null,
                                &quot;overspeedgeofenceid&quot;: 0,
                                &quot;motionstreak&quot;: 0,
                                &quot;last_position&quot;: {
                                    &quot;id&quot;: 29323,
                                    &quot;protocol&quot;: &quot;osmand&quot;,
                                    &quot;deviceid&quot;: 49,
                                    &quot;servertime&quot;: &quot;2023-10-20T16:15:22.000000Z&quot;,
                                    &quot;devicetime&quot;: &quot;2023-10-20 19:15:18&quot;,
                                    &quot;fixtime&quot;: &quot;2023-10-20 19:15:18&quot;,
                                    &quot;valid&quot;: 1,
                                    &quot;latitude&quot;: 0.3764655,
                                    &quot;longitude&quot;: 32.6551186,
                                    &quot;altitude&quot;: 0,
                                    &quot;speed&quot;: 0,
                                    &quot;course&quot;: 0,
                                    &quot;address&quot;: null,
                                    &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:19.0,\&quot;distance\&quot;:751.12,\&quot;totalDistance\&quot;:53108.43,\&quot;motion\&quot;:false}&quot;,
                                    &quot;accuracy&quot;: 1500,
                                    &quot;network&quot;: &quot;null&quot;
                                }
                            },
                            {
                                &quot;id&quot;: 50,
                                &quot;name&quot;: &quot;Afasha&quot;,
                                &quot;uniqueid&quot;: &quot;43989383484834&quot;,
                                &quot;lastupdate&quot;: null,
                                &quot;positionid&quot;: null,
                                &quot;groupid&quot;: null,
                                &quot;attributes&quot;: &quot;{}&quot;,
                                &quot;phone&quot;: null,
                                &quot;model&quot;: &quot;tk340&quot;,
                                &quot;contact&quot;: null,
                                &quot;category&quot;: null,
                                &quot;disabled&quot;: 0,
                                &quot;status&quot;: &quot;offline&quot;,
                                &quot;geofenceids&quot;: null,
                                &quot;expirationtime&quot;: null,
                                &quot;motionstate&quot;: 0,
                                &quot;motiontime&quot;: null,
                                &quot;motiondistance&quot;: 0,
                                &quot;overspeedstate&quot;: 0,
                                &quot;overspeedtime&quot;: null,
                                &quot;overspeedgeofenceid&quot;: 0,
                                &quot;motionstreak&quot;: 0,
                                &quot;last_position&quot;: null
                            },
                            {
                                &quot;id&quot;: 48,
                                &quot;name&quot;: &quot;Afasha&quot;,
                                &quot;uniqueid&quot;: &quot;835881&quot;,
                                &quot;lastupdate&quot;: &quot;2024-03-28 22:09:21&quot;,
                                &quot;positionid&quot;: 66949,
                                &quot;groupid&quot;: null,
                                &quot;attributes&quot;: &quot;{}&quot;,
                                &quot;phone&quot;: null,
                                &quot;model&quot;: null,
                                &quot;contact&quot;: null,
                                &quot;category&quot;: null,
                                &quot;disabled&quot;: 0,
                                &quot;status&quot;: &quot;offline&quot;,
                                &quot;geofenceids&quot;: null,
                                &quot;expirationtime&quot;: null,
                                &quot;motionstate&quot;: 0,
                                &quot;motiontime&quot;: &quot;2024-03-28 22:09:20&quot;,
                                &quot;motiondistance&quot;: 102575587.22,
                                &quot;overspeedstate&quot;: 0,
                                &quot;overspeedtime&quot;: null,
                                &quot;overspeedgeofenceid&quot;: 0,
                                &quot;motionstreak&quot;: 1,
                                &quot;last_position&quot;: {
                                    &quot;id&quot;: 66949,
                                    &quot;protocol&quot;: &quot;osmand&quot;,
                                    &quot;deviceid&quot;: 48,
                                    &quot;servertime&quot;: &quot;2024-03-28T19:09:21.000000Z&quot;,
                                    &quot;devicetime&quot;: &quot;2024-03-28 22:09:20&quot;,
                                    &quot;fixtime&quot;: &quot;2024-03-28 22:09:20&quot;,
                                    &quot;valid&quot;: 1,
                                    &quot;latitude&quot;: 0.3576947,
                                    &quot;longitude&quot;: 32.5976538,
                                    &quot;altitude&quot;: 1178,
                                    &quot;speed&quot;: 0.00365728,
                                    &quot;course&quot;: 0,
                                    &quot;address&quot;: null,
                                    &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:45.0,\&quot;distance\&quot;:0.02,\&quot;totalDistance\&quot;:1.0257558722E8,\&quot;motion\&quot;:false}&quot;,
                                    &quot;accuracy&quot;: 30,
                                    &quot;network&quot;: &quot;null&quot;
                                }
                            }
                        ]
                    },
                    &quot;dispatches&quot;: [
                        {
                            &quot;id&quot;: 1,
                            &quot;order_vehicle_id&quot;: 1,
                            &quot;origin&quot;: &quot;Bukoto Kisasi&quot;,
                            &quot;destination&quot;: &quot;Ndeeba&quot;,
                            &quot;notes&quot;: &quot;Wabodda&quot;,
                            &quot;status&quot;: &quot;transit&quot;,
                            &quot;created_at&quot;: &quot;2024-03-28T10:37:24.000000Z&quot;,
                            &quot;updated_at&quot;: &quot;2024-03-28T10:37:41.000000Z&quot;,
                            &quot;deleted_at&quot;: null
                        }
                    ]
                }
            ]
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://dayalog_api.test/api/orders?page=1&quot;,
        &quot;last&quot;: &quot;http://dayalog_api.test/api/orders?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://dayalog_api.test/api/orders?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://dayalog_api.test/api/orders&quot;,
        &quot;per_page&quot;: 25,
        &quot;to&quot;: 1,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders" data-method="GET"
      data-path="api/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="orders-POSTapi-orders">Add an order to the system</h2>

<p>
</p>



<span id="example-requests-POSTapi-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"from\": \"dolor\",
    \"to\": \"blanditiis\",
    \"patasente_purchase_order_id\": 19,
    \"reference\": \"non\",
    \"notes\": \"repudiandae\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "from": "dolor",
    "to": "blanditiis",
    "patasente_purchase_order_id": 19,
    "reference": "non",
    "notes": "repudiandae"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'from' =&gt; 'dolor',
            'to' =&gt; 'blanditiis',
            'patasente_purchase_order_id' =&gt; 19,
            'reference' =&gt; 'non',
            'notes' =&gt; 'repudiandae',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders'
payload = {
    "from": "dolor",
    "to": "blanditiis",
    "patasente_purchase_order_id": 19,
    "reference": "non",
    "notes": "repudiandae"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-orders">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 39
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The selected from is invalid. (and 1 more error)&quot;,
    &quot;errors&quot;: {
        &quot;from&quot;: [
            &quot;The selected from is invalid.&quot;
        ],
        &quot;to&quot;: [
            &quot;The selected to is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-orders" data-method="POST"
      data-path="api/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="from"                data-endpoint="POSTapi-orders"
               value="dolor"
               data-component="body">
    <br>
<p>Example: <code>dolor</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="to"                data-endpoint="POSTapi-orders"
               value="blanditiis"
               data-component="body">
    <br>
<p>Example: <code>blanditiis</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patasente_purchase_order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patasente_purchase_order_id"                data-endpoint="POSTapi-orders"
               value="19"
               data-component="body">
    <br>
<p>Example: <code>19</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reference</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reference"                data-endpoint="POSTapi-orders"
               value="non"
               data-component="body">
    <br>
<p>Example: <code>non</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-orders"
               value="repudiandae"
               data-component="body">
    <br>
<p>Example: <code>repudiandae</code></p>
        </div>
        </form>

                    <h2 id="orders-GETapi-orders--id-">Get all details of an order</h2>

<p>
</p>



<span id="example-requests-GETapi-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/orders/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-orders--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 38
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;from&quot;: 2,
        &quot;to&quot;: 2,
        &quot;patasente_purchase_order_id&quot;: null,
        &quot;reference&quot;: &quot;1c4f1e85-c90b-4841-8bd3-d9caa4f18a96&quot;,
        &quot;notes&quot;: &quot;Notes&quot;,
        &quot;status&quot;: &quot;completed&quot;,
        &quot;created_at&quot;: &quot;2024-03-28T10:36:57.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T13:34:13.000000Z&quot;,
        &quot;payload&quot;: &quot;{\&quot;to\&quot;: 2, \&quot;from\&quot;: 2, \&quot;notes\&quot;: \&quot;Notes\&quot;, \&quot;orderItems\&quot;: [{\&quot;id\&quot;: \&quot;8550d100-9a29-4fed-86a9-063eb4d2b9f0\&quot;, \&quot;qty\&quot;: \&quot;23\&quot;, \&quot;item\&quot;: \&quot;Beans\&quot;, \&quot;price\&quot;: \&quot;2300\&quot;, \&quot;qty_measure\&quot;: \&quot;Litres\&quot;}]}&quot;,
        &quot;items&quot;: [
            {
                &quot;id&quot;: &quot;8550d100-9a29-4fed-86a9-063eb4d2b9f0&quot;,
                &quot;qty&quot;: &quot;23&quot;,
                &quot;item&quot;: &quot;Beans&quot;,
                &quot;price&quot;: &quot;2300&quot;,
                &quot;qty_measure&quot;: &quot;Litres&quot;
            }
        ],
        &quot;assignedVehicles&quot;: [
            {
                &quot;order_vehicle_ref&quot;: 1,
                &quot;vehicle&quot;: {
                    &quot;id&quot;: 1,
                    &quot;device&quot;: [
                        {
                            &quot;id&quot;: 49,
                            &quot;name&quot;: &quot;Solomon&quot;,
                            &quot;uniqueid&quot;: &quot;265412&quot;,
                            &quot;lastupdate&quot;: &quot;2023-10-20 19:15:22&quot;,
                            &quot;positionid&quot;: 29323,
                            &quot;groupid&quot;: null,
                            &quot;attributes&quot;: &quot;{}&quot;,
                            &quot;phone&quot;: null,
                            &quot;model&quot;: &quot;Phone Model&quot;,
                            &quot;contact&quot;: null,
                            &quot;category&quot;: null,
                            &quot;disabled&quot;: 0,
                            &quot;status&quot;: &quot;offline&quot;,
                            &quot;geofenceids&quot;: null,
                            &quot;expirationtime&quot;: null,
                            &quot;motionstate&quot;: 0,
                            &quot;motiontime&quot;: null,
                            &quot;motiondistance&quot;: 0,
                            &quot;overspeedstate&quot;: 0,
                            &quot;overspeedtime&quot;: null,
                            &quot;overspeedgeofenceid&quot;: 0,
                            &quot;motionstreak&quot;: 0,
                            &quot;last_position&quot;: {
                                &quot;id&quot;: 29323,
                                &quot;protocol&quot;: &quot;osmand&quot;,
                                &quot;deviceid&quot;: 49,
                                &quot;servertime&quot;: &quot;2023-10-20T16:15:22.000000Z&quot;,
                                &quot;devicetime&quot;: &quot;2023-10-20 19:15:18&quot;,
                                &quot;fixtime&quot;: &quot;2023-10-20 19:15:18&quot;,
                                &quot;valid&quot;: 1,
                                &quot;latitude&quot;: 0.3764655,
                                &quot;longitude&quot;: 32.6551186,
                                &quot;altitude&quot;: 0,
                                &quot;speed&quot;: 0,
                                &quot;course&quot;: 0,
                                &quot;address&quot;: null,
                                &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:19.0,\&quot;distance\&quot;:751.12,\&quot;totalDistance\&quot;:53108.43,\&quot;motion\&quot;:false}&quot;,
                                &quot;accuracy&quot;: 1500,
                                &quot;network&quot;: &quot;null&quot;
                            }
                        },
                        {
                            &quot;id&quot;: 50,
                            &quot;name&quot;: &quot;Afasha&quot;,
                            &quot;uniqueid&quot;: &quot;43989383484834&quot;,
                            &quot;lastupdate&quot;: null,
                            &quot;positionid&quot;: null,
                            &quot;groupid&quot;: null,
                            &quot;attributes&quot;: &quot;{}&quot;,
                            &quot;phone&quot;: null,
                            &quot;model&quot;: &quot;tk340&quot;,
                            &quot;contact&quot;: null,
                            &quot;category&quot;: null,
                            &quot;disabled&quot;: 0,
                            &quot;status&quot;: &quot;offline&quot;,
                            &quot;geofenceids&quot;: null,
                            &quot;expirationtime&quot;: null,
                            &quot;motionstate&quot;: 0,
                            &quot;motiontime&quot;: null,
                            &quot;motiondistance&quot;: 0,
                            &quot;overspeedstate&quot;: 0,
                            &quot;overspeedtime&quot;: null,
                            &quot;overspeedgeofenceid&quot;: 0,
                            &quot;motionstreak&quot;: 0,
                            &quot;last_position&quot;: null
                        },
                        {
                            &quot;id&quot;: 48,
                            &quot;name&quot;: &quot;Afasha&quot;,
                            &quot;uniqueid&quot;: &quot;835881&quot;,
                            &quot;lastupdate&quot;: &quot;2024-03-28 22:09:21&quot;,
                            &quot;positionid&quot;: 66949,
                            &quot;groupid&quot;: null,
                            &quot;attributes&quot;: &quot;{}&quot;,
                            &quot;phone&quot;: null,
                            &quot;model&quot;: null,
                            &quot;contact&quot;: null,
                            &quot;category&quot;: null,
                            &quot;disabled&quot;: 0,
                            &quot;status&quot;: &quot;offline&quot;,
                            &quot;geofenceids&quot;: null,
                            &quot;expirationtime&quot;: null,
                            &quot;motionstate&quot;: 0,
                            &quot;motiontime&quot;: &quot;2024-03-28 22:09:20&quot;,
                            &quot;motiondistance&quot;: 102575587.22,
                            &quot;overspeedstate&quot;: 0,
                            &quot;overspeedtime&quot;: null,
                            &quot;overspeedgeofenceid&quot;: 0,
                            &quot;motionstreak&quot;: 1,
                            &quot;last_position&quot;: {
                                &quot;id&quot;: 66949,
                                &quot;protocol&quot;: &quot;osmand&quot;,
                                &quot;deviceid&quot;: 48,
                                &quot;servertime&quot;: &quot;2024-03-28T19:09:21.000000Z&quot;,
                                &quot;devicetime&quot;: &quot;2024-03-28 22:09:20&quot;,
                                &quot;fixtime&quot;: &quot;2024-03-28 22:09:20&quot;,
                                &quot;valid&quot;: 1,
                                &quot;latitude&quot;: 0.3576947,
                                &quot;longitude&quot;: 32.5976538,
                                &quot;altitude&quot;: 1178,
                                &quot;speed&quot;: 0.00365728,
                                &quot;course&quot;: 0,
                                &quot;address&quot;: null,
                                &quot;attributes&quot;: &quot;{\&quot;batteryLevel\&quot;:45.0,\&quot;distance\&quot;:0.02,\&quot;totalDistance\&quot;:1.0257558722E8,\&quot;motion\&quot;:false}&quot;,
                                &quot;accuracy&quot;: 30,
                                &quot;network&quot;: &quot;null&quot;
                            }
                        }
                    ]
                },
                &quot;dispatches&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;order_vehicle_id&quot;: 1,
                        &quot;origin&quot;: &quot;Bukoto Kisasi&quot;,
                        &quot;destination&quot;: &quot;Ndeeba&quot;,
                        &quot;notes&quot;: &quot;Wabodda&quot;,
                        &quot;status&quot;: &quot;transit&quot;,
                        &quot;created_at&quot;: &quot;2024-03-28T10:37:24.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2024-03-28T10:37:41.000000Z&quot;,
                        &quot;deleted_at&quot;: null
                    }
                ]
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders--id-" data-method="GET"
      data-path="api/orders/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-orders--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="orders-PUTapi-orders--id-">Update Update order details.</h2>

<p>
</p>



<span id="example-requests-PUTapi-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/orders/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-orders--id-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 37
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-orders--id-" data-method="PUT"
      data-path="api/orders/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/orders/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-orders--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="orders-DELETEapi-orders--id-">Delete an order.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/orders/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-orders--id-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 36
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-orders--id-" data-method="DELETE"
      data-path="api/orders/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-orders--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="orders-POSTapi-orders--order_id--vehicle--vehicle_id-">Attach Vehicle to an order</h2>

<p>
</p>



<span id="example-requests-POSTapi-orders--order_id--vehicle--vehicle_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/orders/1/vehicle/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders/1/vehicle/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders/1/vehicle/1';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders/1/vehicle/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-orders--order_id--vehicle--vehicle_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 35
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vehicle attached successfully.&quot;,
    &quot;orderVehicle&quot;: {
        &quot;order_id&quot;: 1,
        &quot;vehicle_id&quot;: 1,
        &quot;created_at&quot;: &quot;2024-05-04T19:55:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-05-04T19:55:44.000000Z&quot;,
        &quot;id&quot;: 4
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-orders--order_id--vehicle--vehicle_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-orders--order_id--vehicle--vehicle_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders--order_id--vehicle--vehicle_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-orders--order_id--vehicle--vehicle_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders--order_id--vehicle--vehicle_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-orders--order_id--vehicle--vehicle_id-" data-method="POST"
      data-path="api/orders/{order_id}/vehicle/{vehicle_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders--order_id--vehicle--vehicle_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/orders/{order_id}/vehicle/{vehicle_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-orders--order_id--vehicle--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-orders--order_id--vehicle--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="POSTapi-orders--order_id--vehicle--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vehicle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vehicle_id"                data-endpoint="POSTapi-orders--order_id--vehicle--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="orders-DELETEapi-orders--order_id--vehicle--vehicle_id-">Detach Vehicle from an order</h2>

<p>
</p>



<span id="example-requests-DELETEapi-orders--order_id--vehicle--vehicle_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/orders/1/vehicle/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders/1/vehicle/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders/1/vehicle/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders/1/vehicle/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-orders--order_id--vehicle--vehicle_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 34
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vehicle detached successfully.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-orders--order_id--vehicle--vehicle_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-orders--order_id--vehicle--vehicle_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-orders--order_id--vehicle--vehicle_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-orders--order_id--vehicle--vehicle_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-orders--order_id--vehicle--vehicle_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-orders--order_id--vehicle--vehicle_id-" data-method="DELETE"
      data-path="api/orders/{order_id}/vehicle/{vehicle_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-orders--order_id--vehicle--vehicle_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/orders/{order_id}/vehicle/{vehicle_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-orders--order_id--vehicle--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-orders--order_id--vehicle--vehicle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="DELETEapi-orders--order_id--vehicle--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vehicle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vehicle_id"                data-endpoint="DELETEapi-orders--order_id--vehicle--vehicle_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="orders-PUTapi-orders--order_id--status--newStatus-">Change Order status</h2>

<p>
</p>



<span id="example-requests-PUTapi-orders--order_id--status--newStatus-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/orders/1/status/quidem" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/orders/1/status/quidem"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/orders/1/status/quidem';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/orders/1/status/quidem'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-orders--order_id--status--newStatus-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 33
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-orders--order_id--status--newStatus-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-orders--order_id--status--newStatus-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-orders--order_id--status--newStatus-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-orders--order_id--status--newStatus-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-orders--order_id--status--newStatus-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-orders--order_id--status--newStatus-" data-method="PUT"
      data-path="api/orders/{order_id}/status/{newStatus}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-orders--order_id--status--newStatus-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/orders/{order_id}/status/{newStatus}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-orders--order_id--status--newStatus-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-orders--order_id--status--newStatus-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="PUTapi-orders--order_id--status--newStatus-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>newStatus</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="newStatus"                data-endpoint="PUTapi-orders--order_id--status--newStatus-"
               value="quidem"
               data-component="url">
    <br>
<p>Example: <code>quidem</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>string</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="string"                data-endpoint="PUTapi-orders--order_id--status--newStatus-"
               value="cancelled"
               data-component="url">
    <br>
<p>$newStatus The new status value (possible values: 'not_started', 'transit', 'reached', 'cancelled'). Example: <code>cancelled</code></p>
            </div>
                    </form>

                <h1 id="users">Users</h1>

    

                                <h2 id="users-GETapi-user">GET api/user</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/user';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/user'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="vehicles">Vehicles</h1>

    

                                <h2 id="vehicles-GETapi-vehicles">Display a listing of the vehicles.</h2>

<p>
</p>



<span id="example-requests-GETapi-vehicles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/vehicles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-vehicles">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 47
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;vin&quot;: null,
            &quot;number_plate&quot;: &quot;UAE 345B&quot;,
            &quot;make&quot;: null,
            &quot;model&quot;: null,
            &quot;capacity_weight&quot;: null,
            &quot;capacity_volume&quot;: null,
            &quot;availability&quot;: 1,
            &quot;insurance_policy_number&quot;: null,
            &quot;insurance_coverage&quot;: null,
            &quot;insurance_expiration&quot;: null,
            &quot;created_at&quot;: &quot;2024-03-28T10:28:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-03-28T10:28:44.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://dayalog_api.test/api/vehicles?page=1&quot;,
        &quot;last&quot;: &quot;http://dayalog_api.test/api/vehicles?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://dayalog_api.test/api/vehicles?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://dayalog_api.test/api/vehicles&quot;,
        &quot;per_page&quot;: 25,
        &quot;to&quot;: 1,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vehicles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vehicles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vehicles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vehicles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vehicles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vehicles" data-method="GET"
      data-path="api/vehicles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vehicles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vehicles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vehicles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vehicles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="vehicles-POSTapi-vehicles">Add vehicle to the system</h2>

<p>
</p>



<span id="example-requests-POSTapi-vehicles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://dayalog.co/api/vehicles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"vin\": \"perferendis\",
    \"number_plate\": \"eos\",
    \"make\": \"vitae\",
    \"model\": \"aut\",
    \"availability\": false,
    \"capacity_weight\": 32522086.4138,
    \"capacity_volume\": 7518898.137,
    \"insurance_policy_number\": \"dolor\",
    \"insurance_coverage\": \"officia\",
    \"insurance_expiration\": \"2024-05-04T22:55:44\",
    \"attached_device_id\": 13
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "vin": "perferendis",
    "number_plate": "eos",
    "make": "vitae",
    "model": "aut",
    "availability": false,
    "capacity_weight": 32522086.4138,
    "capacity_volume": 7518898.137,
    "insurance_policy_number": "dolor",
    "insurance_coverage": "officia",
    "insurance_expiration": "2024-05-04T22:55:44",
    "attached_device_id": 13
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'vin' =&gt; 'perferendis',
            'number_plate' =&gt; 'eos',
            'make' =&gt; 'vitae',
            'model' =&gt; 'aut',
            'availability' =&gt; false,
            'capacity_weight' =&gt; 32522086.4138,
            'capacity_volume' =&gt; 7518898.137,
            'insurance_policy_number' =&gt; 'dolor',
            'insurance_coverage' =&gt; 'officia',
            'insurance_expiration' =&gt; '2024-05-04T22:55:44',
            'attached_device_id' =&gt; 13,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles'
payload = {
    "vin": "perferendis",
    "number_plate": "eos",
    "make": "vitae",
    "model": "aut",
    "availability": false,
    "capacity_weight": 32522086.4138,
    "capacity_volume": 7518898.137,
    "insurance_policy_number": "dolor",
    "insurance_coverage": "officia",
    "insurance_expiration": "2024-05-04T22:55:44",
    "attached_device_id": 13
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-vehicles">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 46
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;vin&quot;: &quot;perferendis&quot;,
        &quot;number_plate&quot;: &quot;eos&quot;,
        &quot;make&quot;: &quot;vitae&quot;,
        &quot;model&quot;: &quot;aut&quot;,
        &quot;capacity_weight&quot;: 32522086.4138,
        &quot;capacity_volume&quot;: 7518898.137,
        &quot;insurance_policy_number&quot;: &quot;dolor&quot;,
        &quot;insurance_coverage&quot;: &quot;officia&quot;,
        &quot;insurance_expiration&quot;: &quot;2024-05-04T22:55:44&quot;,
        &quot;updated_at&quot;: &quot;2024-05-04T19:55:44.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-05-04T19:55:44.000000Z&quot;,
        &quot;id&quot;: 3
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-vehicles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vehicles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vehicles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vehicles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vehicles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vehicles" data-method="POST"
      data-path="api/vehicles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vehicles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vehicles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vehicles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vehicles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vin</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="vin"                data-endpoint="POSTapi-vehicles"
               value="perferendis"
               data-component="body">
    <br>
<p>Example: <code>perferendis</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>number_plate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="number_plate"                data-endpoint="POSTapi-vehicles"
               value="eos"
               data-component="body">
    <br>
<p>Example: <code>eos</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>make</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="make"                data-endpoint="POSTapi-vehicles"
               value="vitae"
               data-component="body">
    <br>
<p>Example: <code>vitae</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="model"                data-endpoint="POSTapi-vehicles"
               value="aut"
               data-component="body">
    <br>
<p>Example: <code>aut</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>availability</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-vehicles" style="display: none">
            <input type="radio" name="availability"
                   value="true"
                   data-endpoint="POSTapi-vehicles"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-vehicles" style="display: none">
            <input type="radio" name="availability"
                   value="false"
                   data-endpoint="POSTapi-vehicles"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>capacity_weight</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="capacity_weight"                data-endpoint="POSTapi-vehicles"
               value="32522086.4138"
               data-component="body">
    <br>
<p>Example: <code>32522086.4138</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>capacity_volume</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="capacity_volume"                data-endpoint="POSTapi-vehicles"
               value="7518898.137"
               data-component="body">
    <br>
<p>Example: <code>7518898.137</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>insurance_policy_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="insurance_policy_number"                data-endpoint="POSTapi-vehicles"
               value="dolor"
               data-component="body">
    <br>
<p>Example: <code>dolor</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>insurance_coverage</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="insurance_coverage"                data-endpoint="POSTapi-vehicles"
               value="officia"
               data-component="body">
    <br>
<p>Example: <code>officia</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>insurance_expiration</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="insurance_expiration"                data-endpoint="POSTapi-vehicles"
               value="2024-05-04T22:55:44"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2024-05-04T22:55:44</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attached_device_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attached_device_id"                data-endpoint="POSTapi-vehicles"
               value="13"
               data-component="body">
    <br>
<p>Example: <code>13</code></p>
        </div>
        </form>

                    <h2 id="vehicles-GETapi-vehicles--id-">Get vehicle details</h2>

<p>
</p>



<span id="example-requests-GETapi-vehicles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://dayalog.co/api/vehicles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles/1';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-GETapi-vehicles--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 45
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;vin&quot;: null,
        &quot;number_plate&quot;: &quot;UAE 345B&quot;,
        &quot;make&quot;: null,
        &quot;model&quot;: null,
        &quot;capacity_weight&quot;: null,
        &quot;capacity_volume&quot;: null,
        &quot;availability&quot;: 1,
        &quot;insurance_policy_number&quot;: null,
        &quot;insurance_coverage&quot;: null,
        &quot;insurance_expiration&quot;: null,
        &quot;created_at&quot;: &quot;2024-03-28T10:28:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:28:44.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vehicles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vehicles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vehicles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vehicles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vehicles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vehicles--id-" data-method="GET"
      data-path="api/vehicles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vehicles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vehicles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vehicles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vehicles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-vehicles--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="vehicles-PUTapi-vehicles--id-">Update vehicle information.</h2>

<p>
</p>



<span id="example-requests-PUTapi-vehicles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/vehicles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles/1';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-vehicles--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 44
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;vin&quot;: null,
        &quot;number_plate&quot;: &quot;UAE 345B&quot;,
        &quot;make&quot;: null,
        &quot;model&quot;: null,
        &quot;capacity_weight&quot;: null,
        &quot;capacity_volume&quot;: null,
        &quot;availability&quot;: 1,
        &quot;insurance_policy_number&quot;: null,
        &quot;insurance_coverage&quot;: null,
        &quot;insurance_expiration&quot;: null,
        &quot;created_at&quot;: &quot;2024-03-28T10:28:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-03-28T10:28:44.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-vehicles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-vehicles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-vehicles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-vehicles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-vehicles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-vehicles--id-" data-method="PUT"
      data-path="api/vehicles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-vehicles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/vehicles/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/vehicles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-vehicles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-vehicles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-vehicles--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="vehicles-DELETEapi-vehicles--id-">Delete a vehicle.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-vehicles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://dayalog.co/api/vehicles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles/1';
$response = $client-&gt;delete(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-DELETEapi-vehicles--id-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 43
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-vehicles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-vehicles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-vehicles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-vehicles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-vehicles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-vehicles--id-" data-method="DELETE"
      data-path="api/vehicles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-vehicles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/vehicles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-vehicles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-vehicles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-vehicles--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="vehicles-PUTapi-vehicles--vehicle--attach-device">Attach device to a vehicle</h2>

<p>
</p>



<span id="example-requests-PUTapi-vehicles--vehicle--attach-device">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/vehicles/1/attach-device" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"device_id\": \"nobis\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles/1/attach-device"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "device_id": "nobis"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles/1/attach-device';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'device_id' =&gt; 'nobis',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles/1/attach-device'
payload = {
    "device_id": "nobis"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-vehicles--vehicle--attach-device">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 42
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-vehicles--vehicle--attach-device" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-vehicles--vehicle--attach-device"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-vehicles--vehicle--attach-device"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-vehicles--vehicle--attach-device" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-vehicles--vehicle--attach-device">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-vehicles--vehicle--attach-device" data-method="PUT"
      data-path="api/vehicles/{vehicle}/attach-device"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-vehicles--vehicle--attach-device', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/vehicles/{vehicle}/attach-device</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-vehicles--vehicle--attach-device"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-vehicles--vehicle--attach-device"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vehicle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vehicle"                data-endpoint="PUTapi-vehicles--vehicle--attach-device"
               value="1"
               data-component="url">
    <br>
<p>The vehicle. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vehicle</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="vehicle"                data-endpoint="PUTapi-vehicles--vehicle--attach-device"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>device_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="device_id"                data-endpoint="PUTapi-vehicles--vehicle--attach-device"
               value="nobis"
               data-component="body">
    <br>
<p>Example: <code>nobis</code></p>
        </div>
        </form>

                    <h2 id="vehicles-PUTapi-vehicles--vehicle_id--detach-devices">Remove devices attached to a vehicle.</h2>

<p>
</p>



<span id="example-requests-PUTapi-vehicles--vehicle_id--detach-devices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://dayalog.co/api/vehicles/1/detach-devices" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://dayalog.co/api/vehicles/1/detach-devices"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'https://dayalog.co/api/vehicles/1/detach-devices';
$response = $client-&gt;put(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://dayalog.co/api/vehicles/1/detach-devices'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre></div>

</span>

<span id="example-responses-PUTapi-vehicles--vehicle_id--detach-devices">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 41
access-control-allow-origin: localhost:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The selected vehicle is invalid.&quot;,
    &quot;errors&quot;: {
        &quot;vehicle&quot;: [
            &quot;The selected vehicle is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-vehicles--vehicle_id--detach-devices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-vehicles--vehicle_id--detach-devices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-vehicles--vehicle_id--detach-devices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-vehicles--vehicle_id--detach-devices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-vehicles--vehicle_id--detach-devices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-vehicles--vehicle_id--detach-devices" data-method="PUT"
      data-path="api/vehicles/{vehicle_id}/detach-devices"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-vehicles--vehicle_id--detach-devices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/vehicles/{vehicle_id}/detach-devices</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-vehicles--vehicle_id--detach-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-vehicles--vehicle_id--detach-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vehicle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vehicle_id"                data-endpoint="PUTapi-vehicles--vehicle_id--detach-devices"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vehicle. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vehicle</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="vehicle"                data-endpoint="PUTapi-vehicles--vehicle_id--detach-devices"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                                                        <button type="button" class="lang-button" data-language-name="python">python</button>
                            </div>
            </div>
</div>
</body>
</html>

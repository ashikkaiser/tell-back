<?php
return [
   'paths' => ['*'],
   'allowed_methods' => ['*'],

   'allowed_origins' => ['http://localhost:3000', 'https://tellmobi-vert.vercel.app', 'https://beta.tellmobi.com'],
   'allowed_origins_patterns' => ['*'],
   'allowed_headers' => ['*'],
   'exposed_headers' => [],
   'max_age' => 0,
   'supports_credentials' => true,
];

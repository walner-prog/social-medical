<?php

return[

    
'paths' => ['api/*', 'broadcasting/auth'],
'allowed_methods' => ['*'],
'allowed_origins' => ['http://127.0.0.1:8000', 'http://localhost:8000'],
'allowed_headers' => ['*'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => false,

];
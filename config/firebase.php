<?php
return [
    'firebase_server_key' => env('FIREBASE_SERVER_KEY'),
    'api_key' => env('FIREBASE_API_KEY', 'your-default-api-key'),
    'auth_domain' => env('FIREBASE_AUTH_DOMAIN', 'your-project-id.firebaseapp.com'),
    'database_url' => env('FIREBASE_DATABASE_URL', 'https://your-database-name.firebaseio.com'),
    'project_id' => env('FIREBASE_PROJECT_ID', 'your-project-id'),
];
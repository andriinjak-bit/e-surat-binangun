<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/register', 'POST', [
    'name' => '',
    'nik' => '',
    'password' => '',
    'password_confirmation' => '',
    'tempat_tanggal_lahir' => '',
    'jenis_kelamin' => '',
    'alamat' => '',
    'agreement' => 'false',
]);

$response = $kernel->handle($request);
echo $response->getStatusCode() . "\n";
echo $response->getContent();

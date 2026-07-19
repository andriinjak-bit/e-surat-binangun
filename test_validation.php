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
$request->headers->set('Accept', 'application/json');

// To bypass CSRF for testing, we can disable it in the app instance temporarily or just catch the exception
try {
    $controller = new App\Http\Controllers\AuthController();
    $controller->register($request);
} catch (Illuminate\Validation\ValidationException $e) {
    echo json_encode($e->errors(), JSON_PRETTY_PRINT);
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}

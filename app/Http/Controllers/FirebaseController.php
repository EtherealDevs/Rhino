<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function index()
    {
        $firebase = app('firebase');
        $database = $firebase->getDatabase();

        // Ejemplo: escribir datos en Firebase
        $reference = $database->getReference('test');
        $reference->set([
            'username' => 'example',
            'email' => 'example@example.com',
        ]);

        return response()->json(['message' => 'Data stored successfully']);
    }
}

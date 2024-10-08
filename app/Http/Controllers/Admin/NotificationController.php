<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las notificaciones del usuario
        $notifications = $user->notifications;

        // Obtener la cantidad de notificaciones no leídas
        $unreadNotificationsCount = $user->unreadNotifications->count();

        // Pasar las notificaciones y el conteo a la vista
        return view('admin.notifications.index', compact('notifications', 'unreadNotificationsCount'));
    }
}

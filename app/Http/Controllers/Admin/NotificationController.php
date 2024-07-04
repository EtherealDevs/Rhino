<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $notifications=$user->notifications;
        return view('admin.notifications.index',compact('notifications'));
    }
}

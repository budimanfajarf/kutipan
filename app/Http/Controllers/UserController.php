<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($id = null)
    {
        if ($id == null)
            $user = User::findOrFail(Auth::user()->id);
        else
            $user = User::findOrFail($id);

        return view('profile', compact('user'));
    }

    public function notification()
    {
        // dd("Well hello people");
        $user = Auth::user();
        
        $notifications = $user->notifications()->where('seen', 0)->with('quote')->orderBy('id', 'desc')->get();
        
        $notifModel = new Notification;

        // dd($notifications);

        return view('notification', compact('notifications', 'user', 'notifModel'));
    }
}

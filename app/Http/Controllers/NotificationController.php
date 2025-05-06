<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function latest()
    {
        return auth()->user()
            ->notifications()
            ->take(5)
            ->get()
            ->map(function($notification) {
                return [
                    'message' => $notification->data['message'],
                    'sujet' => $notification->data['sujet'] ?? '',
                    'url' => $notification->data['url'] ?? '#',
                    'unread' => $notification->unread(),
                    'time' => $notification->created_at->diffForHumans()
                ];
            });
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }

    public function unreadCount()
{
    return response()->json([
        'count' => auth()->user()->unreadNotifications()->count()
    ]);
}

    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('client.notifications.index', compact('notifications'));
    }

    
}
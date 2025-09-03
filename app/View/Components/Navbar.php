<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public function render(): View|Closure|string
    {
        $notifications = collect();

        if (Auth::check()) {
            $notifications = Notification::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get();
        }

        return view('components.navbar', [
            'notifications' => $notifications,
            'unreadCount' => $notifications->where('is_read', false)->count(),
        ]);
    }
}

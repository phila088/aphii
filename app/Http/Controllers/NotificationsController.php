<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class NotificationsController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Notifications::class);

        return Notifications::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Notifications::class);

        $data = $request->validate([

        ]);

        return Notifications::create($data);
    }

    public function show(Notifications $notifications)
    {
        $this->authorize('view', $notifications);

        return $notifications;
    }

    public function update(Request $request, Notifications $notifications)
    {
        $this->authorize('update', $notifications);

        $data = $request->validate([

        ]);

        $notifications->update($data);

        return $notifications;
    }

    public function destroy(Notifications $notifications)
    {
        $this->authorize('delete', $notifications);

        $notifications->delete();

        return response()->json();
    }
}

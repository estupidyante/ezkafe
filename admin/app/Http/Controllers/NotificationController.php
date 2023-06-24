<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifcations;

class NotificationController extends Controller
{
    protected $notifications;

    public function __construct(Notifcations $notifications)
    {
        $this->notifications = $notifications;
    }
    public function index() {
        return response()->json(Notifcations::all(), 200);
    }
    public function show($id)
	{
        $notifications = Notifcations::find($id);
	    return response()->json($notifications, 200);
	}
    public function create(Request $request)
    {
        $notification = Notifications::create([
            'type' => $request->type,
            'content' => $request->content,
        ]);

        return response()->json($notification, 201);
    }
    public function update(Request $request, $id)
	{
        $notifcation = Notifications::find($id)->update([
            'type' => $request->type,
            'content' => $request->content,
        ]);
	    return response()->json(['success'=>'Notifcation Updated Successfully!'], 200);
	}
}

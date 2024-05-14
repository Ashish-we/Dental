<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function getNotificationsData(Request $request)
    {
        // For the sake of simplicity, assume we have a variable called
        // $notifications with the unread notifications. Each notification
        // have the next properties:
        // icon: An icon for the notification.
        // text: A text for the notification.
        // time: The time since notification was created on the server.
        // At next, we define a hardcoded variable with the explained format,
        // but you can assume this data comes from a database query.

        // $notifications = [
        //     [
        //         'icon' => 'fas fa-fw fa-envelope',
        //         'text' => rand(0, 10) . ' new messages',
        //         'time' => rand(0, 10) . ' minutes',
        //     ],
        //     [
        //         'icon' => 'fas fa-fw fa-users text-primary',
        //         'text' => rand(0, 10) . ' friend requests',
        //         'time' => rand(0, 60) . ' minutes',
        //     ],
        //     [
        //         'icon' => 'fas fa-fw fa-file text-danger',
        //         'text' => rand(0, 10) . ' new reports',
        //         'time' => rand(0, 60) . ' minutes',
        //     ],
        // ];
        $notifications = Auth::user()->unreadNotifications;
        // dd($notifications);
        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            // dd($not->created_at->format('Y-m-d'));
            // dd($not->data['id']);
            $icon = "<i class='mr-2 fas fa-fw fa-file text-danger'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                       {$not->created_at->format('Y-m-d')}
                     </span>";

            $dropdownHtml .= "<a href='" . route('notifications.read', ['id' => $not->id]) . "' class='dropdown-item'>
                     {$icon}{$not->data['data']}{$time}
                   </a>";


            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label' => count($notifications),
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ];
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function markANotificationAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->unreadNotifications->where('id', $id)->first();

        if ($notification) {
            // dd($notification);
            $notification->markAsRead();
            $id = $notification->data['id'];
            return redirect('appointments/' . $id);
        } else {
            return redirect()->route('tasks.index');
        }
    }
}

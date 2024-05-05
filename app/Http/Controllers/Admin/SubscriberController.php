<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\GeneralAnnouncement;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index() {
        $restaurantName = auth()->user()->restaurant_name;
        $subscribers = Subscriber::where('restaurant_name',$restaurantName)->get(); // Fetch all subscribers
        return view('admin.subscriber.index', compact('subscribers'));
    }
    public function emailForm() {
        return view('admin.subscriber.email');
    }
    public function show($id){
        $restaurantName = auth()->user()->restaurant_name;
        $subscriber = Subscriber::where('restaurant_name',$restaurantName)->where('id',$id)->first();
        return view('admin.subscriber.show', compact('subscriber'));

    }
    public function sendEmailToAll(Request $request) {
        $this->validate($request, [
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new GeneralAnnouncement($request->subject, $request->message));
        }

        return redirect()->back()->with('success', 'Emails have been sent successfully!');
    }

}

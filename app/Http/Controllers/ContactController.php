<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Mail\Contact_usMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function unreadMessage()
    {
        // Count unread messages
        $unreadMessages = Contact::where('unreadMessage',false)->count();
        
        // Pass the count to the topnavigation view
        return view('admin.topnavigation', ['unreadMessage' => $unreadMessages]);
    }

    // public function markAsRead($id)
    // {
    //     // Find the message by its ID
    //     $message = Contact::find($id);
        
    //     if ($message) {
    //         // Update the 'is_read' field to true
    //         $message->unreadMessages = true;
    //         $message->save();
            
    //         return redirect()->back()->with('status', 'Message marked as read.');
    //     }

    //     return redirect()->back()->with('error', 'Message not found.');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $msgs=Contact::get();
        return view('admin.messages',compact('msgs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)            //store messages and send it in mailhog in the same time
    {
        $messages=['firstName.required'=>'Please enter your firstName',
        'lastName.required'=>'Please enter your lastName',
        'email.required'=>'Please add your email',
        'content' => 'Type your message'
    ];
    $request->validate([
        'firstName'=>'required|string|max:225',
        'lastName'=>'required|string|max:225',
        'email'=>'required|email',
        'content' => 'required|string|min:8'
    ],$messages);
        $msgs=new Contact();
        $msgs->firstName=$request->firstName;
        $msgs->lastName=$request->lastName;
        $msgs->email=$request->email;
        $msgs->content=$request->content;
        $msgs->save();
         $msg = Contact::latest()->first();
        Mail::to('admin@gmail.com')->send(new Contact_usMail($msg));
        return view('emails.msg');
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
{
    $msg = Contact::find($id);
    if ($msg) {
        $msg->unreadMessage = true;
        $msg->save(); 
        $unreadMessages = Contact::where('unreadMessage', true)->count();
        return view('admin.showMessage', [
            'message' => $msg,
            'unreadMessageCount' => $unreadMessages
        ]);
    } else {
        return redirect()->back()->with('error', 'Message not found');
    }
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $msg=Contact::find($id)->delete();
        return redirect('admin/messages');

    }
    public function showDeleted(){
        $msg=Contact::onlyTrashed()->get();
        return view('admin.messageTrashed',compact('msg'));
     }


     public function restore(Request $request){
        $id=$request->id;
        Contact::where('id',$id)->restore();
        return redirect('/admin/messages');
     }  
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class mailbox_controller extends Controller
{

    public function fill_native_categories(User $user)
    {
        $categories = [
            'inbox',
            'draft',
            'sent',
            'starred',
            'archive',
            'spam',
            'trash',
            'all_mail',
        ];
        
        foreach ($categories as $category) {
            $user->categories()->create([
                'name' => $category,
                'native' => true,
            ]);
        }
        // cette partie sera à supprimer 
        $category = Category::where('name', 'inbox')->first(); // Assuming emails should be created in the inbox category

        for ($i = 1; $i <= 3; $i++){
            $category->emails()->create([
                'sender_user_id' => 1,
                'receiver_user_id' => $user->id,
                'cc_user_id',
                'bcc_user_id',
                'object' => 'Abonnement',
                'content' => 'votre compte est...',
                'sent_at' => now(),
                'starred' => false,
                'attachment',
            ]);
        }
    }

    public function form_inbox()
    {
        $user = auth()->user(); // collect connected user
        if (!$user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $inbox_category = Category::where('name', 'inbox')->first();
        if ($inbox_category) {
            $inbox_emails = Email::where('category_id', $inbox_category->id)->get();
        } else {
            $inbox_emails = collect();
        }
        return view('mailbox/inbox',compact('inbox_emails'));
    }
    
    public function add_to_starred()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'starred')->first(); // collect starred category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to starred
        return redirect()->back();
    }

    public function add_to_archive()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'archive')->first(); // collect starred category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to archive
        return redirect()->back();
    }

    public function delete_email()
    {
        $email_id = request()->input('email_id'); // collect email id
        Email::where('id', $email_id)->delete(); // delete email
        return redirect()->back();
    }

    public function starred()
    {
        return view('mailbox/starred');
    }

    public function sent()
    {
        return view('mailbox/sent');
    }

    public function draft()
    {
        return view('mailbox/draft');
    }

    public function trash()
    {
        return view('mailbox/trash');
    }

    public function spam()
    {
        return view('mailbox/spam');
    }

    public function archive()
    {
        return view('mailbox/archive');
    }

    public function all()
    {
        return view('mailbox/all_mail');
    }
}

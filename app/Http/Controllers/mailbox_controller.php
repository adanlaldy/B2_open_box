<?php

namespace App\Http\Controllers;

use App\Mail\post_email;
use App\Models\category;
use App\Models\email;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class mailbox_controller extends Controller
{
    public function fill_native_categories(user $user)
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
        $category = category::where('name', 'inbox')->first(); // Assuming emails should be created in the inbox category

        for ($i = 1; $i <= 3; $i++) {
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

    public function form_inbox(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $inbox_category = category::where('name', 'inbox')->first();
        if ($inbox_category) {
            $inbox_emails = email::where('category_id', $inbox_category->id)->get();
        } else {
            $inbox_emails = collect();
        }

        return view('mailbox/inbox', compact('inbox_emails', 'user', 'language'));
    }

    public function form_starred(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $starred_category = category::where('name', 'starred')->first();
        if ($starred_category) {
            $starred_emails = email::where('category_id', $starred_category->id)->get();
        } else {
            $starred_emails = collect();
        }

        return view('mailbox/starred', compact('starred_emails', 'language'));
    }

    public function form_archive(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $archive_category = category::where('name', 'archive')->first();
        if ($archive_category) {
            $archive_emails = email::where('category_id', $archive_category->id)->get();
        } else {
            $archive_emails = collect();
        }

        return view('mailbox/archive', compact('archive_emails', 'language'));
    }

    public function form_trash(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $trash_category = category::where('name', 'trash')->first();
        if ($trash_category) {
            $trash_emails = email::where('category_id', $trash_category->id)->get();
        } else {
            $trash_emails = collect();
        }

        return view('mailbox/trash', compact('trash_emails', 'language'));
    }

    public function form_sent(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $sent_category = category::where('name', 'sent')->first();
        if ($sent_category) {
            $sent_emails = email::where('category_id', $sent_category->id)->get();
        } else {
            $sent_emails = collect();
        }

        return view('mailbox/sent', compact('sent_emails', 'language'));
    }

    public function form_draft(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $draft_category = category::where('name', 'draft')->first();
        if ($draft_category) {
            $draft_emails = email::where('category_id', $draft_category->id)->get();
        } else {
            $draft_emails = collect();
        }

        return view('mailbox/draft', compact('draft_emails', 'language'));
    }

    public function form_spam(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $spam_category = category::where('name', 'spam')->first();
        if ($spam_category) {
            $spam_emails = email::where('category_id', $spam_category->id)->get();
        } else {
            $spam_emails = collect();
        }

        return view('mailbox/spam', compact('spam_emails', 'language'));
    }

    public function form_all(Language $language)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $all_category = category::where('name', 'all_mail')->first();
        if ($all_category) {
            $all_emails = email::where('category_id', $all_category->id)->get();
        } else {
            $all_emails = collect();
        }

        return view('mailbox/all_mail', compact('all_emails', 'language'));
    }

    public function add_to_starred()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = category::where('name', 'starred')->first(); // collect starred category
        email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to starred

        return redirect()->back();
    }

    public function remove_from_starred()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = category::where('name', 'inbox')->first(); // collect inbox category
        email::where('id', $email_id)->update(['category_id' => $category->id]); // update email starred to inbox

        return redirect()->back();
    }

    public function add_to_archive()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = category::where('name', 'archive')->first(); // collect starred category
        email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to archive

        return redirect()->back();
    }

    public function remove_from_archive()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = category::where('name', 'inbox')->first(); // collect inbox category
        email::where('id', $email_id)->update(['category_id' => $category->id]); // update email starred to inbox

        return redirect()->back();
    }

    public function add_to_trash()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = category::where('name', 'trash')->first(); // collect starred category
        email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to trash

        return redirect()->back();
    }

    public function remove_from_trash()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = category::where('name', 'inbox')->first(); // collect inbox category
        email::where('id', $email_id)->update(['category_id' => $category->id]); // update email starred to inbox

        return redirect()->back();
    }

    public function delete_email()
    {
        $email_id = request()->input('email_id'); // collect email id
        email::where('id', $email_id)->delete(); // delete email

        return redirect()->back();
    }

    public function parameters()
    {
        return view('mailbox/parameters');
    }

    public function handling_post_email()
    {
        /*$email = request()->validate([
            'receiver' => ['required', 'email'],
            'object' => ['required'],
            'content' => ['required'],
        ]);

        $user = auth()->user();
        $category = category::where('user_id', $user->id)->first();
        $category->emails()->create([
            'sender_user_id' => $user->id,
            'receiver_user_id' => 0,
            'object' => $email['object'],
            'content' => $email['content'],
            'sent_at' => now(),
            'starred' => false,
            'attachment',
        ]);*/
        Mail::to('tony@test.mail')->send(new post_email());
        //return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    public function get_email_with_category($id_user, $id_category): array
    {
        $sql = "SELECT * FROM emails WHERE sender_user_id = '$id_user' AND category_id = '$id_category'";
        return DB::select($sql);
    }

    public function get_name_by_id($id): string
    {
        $sql = "SELECT first_name FROM users WHERE id = '$id'";
        return DB::select($sql)[0]->first_name;
    }

    public function form_starred()
    {
        $user = auth()->user(); // collect connected user
        if (!$user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $starred_category = Category::where('name', 'starred')->first();
        if ($starred_category) {
            $starred_emails = Email::where('category_id', $starred_category->id)->get();
        } else {
            $starred_emails = collect();
        }
        return view('mailbox/starred', compact('starred_emails'));
    }

    public function form_archive()
    {
        $user = auth()->user(); // collect connected user
        if (!$user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $archive_category = Category::where('name', 'archive')->first();
        if ($archive_category) {
            $archive_emails = Email::where('category_id', $archive_category->id)->get();
        } else {
            $archive_emails = collect();
        }
        return view('mailbox/archive', compact('archive_emails'));
    }

    public function get_category_id_by_name($name): int
    {
        $sql = "SELECT id FROM categories WHERE name = '$name'";
        return DB::select($sql)[0]->id;
    }

    public function form_trash()
    {
        $user = auth()->user(); // collect connected user
        if (!$user->categories()->where('native', true)->exists()) {
            $this->fill_native_categories($user);
        }
        $trash_category = Category::where('name', 'trash')->first();
        if ($trash_category) {
            $trash_emails = Email::where('category_id', $trash_category->id)->get();
        } else {
            $trash_emails = collect();
        }
        return view('mailbox/trash', compact('trash_emails'));
    }

    public function add_to_starred()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'starred')->first(); // collect starred category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to starred
        return redirect()->back();
    }

    public function remove_from_starred()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'inbox')->first(); // collect inbox category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email starred to inbox
        return redirect()->back();
    }

    public function add_to_archive()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'archive')->first(); // collect starred category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to archive
        return redirect()->back();
    }

    public function remove_from_archive()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'inbox')->first(); // collect inbox category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email starred to inbox
        return redirect()->back();
    }

    public function add_to_trash()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'trash')->first(); // collect starred category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email category to trash
        return redirect()->back();
    }

    public function remove_from_trash()
    {
        $email_id = request()->input('email_id'); // collect email id
        $category = Category::where('name', 'inbox')->first(); // collect inbox category
        Email::where('id', $email_id)->update(['category_id' => $category->id]); // update email starred to inbox
        return redirect()->back();
    }

    public function delete_email()
    {
        $email_id = request()->input('email_id'); // collect email id
        Email::where('id', $email_id)->delete(); // delete email
        return redirect()->back();
    }

    public function form_sent()
    {
        return view('mailbox/sent');
    }

    public function form_draft()
    {
        return view('mailbox/draft');
    }



    public function form_spam()
    {
        return view('mailbox/spam');
    }

    public function form_all()
    {
        return view('mailbox/all_mail');
    }

    public function parameters()
    {
        return view('mailbox/parameters');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\PostEmail;
use App\Models\Category;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailboxController extends Controller
{
    public function fillNativeCategories()
    {
        $categories = [
            'inbox',
            'drafts',
            'sents',
            'starreds',
            'archives',
            'spams',
            'trashes',
            'all_mails',
        ];

        foreach ($categories as $category) {
            Category::create([
                'user_id' => null,
                'name' => $category,
                'native' => true,
            ]);
        }

        /*// cette partie sera à supprimer
        $category = Category::where('name', 'inbox')->first(); // Assuming emails should be created in the inbox category

        for ($i = 1; $i <= 3; $i++) {
            $category->emails()->create([
                'from_user_id' => 1,
                'to_user_id' => $user->id,
                'cc_user_id',
                'bcc_user_id',
                'subject' => 'Abonnement',
                'content' => 'votre compte est...',
                'sent_at' => now(),
                'starred' => false,
                'attachment',
            ]);
        }*/
    }
    public function formInbox()
    {
        $user = auth()->user(); // collect connected user
        
        $nativeCategories = Category::where('native', true)->get();
        if ($nativeCategories->isEmpty()) {
            $this->fillNativeCategories($user);
        }

        $inboxCategory = Category::where('name', 'inbox')->first();
        if ($inboxCategory) {
            $inboxEmails = Email::where('category_id', $inboxCategory->id)->get();
        } else {
            $inboxEmails = collect();
        }

        return view('mailbox/inbox', compact('inboxEmails', 'user'));
    }

    public function formStarreds()
    {
        $user = auth()->user(); // collect connected user

        $starredCategory = Category::where('name', 'starreds')->first();
        if ($starredCategory) {
            $starredEmails = Email::where('category_id', $starredCategory->id)->get();
        } else {
            $starredEmails = collect();
        }

        return view('mailbox/starreds', compact('starredEmails'));
    }

    public function formArchives()
    {
        $user = auth()->user(); // collect connected user

        $archiveCategory = Category::where('name', 'archives')->first();
        if ($archiveCategory) {
            $archiveEmails = Email::where('category_id', $archiveCategory->id)->get();
        } else {
            $archiveEmails = collect();
        }

        return view('mailbox/archives', compact('archiveEmails'));
    }

    public function formTrashes()
    {
        $user = auth()->user(); // collect connected user

        $trashCategory = Category::where('name', 'trashes')->first();
        if ($trashCategory) {
            $trashEmails = Email::where('category_id', $trashCategory->id)->get();
        } else {
            $trashEmails = collect();
        }

        return view('mailbox/trashes', compact('trashEmails'));
    }

    public function formSents()
    {
        $user = auth()->user(); // collect connected user

        $sentCategory = Category::where('name', 'sents')->first();
        if ($sentCategory) {
            $sentEmails = Email::where('category_id', $sentCategory->id)->get();
        } else {
            $sentEmails = collect();
        }

        return view('mailbox/sents', compact('sentEmails'));
    }

    public function formDrafts()
    {
        $user = auth()->user(); // collect connected user

        $draftCategory = Category::where('name', 'drafts')->first();
        if ($draftCategory) {
            $draftEmails = Email::where('category_id', $draftCategory->id)->get();
        } else {
            $draftEmails = collect();
        }

        return view('mailbox/drafts', compact('draftEmails'));
    }

    public function formSpams()
    {
        $user = auth()->user(); // collect connected user

        $spamCategory = Category::where('name', 'spams')->first();
        if ($spamCategory) {
            $spamEmails = Email::where('category_id', $spamCategory->id)->get();
        } else {
            $spamEmails = collect();
        }

        return view('mailbox/spams', compact('spamEmails'));
    }

    public function formAllEmails()
    {
        $user = auth()->user(); // collect connected user

        $allCategory = Category::where('name', 'all_emails')->first();
        if ($allCategory) {
            $allEmails = Email::where('category_id', $allCategory->id)->get();
        } else {
            $allEmails = collect();
        }

        return view('mailbox/all_emails', compact('allEmails'));
    }

    public function addToStarreds()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'starreds')->first(); // collect starred category
        Email::where('id', $emailId)->update(['category_id' => $category->id]); // update email category to starred

        return redirect()->back();
    }

    public function removeFromStarreds()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'inbox')->first(); // collect inbox category
        Email::where('id', $emailId)->update(['category_id' => $category->id]); // update email starred to inbox

        return redirect()->back();
    }

    public function addToArchives()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'archives')->first(); // collect starred category
        Email::where('id', $emailId)->update(['category_id' => $category->id]); // update email category to archive

        return redirect()->back();
    }

    public function removeFromArchives()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'inbox')->first(); // collect inbox category
        Email::where('id', $emailId)->update(['category_id' => $category->id]); // update email starred to inbox

        return redirect()->back();
    }

    public function addToTrashes()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'trashes')->first(); // collect starred category
        Email::where('id', $emailId)->update(['category_id' => $category->id]); // update email category to trash

        return redirect()->back();
    }

    public function removeFromTrashes()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'inbox')->first(); // collect inbox category
        Email::where('id', $emailId)->update(['category_id' => $category->id]); // update email starred to inbox

        return redirect()->back();
    }

    public function deleteEmail()
    {
        $emailId = request()->input('emailId'); // collect email id
        Email::where('id', $emailId)->delete(); // delete email

        return redirect()->back();
    }

    public function parameters()
    {
        return view('mailbox/parameters');
    }

    public function handlingPostEmail()
    {
        // check if inputs are correctly filled
        $validatedData = request()->validate([
            'fromEmail' => ['required', 'email'],
            'toEmail' => ['required', 'email'],
            'ccEmail' => ['nullable', 'email'],
            'bccEmail' => ['nullable', 'email'],
            'subject' => ['nullable'],
            'content' => ['nullable'],
            'sentAt' => now(),
            'attachment' => ['nullable'],
        ]);

        // collect user ids from emails
        $fromUserId = User::where('email', $validatedData['fromEmail'])->value('id');
        $toUserId = User::where('email', $validatedData['toEmail'])->value('id');

        // check if required emails are valid
        if (!$fromUserId || !$toUserId) {
            return redirect()->back()->withErrors(['message' => 'L\email d\'envoi ou de réception n\'est pas valide.'])->withInput();
        }

        // check if cc and bcc emails are valid
        if ($validatedData['ccEmail'] !== null) {
            $ccUserId = User::where('email', $validatedData['ccEmail'])->value('id') ?? null;
            if (!$ccUserId) {
                return redirect()->back()->withErrors(['message' => 'L\'email de copie n\'existe pas.'])->withInput();
            }
        } else if ($validatedData['bccEmail'] !== null) {
            $bccUserId = User::where('email', $validatedData['bccEmail'])->value('id') ?? null;
            if (!$bccUserId) {
                return redirect()->back()->withErrors(['message' => 'L\'email de copie anonyme n\'existe pas.'])->withInput();
            }
        }

        // create new email
        $user = auth()->user();
        $category = Category::where('name', 'inbox')->first();
        $email = $category->emails()->create([
            'from_user_id' => $fromUserId,
            'to_user_id' => $toUserId,
            'cc_user_id' => $ccUserId ?? null,
            'bcc_user_id' => $bccUserId ?? null,
            'subject' => $validatedData['subject'] ?? '',
            'content' => $validatedData['content'] ?? '',
            'sent_at' => now(),
            'starred' => false,
            'attachment' => $validatedData['attachment'] ?? null,
        ]);

        // concat first name and last name
        $senderName = $user->first_name.' '.$user->last_name;

        // send email
        Mail::to($validatedData['toEmail'])->send(new PostEmail($validatedData['fromEmail'], $senderName, $email['subject'], $email['content']));

        return redirect()->back();
    }
}

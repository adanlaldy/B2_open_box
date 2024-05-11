<?php

namespace App\Http\Controllers;

use App\Mail\PostEmail;
use App\Models\Category;
use App\Models\Email;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
    }

    public function formInbox()
    {
        $user = auth()->user(); // collect connected user

        $nativeCategories = Category::where('native', true)->get();
        if ($nativeCategories->isEmpty()) {
            $this->fillNativeCategories($user);
        }

        $inboxCategory = Category::where('name', 'inbox')->first();
        $inboxEmails = Email::where('category_id', $inboxCategory->id)->where('to_user_id', $user->id)->get() ?? null;

        return view('mailbox/inbox', compact('inboxEmails', 'user'));
    }

    public function formStarreds()
    {
        $user = auth()->user(); // collect connected user

        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category
        $starredsEmails = Email::where('starred', true)
            ->whereDoesntHave('category', function (Builder $query) use ($trashesCategory) {
                $query->where('id', $trashesCategory->id);
            })
            ->where(function ($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->orWhere('to_user_id', $user->id);
            })
            ->get() ?? null; // collect starred emails

        return view('mailbox/starreds', compact('starredsEmails'));
    }

    public function formArchives()
    {
        $user = auth()->user(); // collect connected users

        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category
        $archivedsEmails = Email::where('archived', true)
            ->whereDoesntHave('category', function (Builder $query) use ($trashesCategory) {
                $query->where('id', $trashesCategory->id);
            })
            ->where(function ($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->orWhere('to_user_id', $user->id);
            })
            ->get() ?? null; // collect archiveds emails

        return view('mailbox/archives', compact('archivedsEmails'));
    }

    public function formTrashes()
    {
        $user = auth()->user(); // collect connected user

        $trashesCategory = Category::where('name', 'trashes')->first();
        $trashesEmails = Email::where('category_id', $trashesCategory->id)
            ->where(function ($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->orWhere('to_user_id', $user->id);
            })
            ->get() ?? null; // collect trashes emails

        return view('mailbox/trashes', compact('trashesEmails'));
    }

    public function formSents()
    {
        $user = auth()->user(); // collect connected user
        $sentsEmails = Email::where('from_user_id', $user->id)->get() ?? null; // collect sents emails

        return view('mailbox/sents', compact('sentsEmails'));
    }

    public function formDrafts()
    {
        $user = auth()->user(); // collect connected user

        $draftCategory = Category::where('name', 'drafts')->first();
        $draftEmails = Email::where('category_id', $draftCategory->id)->get() ?? null;

        return view('mailbox/drafts', compact('draftEmails'));
    }

    public function formSpams()
    {
        $user = auth()->user(); // collect connected user

        $spamCategory = Category::where('name', 'spams')->first();
        $spamEmails = Email::where('category_id', $spamCategory->id)->get() ?? null;

        return view('mailbox/spams', compact('spamEmails'));
    }

    public function formAllEmails()
    {
        $user = auth()->user(); // collect connected user

        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category
        $allEmails = Email::where(function ($query) use ($user) {
            $query->where('from_user_id', $user->id)
                ->orWhere('to_user_id', $user->id);
        })
            ->whereDoesntHave('category', function (Builder $query) use ($trashesCategory) {
                $query->where('id', $trashesCategory->id);
            })
            ->get() ?? null; // collect all emails sent or received by the user

        return view('mailbox/all_emails', compact('allEmails'));
    }

    public function addToStarreds()
    {
        $emailId = request()->input('emailId'); // collect email id
        Email::where('id', $emailId)->update(['starred' => true]); // update boolean starred to true

        return redirect()->back();
    }

    public function removeFromStarreds()
    {
        $emailId = request()->input('emailId'); // collect email id
        Email::where('id', $emailId)->update(['starred' => false]); // update boolean starred to false

        return redirect()->back();
    }

    public function addToArchives()
    {
        $emailId = request()->input('emailId'); // collect email id
        Email::where('id', $emailId)->update(['archived' => true]); // update boolean archived to true

        return redirect()->back();
    }

    public function removeFromArchives()
    {
        $emailId = request()->input('emailId'); // collect email id
        Email::where('id', $emailId)->update(['archived' => false]); // update boolean archived to false

        return redirect()->back();
    }

    public function addToTrashes()
    {
        $emailId = request()->input('emailId'); // collect email id
        $category = Category::where('name', 'trashes')->first(); // collect trashes category
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
        if (! $fromUserId || ! $toUserId) {
            return redirect()->back()->withErrors(['message' => 'L\email d\'envoi ou de réception n\'est pas valide.'])->withInput();
        }

        // check if cc and bcc emails are valid
        if ($validatedData['ccEmail'] !== null) {
            $ccUserId = User::where('email', $validatedData['ccEmail'])->value('id') ?? null;
            if (! $ccUserId) {
                return redirect()->back()->withErrors(['message' => 'L\'email de copie n\'existe pas.'])->withInput();
            }
        } elseif ($validatedData['bccEmail'] !== null) {
            $bccUserId = User::where('email', $validatedData['bccEmail'])->value('id') ?? null;
            if (! $bccUserId) {
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
            'archived' => false,
            'attachment' => $validatedData['attachment'] ?? null,
        ]);

        // concat first name and last name
        $senderName = $user->first_name.' '.$user->last_name;

        // send email
        Mail::to($validatedData['toEmail'])->send(new PostEmail($validatedData['fromEmail'], $senderName, $email['subject'], $email['content']));

        return redirect()->back();
    }
}

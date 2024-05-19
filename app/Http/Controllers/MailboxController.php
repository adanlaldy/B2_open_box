<?php

namespace App\Http\Controllers;

use App\Mail\PostEmail;
use App\Models\Category;
use App\Models\Email;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class MailboxController extends Controller
{
    public function fillNativeCategories(): void
    {
        $categories = [
            'inbox',
            'drafts',
            'sents',
            'starreds',
            'archives',
            'spams',
            'trashes',
            'all_emails',
        ];

        foreach ($categories as $category) {
            Category::create([
                'user_id' => null,
                'name' => $category,
                'native' => true,
            ]);
        }
    }

    public function formInbox(string $locale): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user(); // collect connected user

        $nativeCategories = Category::where('native', true)->get();
        if ($nativeCategories->isEmpty()) {
            $this->fillNativeCategories($user);
        }

        $inboxCategory = Category::where('name', 'inbox')->first(); // collect inbox category
        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category

        $inboxEmails = Email::where('category_id', $inboxCategory->id)
            ->whereDoesntHave('category', function (Builder $query) use ($trashesCategory) {
                $query->where('id', $trashesCategory->id);
            })
            ->where('to_user_id', $user->id)
            ->get() ?? null; // collect inbox emails

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/inbox', compact('inboxEmails', 'user'));
    }

    public function formStarreds(string $locale)
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

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/starreds', compact('starredsEmails'));
    }

    public function formArchives(string $locale)
    {
        $user = auth()->user(); // collect connected users

        $archivesCategory = Category::where('name', 'archives')->first(); // collect archives category
        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category

        $archivedsEmails = Email::where('category_id', $archivesCategory->id)
            ->whereDoesntHave('category', function (Builder $query) use ($trashesCategory) {
                $query->where('id', $trashesCategory->id);
            })
            ->where(function ($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->orWhere('to_user_id', $user->id);
            })
            ->get() ?? null; // collect archiveds emails

        return view('mailbox/archives', compact('archivedsEmails'));
        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/archives', compact('archiveEmails'));
    }

    public function formTrashes(string $locale)
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
        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/trashes', compact('trashEmails'));
    }

    public function formSents(string $locale)
    {
        $user = auth()->user(); // collect connected user

        $sentsCategory = Category::where('name', 'sents')->first(); // collect sents category
        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category

        $sentsEmails = Email::where('category_id', $sentsCategory->id)
            ->whereDoesntHave('category', function (Builder $query) use ($trashesCategory) {
                $query->where('id', $trashesCategory->id);
            })
            ->where('from_user_id', $user->id)
            ->get() ?? null; // collect inbox emails

        return view('mailbox/sents', compact('sentsEmails'));
        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/sents', compact('sentEmails'));
    }

    public function formDrafts(string $locale)
    {
        $user = auth()->user(); // collect connected user

        $draftCategory = Category::where('name', 'drafts')->first();
        $draftEmails = Email::where('category_id', $draftCategory->id)->get() ?? null;

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/drafts', compact('draftEmails'));
    }

    public function formSpams(string $locale)
    {
        $user = auth()->user(); // collect connected user

        $spamCategory = Category::where('name', 'spams')->first();
        $spamEmails = Email::where('category_id', $spamCategory->id)->get() ?? null;

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/spams', compact('spamEmails'));
    }

    public function formAllEmails(string $locale)
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

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

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
        $email = Email::where('id', $emailId)->first(); // collect email
        $archivesCategory = Category::where('name', 'archives')->first(); // collect archives category

        $email->update(['category_id' => $archivesCategory->id, 'previous_category_id' => $email->category_id]); // update email category to archives and previous category

        return redirect()->back();
    }

    public function removeFromArchives()
    {
        $emailId = request()->input('emailId'); // collect email id
        $email = Email::where('id', $emailId)->first(); // collect email

        $email->update(['category_id' => $email->previous_category_id]); // update email category to previous category

        return redirect()->back();
    }

    public function addToTrashes()
    {
        $emailId = request()->input('emailId'); // collect email id
        $email = Email::where('id', $emailId)->first(); // collect email
        $trashesCategory = Category::where('name', 'trashes')->first(); // collect trashes category

        $email->update(['category_id' => $trashesCategory->id, 'previous_category_id' => $email->category_id]); // update email category to trashes and previous category

        return redirect()->back();
    }

    public function removeFromTrashes()
    {
        $emailId = request()->input('emailId'); // collect email id
        $email = Email::where('id', $emailId)->first(); // collect email

        $email->update(['category_id' => $email->previous_category_id]); // update email category to previous category

        return redirect()->back();
    }

    public function deleteEmail()
    {
        $emailId = request()->input('emailId'); // collect email id
        Email::where('id', $emailId)->delete(); // delete email

        return redirect()->back();
    }

    public function handlingPostEmail()
    {
        $user = auth()->user();

        // check if inputs are correctly filled
        $validatedData = request()->validate([
            'fromEmail' => ['required', 'email'],
            'toEmail' => ['required', 'email'],
            'ccEmail' => ['nullable'],
            'bccEmail' => ['nullable'],
            'subject' => ['nullable'],
            'content' => ['nullable'],
            'sentAt' => now(),
            'attachment' => ['nullable'],
        ]);

        // collect user ids from emails
        $fromUserId = User::where('email', $validatedData['fromEmail'])->where('id', $user->id)->value('id');
        $toUserId = User::where('email', $validatedData['toEmail'])->value('id');

        // check if required emails are valid
        if (! $fromUserId || ! $toUserId) {
            return redirect()->back()->withErrors(['message' => 'L\email d\'envoi ou de réception n\'est pas valide.'])->withInput();
        }

        // check if cc and bcc emails are valid
        if ($validatedData['ccEmail'] !== null) {
            $ccEmails = explode(' ', $validatedData['ccEmail']); // to separate emails
            foreach ($ccEmails as $ccEmail) {
                $ccUserId = User::where('email', $ccEmail)->value('id') ?? null;
                if (! $ccUserId) {
                    return redirect()->back()->withErrors(['message' => 'Une ou plusieurs emails de copie n\'existent pas.'])->withInput();
                } 
            }
        } 
        if ($validatedData['bccEmail'] !== null) {
            foreach ($validatedData['bccEmail'] as $bccEmail) {
                $bccUserId = User::where('email', $validatedData['bccEmail'])->value('id') ?? null;
                if (! $bccUserId) {
                    return redirect()->back()->withErrors(['message' => 'Une ou plusieurs emails de copie anonyme n\'existent pas.'])->withInput();
                } 
            }
        }

        // create new email
        $category = Category::where('name', 'inbox')->first();
        $email = $category->emails()->create([
            'user_id' => $toUserId,
            'from_user_id' => $fromUserId,
            'to_user_id' => $toUserId,
            'subject' => $validatedData['subject'] ?? "",
            'content' => $validatedData['content'] ?? "",
            'sent_at' => now(),
            'starred' => false,
            'attachment' => $validatedData['attachment'] ?? null,
            'previous_category_id' => $category->id,
        ]);

        // concat first name and last name
        $senderName = $user->first_name.' '.$user->last_name;

        // send email
        //Mail::to($validatedData['toEmail'])/*->cc($ccList)*/->send(new PostEmail($validatedData['fromEmail'], $senderName, $email['subject'], $email['content']));

        // clone for local user email
        $category = Category::where('name', 'sents')->first();
        $email = $category->emails()->create([
            'user_id' => $user->id,
            'from_user_id' => $fromUserId,
            'to_user_id' => $toUserId,
            'cc_list_id' => $ccUserId ?? null,
            'bcc_list_id' => $bccUserId ?? null,
            'subject' => $validatedData['subject'] ?? '',
            'content' => $validatedData['content'] ?? '',
            'sent_at' => now(),
            'starred' => false,
            'attachment' => $validatedData['attachment'] ?? null,
            'previous_category_id' => $category->id,
        ]);

        // send email
        //Mail::to($validatedData['fromEmail'])->send(new PostEmail($validatedData['fromEmail'], $senderName, $email['subject'], $email['content']));

        return redirect()->back();
    }

    public function handlingReplyEmail()
    {
        $user = auth()->user(); // collect connected user
    }
}

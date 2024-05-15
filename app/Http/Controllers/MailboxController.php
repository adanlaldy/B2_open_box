<?php

namespace App\Http\Controllers;

use App\Mail\PostEmail;
use App\Models\Category;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class MailboxController extends Controller
{
    public function fillNativeCategories(User $user)
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
            $user->categories()->create([
                'name' => $category,
                'native' => true,
            ]);
        }

        // cette partie sera à supprimer
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
        }
    }

    public function formInbox(string $locale)
    {
        $user = auth()->user(); // collect connected user

        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $inboxCategory = Category::where('name', 'inbox')->first();
        if ($inboxCategory) {
            $inboxEmails = Email::where('category_id', $inboxCategory->id)->get();
        } else {
            $inboxEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/inbox', compact('inboxEmails', 'user'));
    }

    public function formStarreds(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $starredCategory = Category::where('name', 'starreds')->first();
        if ($starredCategory) {
            $starredEmails = Email::where('category_id', $starredCategory->id)->get();
        } else {
            $starredEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/starreds', compact('starredEmails'));
    }

    public function formArchives(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $archiveCategory = Category::where('name', 'archives')->first();
        if ($archiveCategory) {
            $archiveEmails = Email::where('category_id', $archiveCategory->id)->get();
        } else {
            $archiveEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/archives', compact('archiveEmails'));
    }

    public function formTrashes(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $trashCategory = Category::where('name', 'trashes')->first();
        if ($trashCategory) {
            $trashEmails = Email::where('category_id', $trashCategory->id)->get();
        } else {
            $trashEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);


        return view('mailbox/trashes', compact('trashEmails'));
    }

    public function formSents(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $sentCategory = Category::where('name', 'sents')->first();
        if ($sentCategory) {
            $sentEmails = Email::where('category_id', $sentCategory->id)->get();
        } else {
            $sentEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/sents', compact('sentEmails'));
    }

    public function formDrafts(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $draftCategory = Category::where('name', 'drafts')->first();
        if ($draftCategory) {
            $draftEmails = Email::where('category_id', $draftCategory->id)->get();
        } else {
            $draftEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/drafts', compact('draftEmails'));
    }

    public function formSpams(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $spamCategory = Category::where('name', 'spams')->first();
        if ($spamCategory) {
            $spamEmails = Email::where('category_id', $spamCategory->id)->get();
        } else {
            $spamEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

        return view('mailbox/spams', compact('spamEmails'));
    }

    public function formAllEmails(string $locale)
    {
        $user = auth()->user(); // collect connected user
        if (! $user->categories()->where('native', true)->exists()) {
            $this->fillNativeCategories($user);
        }

        $allCategory = Category::where('name', 'all_emails')->first();
        if ($allCategory) {
            $allEmails = Email::where('category_id', $allCategory->id)->get();
        } else {
            $allEmails = collect();
        }

        if (! in_array($locale, ['en', 'es', 'fr', 'de', 'ru', 'cn'])) {
            abort(400);
        }
        App::setLocale($locale);

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
        $toUserId = User::where('email', $validatedData['toEmail'])->value('id');
        $ccUserId = $validatedData['ccEmail'] ? User::where('email', $validatedData['ccEmail'])->value('id') : null;
        $bccUserId = $validatedData['bccEmail'] ? User::where('email', $validatedData['bccEmail'])->value('id') : null;

        // create new email
        $user = auth()->user();
        $category = Category::where('user_id', $user->id)->first();
        $email = $category->emails()->create([
            'from_user_id' => $user->id,
            'to_user_id' => $toUserId,
            'cc_user_id' => $ccUserId,
            'bcc_user_id' => $bccUserId,
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

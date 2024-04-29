<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;

class mailbox_controller extends Controller
{
    public function inbox(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->fill();
        return view('mailbox/inbox');
    }

    public function starred(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mailbox/starred');
    }

    public function sent(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mailbox/sent');
    }

    public function draft(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mailbox/draft');
    }

    public function trash(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mailbox/trash');
    }

    public function spam(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mailbox/spam');
    }

    public function archive(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('mailbox/archive');
    }


    public function create_table_mail(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS mail (
            id SERIAL PRIMARY KEY,
            id_category INTEGER NOT NULL,
            id_user INTEGER NOT NULL,
            cc VARCHAR NOT NULL,
            cci VARCHAR NOT NULL,
            subject VARCHAR NOT NULL,
            content TEXT NOT NULL,
            date_email DATE NOT NULL,
            is_read BOOLEAN NOT NULL,
            is_sent BOOLEAN NOT NULL,
            FOREIGN KEY (id_user) REFERENCES users(id)
        )";
        DB::statement($sql);
    }



    public function create_mail_category(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS category (
            id SERIAL PRIMARY KEY,
            name VARCHAR NOT NULL
        )";
        DB::statement($sql);
    }

    public function create_mail_array_category(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS category (
            id SERIAL PRIMARY KEY,
            id_user INTEGER NOT NULL,
            id_category INTEGER NOT NULL,
            id_mail INTEGER NOT NULL,
            FOREIGN KEY (id_user) REFERENCES users(id),
            FOREIGN KEY (id_category) REFERENCES category(id),
            FOREIGN KEY (id_mail) REFERENCES mail(id)
        )";
        DB::statement($sql);
    }

    public function add_mail_array_category($id_user, $id_category, $id_mail): void
    {
        $sql = "INSERT INTO category (id_user, id_category, id_mail) VALUES ('$id_user', '$id_category', '$id_mail')";
        DB::statement($sql);
    }

    public function add_mail_category($name): void
    {
        $sql = "INSERT INTO category (name) VALUES ('$name')";
        DB::statement($sql);
    }

    public function add_mail($id_category, $id_user, $cc, $cci, $subject, $content, $date_email, $is_read, $is_sent): void
    {
        $sql = "INSERT INTO mail (id_category, id_user, cc, cci, subject, content, date_email, is_read, is_sent) VALUES ('$id_category', '$id_user', '$cc', '$cci', '$subject', '$content', '$date_email', '$is_read', '$is_sent')";
        DB::statement($sql);
    }

    public function clear_mail_category(): void
    {
        $sql = "DELETE FROM category";
        DB::statement($sql);
    }
    public function fill(): void
    {
        $this->create_table_mail();
        $this->create_mail_category();
        $this->clear_mail_category();
        $this->clear_mail();
        $this->add_mail(1, 1, 'cc', 'cci', 'Abonnement', 'votre compte est...', '2024-10-10', true, true);
        $this->add_mail(5, 1, 'cc', 'cci', 'Maison', 'vous voulez peut etre...', '2024-10-10', true, true);
        $this->add_mail(2, 1, 'cc', 'cci', 'Voiture', 'votre voiture est...', '2024-10-10', true, true);
        $this->add_mail(1, 2, 'cc', 'cci', 'Travail', 'votre travail est...', '2024-10-10', true, true);
        $this->add_mail(3, 2, 'cc', 'cci', 'Travail', 'votre travail est...', '2024-10-10', true, true);
        $this->add_mail(1, 1, 'cc', 'cci', 'Ecole', 'votre ecole est...', '2024-10-10', true, true);

        $this->add_mail_category('draft');
        $this->add_mail_category('Trash');
        $this->add_mail_category('Sent');
        $this->add_mail_category('Starred');
        $this->add_mail_category('Spam');
        $this->add_mail_category('Archive');

    }

    public function get_mail($id_user): array
    {
        $sql = "SELECT * FROM mail WHERE id_user = '$id_user'";
        return DB::select($sql);
    }

    public function get_email_with_category($id_user, $id_category): array
    {
        $sql = "SELECT * FROM mail WHERE id_user = '$id_user' AND id_category = '$id_category'";
        return DB::select($sql);
    }

    public function clear_mail(): void
    {
        $sql = "DELETE FROM mail";
        DB::statement($sql);
    }

}

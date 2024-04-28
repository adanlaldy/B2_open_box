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
        $this->create_table_mail();
        $this->create_mail_category();
//        $this->clear_mail();
//        $this->fill();
        return view('mailbox/inbox');
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
            id_user INTEGER NOT NULL,
            name VARCHAR NOT NULL
        )";
        DB::statement($sql);
    }

    public function add_mail_category($id_user, $name): void
    {
        $sql = "INSERT INTO category (id_user, name) VALUES ('$id_user', '$name')";
        DB::statement($sql);
    }

    public function add_mail($id_category, $id_user, $cc, $cci, $subject, $content, $date_email, $is_read, $is_sent): void
    {
        $sql = "INSERT INTO mail (id_category, id_user, cc, cci, subject, content, date_email, is_read, is_sent) VALUES ('$id_category', '$id_user', '$cc', '$cci', '$subject', '$content', '$date_email', '$is_read', '$is_sent')";
        DB::statement($sql);
    }

    public function fill(): void
    {
        $this->create_table_mail();
        $this->create_mail_category();
        $this->add_mail_category(1, 'Inbox');
        $this->add_mail_category(1, 'Sent');
        $this->add_mail_category(1, 'Draft');
        $this->add_mail_category(1, 'Trash');
        $this->add_mail(1, 1, 'cc', 'cci', 'Abonnement', 'votre compte est...', '2024-10-10', true, true);
        $this->add_mail(1, 1, 'cc', 'cci', 'Maison', 'vous voulez peut etre...', '2024-10-10', true, true);
        $this->add_mail(1, 1, 'cc', 'cci', 'Voiture', 'votre voiture est...', '2024-10-10', true, true);
        $this->add_mail(1, 1, 'cc', 'cci', 'Travail', 'votre travail est...', '2024-10-10', true, true);
    }

    public function get_mail($id_user): array
    {
        $sql = "SELECT * FROM mail WHERE id_user = '$id_user'";
        return DB::select($sql);
    }

    public function clear_mail(): void
    {
        $sql = "DELETE FROM mail";
        DB::statement($sql);
    }

}

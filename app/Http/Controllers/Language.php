<?php

namespace App\Http\Controllers;

class Language
{
    public array $page_register;

    public array $page_login;

    public array $page_password_forget;

    public array $page_inbox;

    public array $page_404;

    public function __construct()
    {
        $this->english();
    }

    public function english(): void
    {
        $this->english_login();
        $this->english_inbox();
    }

    public function english_login()
    {
        $this->page_login = [
            'lang' => 'en',
            'title' => 'open_box',
            'login' => 'Login',
            'password' => 'Password',
            'connect' => 'connect',
            'email' => 'email',
            'forgot' => 'Password forget ?',
            'create_account' => 'Create account now !'];
    }

    public function english_inbox()
    {
        $this->page_inbox = [
            'lang' => 'en',
            'title' => 'inbox | open_box',

            'inbox' => 'Inbox',
            'star' => 'Starred',
            'sent' => 'Sent',
            'draft' => 'Draft',
            'trash' => 'Trash',
            'spam' => 'Spam',
            'archive' => 'Archive',
            'all_mail' => 'All mail',

            'parameters' => 'Parameters',
            'logout' => 'Logout',
            'subscription' => 'Subscription',

            'search' => 'Search',
            'search_placeholder' => 'Search for emails',

            'empty' => 'No email found',
            'new_email' => 'New email',

            'email' => 'Email',
            'subject' => 'Subject',
            'date' => 'Date',
            'delete' => 'Delete',
            'starred' => 'Starred',
            'archived' => 'Archived',

            'delete_confirmation' => 'Are you sure you want to delete this email?',
            'delete_confirmation_yes' => 'Yes',
            'delete_confirmation_no' => 'No',
            'delete_confirmation_title' => 'Delete email'];
    }

    public function french(): void
    {
        $this->french_login();
        $this->french_inbox();
    }

    public function french_login()
    {
        $this->page_login = [
            'lang' => 'fr',
            'title' => 'open_box',
            'login' => 'Connexion',
            'password' => 'Mot de passe',
            'connect' => 'connecter',
            'email' => 'email',
            'forgot' => 'Mot de passe oublié ?',
            'create_account' => 'Créer un compte maintenant !'];
    }

    public function french_inbox()
    {
        $this->page_inbox = [
            'lang' => 'fr',
            'title' => 'inbox | open_box',

            'inbox' => 'Boîte de réception',
            'star' => 'Favoris',
            'sent' => 'Envoyés',
            'draft' => 'Brouillons',
            'trash' => 'Corbeille',
            'spam' => 'Spam',
            'archive' => 'Archives',
            'all_mail' => 'Tous les mails',

            'parameters' => 'Paramètres',
            'logout' => 'Déconnexion',
            'subscription' => 'Abonnement',

            'search' => 'Rechercher',
            'search_placeholder' => 'Rechercher des emails',

            'empty' => 'Aucun email trouvé',
            'new_email' => 'Nouvel email',

            'email' => 'Email',
            'subject' => 'Sujet',
            'date' => 'Date',
            'delete' => 'Supprimer',
            'starred' => 'Favoris',
            'archived' => 'Archivé',

            'delete_confirmation' => 'Êtes-vous sûr de vouloir supprimer cet email ?',
            'delete_confirmation_yes' => 'Oui',
            'delete_confirmation_no' => 'Non',
            'delete_confirmation_title' => "Supprimer l'email"];
    }

    public function russian(): void
    {
        $this->russian_login();
        $this->russian_inbox();
    }

    public function russian_login()
    {
        $this->page_login = [
            'lang' => 'ru',
            'title' => 'open_box',
            'login' => 'Вход',
            'password' => 'Пароль',
            'connect' => 'соединять',
            'email' => 'электронное письмо',
            'forgot' => 'Забыли пароль ?',
            'create_account' => 'Создать аккаунт сейчас !'];
    }

    public function russian_inbox()
    {
        $this->page_inbox = [
            'lang' => 'ru',
            'title' => 'inbox | open_box',

            'inbox' => 'Входящие',
            'star' => 'Избранное',
            'sent' => 'Отправленные',
            'draft' => 'Черновики',
            'trash' => 'Мусор',
            'spam' => 'Спам',
            'archive' => 'Архив',
            'all_mail' => 'Все письма',

            'parameters' => 'Параметры',
            'logout' => 'Выйти',
            'subscription' => 'Подписка',

            'search' => 'Поиск',
            'search_placeholder' => 'Поиск по электронной почте',

            'empty' => 'Письма не найдены',
            'new_email' => 'Новое письмо',

            'email' => 'Электронное письмо',
            'subject' => 'Тема',
            'date' => 'Дата',
            'delete' => 'Удалить',
            'starred' => 'Избранное',
            'archived' => 'Архивировано',

            'delete_confirmation' => 'Вы уверены, что хотите удалить это письмо?',
            'delete_confirmation_yes' => 'Да',
            'delete_confirmation_no' => 'Нет',
            'delete_confirmation_title' => 'Удалить письмо'];
    }

    public function chinese(): void
    {
        $this->chinese_login();
        $this->chinese_inbox();
    }

    public function chinese_login()
    {
        $this->page_login = [
            'lang' => 'zh',
            'title' => 'open_box',
            'login' => '登录',
            'password' => '密码',
            'connect' => '连接',
            'email' => '电子邮件',
            'forgot' => '忘记密码？',
            'create_account' => '立即创建帐户！'];
    }

    public function chinese_inbox()
    {
        $this->page_inbox = [
            'lang' => 'zh',
            'title' => 'inbox | open_box',

            'inbox' => '收件箱',
            'star' => '加星标',
            'sent' => '已发送',
            'draft' => '草稿',
            'trash' => '垃圾箱',
            'spam' => '垃圾邮件',
            'archive' => '存档',
            'all_mail' => '所有邮件',

            'parameters' => '参数',
            'logout' => '登出',
            'subscription' => '订阅',

            'search' => '搜索',
            'search_placeholder' => '搜索电子邮件',

            'empty' => '未找到电子邮件',
            'new_email' => '新邮件',

            'email' => '电子邮件',
            'subject' => '主题',
            'date' => '日期',
            'delete' => '删除',
            'starred' => '加星标',
            'archived' => '已归档',

            'delete_confirmation' => '您确定要删除此电子邮件吗？',
            'delete_confirmation_yes' => '是',
            'delete_confirmation_no' => '否',
            'delete_confirmation_title' => '删除电子邮件'];
    }
}

@component('mail::message')

#Demande de changement de mot de passe

Vous avez demandé un changement de mot de passe sur l'application Prestò.

Pour continuer, cliquez sur le lien suivant:

@component('mail::button', ['url' => $link])
    Changer le mot de passe
@endcomponent

Merci

@endcomponent
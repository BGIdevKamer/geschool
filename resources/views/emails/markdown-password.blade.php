<x-mail::message>
    # Admission à la formation {{ $data['formation'] }} - Année scolaire {{ $data['annee_scolaire'] }}

    Cher(e) {{ $data['name'] }},
    Nous avons le plaisir de vous informer que votre demande d'admission à la formation {{ $data['formation'] }} pour l'année scolaire {{ $data['annee_scolaire'] }} a été acceptée.

    Vous trouverez ci-dessous vos informations de connexion à la plateforme de formation :

    * Adresse email : {{ $data['email'] }}
    * Mot de passe : {{ $data['password'] }}

    Vous pouvez accéder à la plateforme en cliquant sur le button Connexion

    Nous vous souhaitons une excellente année scolaire et vous encourageons à prendre contact avec nous si vous rencontrez le moindre problème.
    <x-mail::button :url="'http://127.0.0.1:8000/Participant-login'">
        Connextion
    </x-mail::button>


</x-mail::message>
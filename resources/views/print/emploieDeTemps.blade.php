<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/invoice.css" />
</head>
<style>
    * {
        margin: 0 auto;
        padding: 0 auto;
        user-select: none;
    }

    body {
        padding: 20px;
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        -webkit-font-smoothing: antialiased;
        background-color: #fff;
    }

    .wrapper-invoice {
        display: flex;
        justify-content: center;
    }

    .wrapper-invoice .invoice {
        height: auto;
        background: #fff;
        padding: 5vh;
        margin-top: 5vh;
        max-width: 110vh;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #fff;
    }


    .wrapper-invoice .invoice .invoice-information {
        float: right;
        text-align: right;
    }

    .wrapper-invoice .invoice .invoice-information b {
        color: "#0F172A";
    }

    .wrapper-invoice .invoice .invoice-information p {
        font-size: 2vh;
        color: gray;
    }

    .wrapper-invoice .invoice .invoice-logo-brand h2 {
        text-transform: uppercase;
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        font-size: 2.9vh;
        color: "#0F172A";
    }

    .wrapper-invoice .invoice .invoice-logo-brand img {
        max-width: 100px;
        width: 50%;
        object-fit: fill;
    }

    .wrapper-invoice .invoice .invoice-head {
        display: flex;
    }

    .wrapper-invoice .invoice .invoice-head .head {
        width: 100%;
        box-sizing: border-box;
    }

    .wrapper-invoice .invoice .invoice-head .client-info {
        text-align: left;
    }

    .wrapper-invoice .invoice .invoice-head .client-info h2 {
        font-weight: 500;
        letter-spacing: 0.3px;
        font-size: 2.5vh;
        color: "#0F172A";
    }

    .header-officiel .center p {
        text-align: center;
    }

    .header-officiel p {
        /* font-size: 1.5vh; */
        color: gray;
    }

    .header-officiel {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .wrapper-invoice .invoice .invoice-head .client-info p {
        font-size: 2vh;
        color: gray;
    }

    .wrapper-invoice .invoice .invoice-head .client-data {
        text-align: right;
    }

    .wrapper-invoice .invoice .invoice-head .client-data h2 {
        font-weight: 500;
        letter-spacing: 0.3px;
        font-size: 2vh;
        color: "#0F172A";
    }

    .wrapper-invoice .invoice .invoice-head .client-data p {
        font-size: 2vh;
        color: gray;
    }

    .wrapper-invoice .invoice .invoice-body {
        margin-top: 3vh;
    }

    .wrapper-invoice .invoice .invoice-body .table {
        border-collapse: collapse;
        width: 100%;
    }

    .wrapper-invoice .invoice .invoice-body .table thead tr th {
        font-size: 2vh;
        border: 1px solid #dcdcdc;
        text-align: left;
        padding: 1vh;
        background-color: #eeeeee;
    }

    .wrapper-invoice .invoice .invoice-body .table tbody tr td {
        font-size: 2vh;
        border: 1px solid #dcdcdc;
        text-align: left;
        padding: 1vh;
        background-color: #fff;
    }

    .wrapper-invoice .invoice .invoice-body .table tbody tr td:nth-child(2) {
        text-align: right;
    }

    .wrapper-invoice .invoice .invoice-body .flex-table {
        display: flex;
    }

    .wrapper-invoice .invoice .invoice-body .flex-table .flex-column {
        width: 100%;
        box-sizing: border-box;
    }

    .wrapper-invoice .invoice .invoice-body .flex-table .flex-column .table-subtotal {
        border-collapse: collapse;
        box-sizing: border-box;
        width: 100%;
        margin-top: 2vh;
    }

    .wrapper-invoice .invoice .invoice-body .flex-table .flex-column .table-subtotal tbody tr td {
        font-size: 2vh;
        border-bottom: 1px solid #dcdcdc;
        text-align: left;
        padding: 1vh;
        background-color: #fff;
    }

    .wrapper-invoice .invoice .invoice-body .flex-table .flex-column .table-subtotal tbody tr td:nth-child(2) {
        text-align: right;
    }

    .wrapper-invoice .invoice .invoice-body .invoice-total-amount {
        margin-top: 1rem;
    }

    .wrapper-invoice .invoice .invoice-body .invoice-total-amount p {
        font-weight: bold;
        color: "#0F172A";
        text-align: right;
        font-size: 2vh;
    }

    .wrapper-invoice .invoice .invoice-footer {
        margin-top: 4vh;
    }

    .wrapper-invoice .invoice .invoice-footer p {
        font-size: 1.7vh;
        color: gray;
    }

    .copyright {
        margin-top: 2rem;
        text-align: center;
    }

    .copyright p {
        color: gray;
        font-size: 1.8vh;
    }

    @media print {
        .table thead tr th {
            -webkit-print-color-adjust: exact;
            background-color: #eeeeee !important;
        }

        .copyright {
            display: none;
        }
    }

    .rtl {
        direction: rtl;
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    }

    .rtl .invoice-information {
        float: left !important;
        text-align: left !important;
    }

    .rtl .invoice-head .client-info {
        text-align: right !important;
    }

    .rtl .invoice-head .client-data {
        text-align: left !important;
    }

    .rtl .invoice-body .table thead tr th {
        text-align: right !important;
    }

    .rtl .invoice-body .table tbody tr td {
        text-align: right !important;
    }

    .rtl .invoice-body .table tbody tr td:nth-child(2) {
        text-align: left !important;
    }

    .rtl .invoice-body .flex-table .flex-column .table-subtotal tbody tr td {
        text-align: right !important;
    }

    .rtl .invoice-body .flex-table .flex-column .table-subtotal tbody tr td:nth-child(2) {
        text-align: left !important;
    }

    .rtl .invoice-body .invoice-total-amount p {
        text-align: left !important;
    }

    /*# sourceMappingURL=invoice.css.map */
</style>

<style>
    .header-table {
        text-align: center;
        font-size: 11px;
    }
</style>

<body>
    <section class="wrapper-invoice">
        <!-- switch mode rtl by adding class rtl on invoice class -->
        <div class="invoice">
            <table class="header-table table">
                <th>
                <td>REPUBLIC DU CAMEROUN <br> Paix-Travail-Patrie <br> ----- <br> MINISTERES DE L'ENSEIGNEMENT <br> SUPERIEUR</td>
                <td>
                    <div class="invoice-logo-brand">
                        <samp style="visibility: hidden;text-align: center;"> ------ </samp>
                        <img src="{{ public_path('storage/assets/identifies/'.$information.'') }}" alt="" />
                        <samp style="visibility: hidden;text-align: center;"> ------ </samp>
                    </div>
                    <div class="" style="visibility: hidden;text-align: center;">
                    </div>
                </td>
                <td>REPUBLIC OF CAMEROON <br> Peace-Work-Fatherland <br> ----- <br> MINISTRY OF HIGHER EDUCATION</td>
                </th>
            </table>
            <br>
            <table class="header-table" style="border-collapse: collapse;">
                <th>
                <td>
                    <h2 style="text-decoration: underline;">{{$Emploie->titre}}</h2>
                    <h2 style="text-decoration: underline;">{{$Emploie->Formation->nom}} - {{$Emploie->anneeScolaire}}</h2>
                </td>
                </th>
            </table>
            <br> <br>
            <div class="invoice-body">
                <table class="table">
                    <thead>
                        <th style="color: rgb(73, 64, 64);padding: 10px 0px;">Heures</th>
                        <th style="color: #dcdcdc;background-color:rgb(73, 64, 64);padding: 5px 0px;">Lundi</th>
                        <th style="color: #dcdcdc;background-color:rgb(73, 64, 64);padding: 5px 0px;">Mardi</th>
                        <th style="color: #dcdcdc;background-color:rgb(73, 64, 64);padding: 5px 0px;">Mercredi</th>
                        <th style="color: #dcdcdc;background-color:rgb(73, 64, 64);padding: 5px 0px;">Jeudi</th>
                        <th style="color: #dcdcdc;background-color:rgb(73, 64, 64);padding: 5px 0px;">Vendredi</th>
                        <th style="color: #dcdcdc;background-color:rgb(73, 64, 64);padding: 5px 0px;">Samedi</th>
                    </thead>
                    @foreach($heures as $heure)
                    <tr>
                        <td style="font-weight: 200;font-size: 14px;text-align: center;padding: 2px 0px;">{{$heure->heure_debut}}H{{$heure->min_debut}} - {{$heure->heure_fin}}H{{$heure->min_fin}}</td>
                        @if(isset($sessions[$heure->id]))
                        @foreach($sessions[$heure->id] as $session)
                        @if($session->cpp == 0)
                        <td style="font-weight: 400;font-size: 13px;padding:0px 4px;text-align: center;padding: 2px 0px;">
                            <strong>{{$session->Matiere->libeller}}</strong><br>
                            {{$session->Enseigant->nom}} {{$session->Enseigant->prenom}} - <strong>{{$session->Salle->nom}}</strong><br>
                        </td>
                        @elseif($session->cpp == 1)
                        <td style="font-weight: 200; background-color: chocolate;font-size: 13px;color: white;text-align: center;padding: 2px 0px;">Pause</td>
                        @else
                        <td style="font-weight: 200; background-color: blue;font-size: 13px;color: white;text-align: center;padding: 2px 0px;">Permanence</td>
                        @endif
                        @endforeach
                        @else
                        <td></td> {{-- Cellule vide si aucune session pour cette heure --}}
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div> <br> <br>
            <table>
                <tr>
                    <td>
                        <p style="font-size: 15px;font-weight: 50;">{{$Emploie->note}} <br> <br> Valide du <strong>{{$Emploie->date_debut}}</strong> au <strong>{{$Emploie->date_fin}}</strong> </p>
                    </td>
                    <td>
                        <h1 style="visibility: hidden;text-align: center;">hkfskhfshkfskhf</h1>
                    </td>
                    <td>
                        <h3>Signature</h3>
                    </td>
                </tr>
            </table>

        </div>
    </section>


</body>

</html>
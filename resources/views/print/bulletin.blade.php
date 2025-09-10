<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        A Simple Invoice Template Responsive and clean with HTML CSS SCSS
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

            @foreach($identify as $identifie)

            <table class="header-table table">
                <th>
                <td>REPUBLIC DU CAMEROUN <br> Paix-Travail-Patrie <br> ----- <br> MINISTERES DE L'ENSEIGNEMENT <br> SUPERIEUR</td>
                <td>
                    <div class="invoice-logo-brand">
                        <samp style="visibility: hidden;text-align: center;"> ------ </samp>
                        <img src="{{ public_path('assets/identifies/'.$identifie->logo.'') }}" alt="" />
                        <samp style="visibility: hidden;text-align: center;"> ------ </samp>
                    </div>
                    <div class="" style="visibility: hidden;text-align: center;">
                    </div>
                </td>
                <td>REPUBLIC OF CAMEROON <br> Peace-Work-Fatherland <br> ----- <br> MINISTRY OF HIGHER EDUCATION</td>
                </th>
            </table>

            <table class="table">
                <tr>
                    <td>
                        <h2>{{$identifie->raisonSocial}}</h2>
                        <h2>Bulletin de note</h2>
                        <p>Bp : <b>{{$identifie->Bp}}</b></p>
                        <p>Effectif : <b>{{$data[0]['effectif']}}</b></p>
                        @endforeach
                    </td>
                    <td>
                    <td>
                        <div class="invoice-logo-brand">
                            <samp style="visibility: hidden;text-align: center;"> ------ </samp>
                            <img style="visibility: hidden;text-align: center;" src="{{ public_path('storage/assets/identifies/'.$identifie->logo.'') }}" alt="" />
                            <samp style="visibility: hidden;text-align: center;"> ------ </samp>
                        </div>
                        <div class="" style="visibility: hidden;text-align: center;">
                        </div>
                    </td>
                    </td>
                    <td>
                        @foreach($participants as $participant)
                        <div class="head client-data">

                            <p>Nom de l'eleve : <b>{{$participant->Participant->nom}} {{$participant->Participant->prenom}}</b></p>
                            <p>Ne le : <b> {{$participant->Participant->dateN}}</b></p>
                            <p>Age : <b>{{$participant->Participant->age}} ans</b> sexe : <b>{{$participant->Participant->sexe}}</b> </p>
                            <p>Année scolaire : <b>{{$participant->anneeScolaire}}</b></p>
                            <p>Classe : <b>{{$participant->Formation->nom}}</b></p>
                        </div>
                        @endforeach
                    </td>
                </tr>
            </table>

            <br>

            <!-- <div class="header-officiel">
                <div class="center">
                    <p><b>MINISTERE DES ENSEIGNEMENT SECONDAIRE <br> MINISTRY OF SECONDARY EDUCATION</b></p>
                </div>
            </div>
            <br> -->

            <!-- <div class="invoice-head">
                <div class="head client-info">
                    <div class="right">
                        <p>Republic of cameroon <br> peace-work-fatherland</p>
                    </div> <br>
                    @foreach($identify as $identifie)
                    <h2>{{$identifie->raisonSocial}}</h2>
                    <h2>Bulletin de note</h2>
                    <p>Bp : <b>{{$identifie->Bp}}</b></p>
                    <p>Effectif : <b>{{$data[0]['effectif']}}</b></p>
                    @endforeach
                </div>
                @foreach($participants as $participant)
                <div class="head client-data">
                    <div class="right">
                        <p>Republic of cameroon <br> peace-work-fatherland</p>
                    </div> <br>
                    <p>Nom de l'eleve : <b>{{$participant->Participant->nom}} {{$participant->Participant->prenom}}</b></p>
                    <p>Ne le : <b> {{$participant->Participant->dateN}}</b></p>
                    <p>Age : <b>{{$participant->Participant->age}} ans</b> sexe : <b>{{$participant->Participant->sexe}}</b> </p>
                    <p>Année scoalire : <b>{{$participant->anneeScolaire}}</b></p>
                    <p>Classe : <b>{{$participant->Formation->nom}}</b></p>
                </div>
                @endforeach
            </div> -->
            <!-- invoice body-->
            <div class="invoice-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Matiere</th>
                            <th>Note</th>
                            <th>Coeffiecien</th>
                            <th>Cote x coeff</th>
                            <th>Appreciation</th>
                            <th>MG</th>
                            <th>%</th>
                            <th>Min</th>
                            <th>Max</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($Categories as $categorie)
                        @foreach($bulletinData as $Data)
                        @if($Data['categorie'] == $categorie['id'])
                        <tr>
                            <td>{{$Data['libelle']}} | <em><strong>{{$Data['enseigant']}}</strong></em> </td>
                            <td>{{$Data['note_obtenue_non_coefficient']}}</td>
                            <td>{{$Data['coef']}}</td>
                            <td>{{$Data['note_obtenue_coefficient']}}</td>
                            <td>{{$Data['appreciation']}}</td>
                            <td>{{$Data['moyenne_generale']}}</td>
                            <td>{{$Data['pourcentage_reussite']}}</td>
                            <td>{{$Data['min']}}</td>
                            <td>{{$Data['max']}}</td>
                        </tr>
                        @endif
                        @endforeach
                        <thead>
                            <tr>
                                <th colspan="9">{{$categorie['libelle']}} | Total : {{$categorie['sum']}} Points | Moyennne : {{$categorie['moy']}}</span></th>
                            </tr>
                        </thead>
                        @endforeach
                        <br>
                        <thead>
                            <tr>
                                <th>Resumer du travail</th>
                                <th>{{$data[0]['Evaluation']}}</th>
                                @if(!empty($prevData)) <th style="padding-left: 15px;">Rappel {{$prevData[0]['evaluation']}}</th> @endif
                            </tr>
                        </thead>
                        <tr>
                            <td>Total points</td>
                            <td>{{$data[0]['totalPoints']}}</td>
                            @if(!empty($prevData)) <td style="padding-left: 15px;">{{$prevData[0]['totalPoints']}}</td> @endif
                        </tr>
                        <tr>
                            <td>Total coefficients</td>
                            <td>{{$data[0]['totalCoefficients']}}</td>
                            @if(!empty($prevData)) <td style="padding-left: 15px;">{{$prevData[0]['totalCoefficients']}}</td> @endif
                        </tr>
                        <tr>
                            <td>Moyenne de l'eleve</td>
                            <td>{{$data[0]['moy']}}</td>
                            @if(!empty($prevData)) <td style="padding-left: 15px;">{{$prevData[0]['moy']}}</td> @endif
                        </tr>
                        <tr>
                            <td>Rang de l'eleve</td>
                            <td>{{$data[0]['rank']}}è / {{$data[0]['effectif']}}</td>
                            @if(!empty($prevData))<td style="padding-left: 15px;">{{$prevData[0]['rank']}}è</td>@endif
                        </tr>
                        <tr>
                            <td>Appreciat travail</td>
                            <td>{{$data[0]['appreciation']}}</td>
                            @if(!empty($prevData)) <td style="padding-left: 15px;">{{$prevData[0]['appreciation']}}</td>@endif
                        </tr>
                        <tr>
                            <td>Tableu d'honneur</td>
                            <td>{{$data[0]['Tn']}}</td>
                            @if(!empty($prevData))<td style="padding-left: 15px;">{{$prevData[0]['tn']}}</td>@endif
                        </tr>
                        <tr>
                            <td>Moyenne du premier</td>
                            <td>{{$data[0]['max_moy']}}</td>
                            @if(!empty($prevData))<td style="padding-left: 15px;">{{$prevData[0]['max_moy']}}</td>@endif
                        </tr>
                        <tr>
                            <td>Moyenne du dernier</td>
                            <td>{{$data[0]['min_moy']}}</td>
                            @if(!empty($prevData))<td style="padding-left: 15px;">{{$prevData[0]['min_moy']}}</td>@endif
                        </tr>
                        <tr>
                            <td>Moy.Géné.classe</td>
                            <td>{{$data[0]['moy_general']}}</td>
                        </tr>
                        <tr>
                            <td>Nbr moy >= 10</td>
                            <td>{{$data[0]['nbr_supA1O']}}</td>
                        </tr>
                        <tr>
                            <td>% de Reussite</td>
                            <td>{{$data[0]['taux_reussite']}}%</td>
                        </tr>
                        <tr>
                            <td>Ecart Type</td>
                            <td>{{$data[0]['ecart_type']}}</td>
                        </tr>
                        <thead>
                            <tr>
                                <th>Dicipline</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>Absences non justi</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sanction de conduite</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Consigne en H</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Conseil de dicipline</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Exclusion en j</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table> <br>

                <table class="table">
                    <tr>
                        <td> <br> <br> <br> <br></td>
                        <td></td>
                    </tr>
                </table>

            </div>

</body>

</html>
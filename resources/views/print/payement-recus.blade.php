<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Recus de payement
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
</head>

<style>
    @import "https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap";

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
        max-width: 80px !important;
        width: 100%;
        object-fit: fill;
    }

    .wrapper-invoice .invoice .invoice-head {
        display: flex;
        margin-top: 8vh;
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
        font-size: 2vh;
        color: "#0F172A";
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
        margin-top: 8vh;
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
            /* -webkit-print-color-adjust: exact; */
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

<body>
    @foreach($payPrint as $pay)
    <section class="wrapper-invoice">

        <!-- switch mode rtl by adding class rtl on invoice class -->
        <div class="invoice">

            <div class="invoice-information">
                <p><b>Recus #</b> : {{$pay->id}}</p>
                <p><b>Date de creation </b>: {{$pay->pay_date}}</p>
                <p><b>Date de payement</b> : {{$pay->pay_date}}</p>
            </div>

            @foreach($identify as $identif)
            <!-- logo brand invoice -->
            <div class="invoice-logo-brand">
                <!-- <h2>Tampsh.</h2> -->
                <img src="{{ $logoBase64 }}" alt="Logo" />
            </div>
            <br>
            <!-- invoice head -->
            <div class="invoice-head">
                <div class="head client-info">
                    <p>{{$identif->raisonSocial}}.</p>
                    <p>{{$identif->adress}}</p>
                    <p>{{$identif->ville}}</p>
                    <p>{{$identif->Bp}}</p>
                    <p>{{$identif->telephone}}</p>
                </div>
                @endforeach
                <div class="head client-data">

                    <p>-</p>
                    <p>{{$pay->FormationParticipant->Participant->nom}} {{$pay->FormationParticipant->Participant->prenom}}</p>
                    <p>{{$pay->FormationParticipant->Formation->nom}} @if(!empty($pay->FormationParticipant->niv)) {{$pay->FormationParticipant->niv}} @endif</p>
                    <p>Anneé scolaire : {{$pay->FormationParticipant->anneeScolaire}}</p>
                </div>
                <br>
                <div class="head client-info">
                    <p>Delivré par : <strong>{{Auth::user()->name}}</strong> le <strong>{{$pay->pay_date}}</strong></p>
                </div>
            </div>

            <br>
            <!-- invoice body-->
            <div class="invoice-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Motifs</th>
                            <th>Montants</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$pay->motif}}</td>
                            <td>{{$pay->montant}} Fcfa</td>
                        </tr>
                        <tr>
                            <td>Reste a payé</td>
                            <td>{{$reste}} Fcfa</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div class="flex-table">
                    <div class="flex-column"></div>
                    <div class="flex-column">
                        <table class="table-subtotal">
                            <tbody>
                                <tr>
                                    <td>total a payer</td>
                                    <td>{{$prix}}.000 Fcfa</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- invoice total  -->
                <div class="invoice-total-amount">
                    <p>Signature</p>
                </div>
            </div>
            <!-- invoice footer -->
        </div>
    </section>
    @endforeach
</body>

</html>
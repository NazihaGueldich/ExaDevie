<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css">
    <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
    <script src="script.js"></script>

    <style>
        /* reset */
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        /* content editable */
        *[contenteditable] {
            border-radius: 0.25em;
            min-width: 1em;
            outline: 0;
        }

        *[contenteditable] {
            cursor: pointer;
        }

        *[contenteditable]:hover,
        *[contenteditable]:focus,
        td:hover *[contenteditable],
        td:focus *[contenteditable],
        img.hover {
            background: #def;
            box-shadow: 0 0 1em 0.5em #def;
        }

        span[contenteditable] {
            display: inline-block;
        }

        /* heading */
        h1 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font: bold 50%;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            width: 100%;
            font-size: 75%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        th,
        td {
            border: 0.5px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #eee;
            border-color: #000;
        }


        /* page */
        html {
            font: 16px/1 "Open Sans", sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
        }

        body {
            background: #fff;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        /* header */
        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            border-radius: 0.25em;
            color: #000000;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;

        }

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */
        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */
        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;

            display: table;
        }

        /* table meta */
        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */
        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 15%;
            text-align: center;

        }

        table.inventory td:nth-child(2) {
            width: 15%;
            text-align: center;

        }

        table.inventory td:nth-child(3) {
            text-align: center;
            width: 15%;
        }

        table.inventory td:nth-child(4) {
            text-align: center;
            width: 15%;
        }

        table.inventory td:nth-child(5) {
            text-align: center;
            width: 15%;
        }

        table.inventory td:nth-child(6) {
            text-align: center;
            width: 15%;
        }


        /* table balance */
        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */
        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        /* javascript */
        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: 0.8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut {
            background: #9af;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00adee 5%, #0078a5 100%);
            background-image: -webkit-linear-gradient(#00adee 5%, #0078a5 100%);
            border-radius: 0.5em;
            border-color: #0076a3;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add {
            margin: -2.5em 0 0;
        }

        .add:hover {
            background: #00adee;
        }

        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        tr:hover .cut {
            opacity: 1;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
        }

        address.left {
            text-align: left;

        }

        address.right {
            text-align: right;
            margin-left: 40%;
        }
    </style>
</head>

<body>
    <header>
        <h1 class="mb-5"> Bon de commende</h1>


        <address contenteditable class="left">
            <img src="data:image/jpeg;base64,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"
                alt="QR Code" width="100">
        </address>
        <address contenteditable class="left">
            <div style="margin-right: 8%">
                <p>{{ $parameter->nom }}</p>
                <p>{{ $parameter->adresse }}</p>
                <p>{{ $parameter->tel }}</p>
                <p>{{ $parameter->email }}</p>
                <p>{{ $parameter->mf }}</p>
            </div>

        </address>

    </header>
    <article>
        <address contenteditable style="font-weight: 300;font-size:15px">
            <p>Client:</p>
            <p>M(e).{{ $facture->devis->clients->nom }} {{ $facture->devis->clients->prenom }}</p>
            <p>
                {{ $facture->devis->clients->adresse }}
            </p>
            <p>{{ $facture->devis->clients->tel }}</p>
            <p>{{ $facture->devis->clients->email }}</p>
        </address>
        
        <address contenteditable class="left" style="margin-left:60%;font-size:16px;font-family: Georgia, serif;">
            <p>Date: <span contenteditable>{{ $facture->created_at->format('Y-m-d') }}</span> </p>
        </address>
        <br>
        <div  style="font-size:15px; margin-top: 15%;margin-bottom: 3%;">
            <h4>Sujet:</h4><br>
            <p> {{ $facture->sujet }}</p>
        </div>

        <table class="inventory">
            <thead>

                <tr>
                    <th><span contenteditable>Type</span></th>
                    <th><span contenteditable>Informations</span></th>
                    <th><span contenteditable>Prix unitaire</span></th>
                    <th><span contenteditable>prix Totale</span></th>
                    <th><span contenteditable>TVA</span></th>
                    <th><span contenteditable>THT</span></th>
                    <th><span contenteditable>PTTTC</span></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($ligniefactures as $ligniefacture)
                    <tr>
                        <td><span contenteditable>
                                @if ($ligniefacture->type == 0)
                                    Produits
                                @else
                                    Services
                                @endif
                            </span></td>
                        <td><span contenteditable>
                                @if ($ligniefacture->type == 0)
                                    <strong>Nom: </strong> {{ $ligniefacture->produits->nom }}
                                    <br>
                                    <strong>Quantité: </strong>{{ $ligniefacture->quantiter }}
                                @else
                                    <strong>Designiation: </strong><br>
                                    {{ $ligniefacture->designiation }}
                                @endif
                            </span></td>
                        <td><span contenteditable>{{ $ligniefacture->prix }} DT</span><span contenteditable>DT</span></td>
                        <td><span contenteditable>{{ $ligniefacture->prixT }} DT</span><span contenteditable>DT</span>
                        </td>
                        <td>
                            <span contenteditable>{{ $ligniefacture->tva }}%</span><span contenteditable>%</span>
                        </td>
                        <td>
                            <span contenteditable>{{ $ligniefacture->tht }} DT</span><span contenteditable>DT</span>
                        </td>
                        <td>
                            <span contenteditable>{{ $ligniefacture->ptttc }} DT</span><span contenteditable>DT</span>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th><span contenteditable>Total HT</span></th>
                <td><span contenteditable>{{ $facture->MTHT }}</span><span contenteditable> DT</span></td>
            </tr>

            <tr>
                <th><span contenteditable>Total TVA</span></th>
                <td><span contenteditable>{{ $facture->MT }}</span><span contenteditable> DT</span></td>
            </tr>

            <tr>
                <th><span contenteditable>Total</span></th>
                <td><span contenteditable>{{ $facture->MTTTC }}</span><span contenteditable> DT</span></td>

            </tr>
        </table>


    </article>

</body>

</html>

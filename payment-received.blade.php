<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thank You</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500;700&display=swap" rel="stylesheet">
<!--<link rel="stylesheet preload prefetch" as="style" crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">-->
    <link rel="stylesheet preload prefetch" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ url('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('img/favicon/favicon-16x16.png') }}">

    <link rel="manifest" href="{{ url('img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ url('css/reset.css') }}">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/media.css') }}">
</head>
<body>
<section class="widget-overlay">
    <div class="brand">
        <a href="{{ ($data->checkout_configs->page_link && (!isset($data->checkout_configs->set_defaults) || $data->checkout_configs->set_defaults != '1')) ? $data->checkout_configs->page_link : url('/') }}" target="_blank">
            <img src="{{ ($data->checkout_configs->logo && (!isset($data->checkout_configs->set_defaults) || $data->checkout_configs->set_defaults != '1')) ? $data->checkout_configs->logo : url('img/logo.svg') }}" width="102" height="24" alt="Logo">
        </a>
    </div>
    <div class="thank_you_main">
        <div class="widget-main thank-you-main w-100">
            <div class="thank_you_img">
                <img src="{{ url('img/general/thank_you.svg') }}" height="60" width="60" alt="Logo">
            </div>
            <div class="thank-you-headline">
                <h1>
                    Thank you!
                </h1>
            </div>
            <div class="thank-you-subheadline">
                @php
                    $status = true;
                @endphp
                @foreach($data->data->txs as $tx)
                    @if($tx->status == 'pending')
                        @php
                            $status = false;
                        @endphp
                    @endif
                @endforeach
                <p>
                    @if($status)
                        Your payment has been processed
                    @else
                        Your payment is being processed
                    @endif
                </p>
            </div>
            <div class="final-table">
                <table class="w-100">
                    <tr>
                        @if($data->type == 'api')
                            <td class="bold-title">Order Number</td>
                        @else
                            <td>Invoice Number</td>
                        @endif
                        <td>{{ $data->data->order_id }}</td>
                    </tr>

                    @foreach($data->data->txs as $tx)

                        <tr class="top-line">
                            <td class="bold-title"> Transaction - {{ $loop->index+1 }} </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td> Status </td>
                            <td> {{ $tx->status }} </td>
                        </tr>
                        <tr>
                            <td> TXID </td>
                            <td>
                                <a  target="_blank" href="{{ $tx->block_explorer }}" title="{{ $tx->txid }}">{{ substr_replace($tx->txid, " ... ", 8) }}{{ substr($tx->txid, -5)  }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td> Amount </td>
                            <td> {{ rtrim(rtrim(sprintf('%.8F', $tx->amount / pow( 10, $tx->decimal)), '0'), ".") }} </td>
                        </tr>
                        <tr>
                            <td> Currency </td>
                            <td> {{ $tx->currency }} </td>
                        </tr>
                        <tr>
                            <td> Fiat amount </td>
                            <td> {{ $tx->fiat_amount }} {{ $tx->fiat_currency }}</td>
                        </tr>

                        <tr>
                            <td> Date and Time </td>
                            <td> {{ $tx->date }} </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="top-line pt-5">
                        <td class="bold-title">Order amount</td>
                        <td>{{ $data->data->order_amount }} {{ $data->data->fiat_currency }}</td>
                    </tr>
                    <tr class="non-top-line">
                        <td class="bold-title">Total Deposited</td>
                        <td>{{ $data->data->total_fiat_amount }} {{ $data->data->fiat_currency }}</td>
                    </tr>
                    @if($data->data->order_amount - $data->data->total_fiat_amount > 0)
                        <tr class="non-top-line">
                            <td class="bold-title padding-0">Balance Due</td>
                            <td class="padding-0">{{ $data->data->order_amount - $data->data->total_fiat_amount }} {{ $data->data->fiat_currency }}</td>
                        </tr>
                    @endif
                </table>
                @php($percentage = $data->data->total_fiat_amount * 100 / $data->data->order_amount)
                <hr>
                <div class="percentage_thank_you">
                    <div class="">
                        <div class="box-headline ss-mt-15">
                            @if($percentage >= 100)
                                <h3>Total deposited</h3>
                            @endif
                        </div>
                        <div class="percentage-bar-overlay">
                            <div class="percentage-box w-100">
                                <div class="percentage-bar" data-width="{{ $percentage > 10 ? round($percentage) : $percentage }}%">
                                    <div class="bar-overlay">
                                        <div class="bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="rate">
                                <p class="">
                                    {{ $data->data->total_fiat_amount }}
                                    &nbsp;<span>/ {{ $data->data->order_amount }} {{ $data->data->fiat_currency }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cards">
                    <div class="thank-you-button">
                        <a href="{{ $data->checkout_page_url }}" class="vs-buttons"> Back to checkout / Pay remaining balance </a>
                    </div>
                    @if($data->type == 'api')
                        <div class="thank-you-button">
                            <a href="{{ $data->redirect_url }}" class="vs-buttons"> Return to Store </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    try {
        let percentage_bar = document.querySelector('.percentage-bar'),
            bar = document.querySelector('.bar'),
            bar_width = percentage_bar.getAttribute('data-width');
        bar.style.maxWidth = bar_width

    } catch (e) {}
</script>
</body>
</html>

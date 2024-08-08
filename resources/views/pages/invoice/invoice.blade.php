<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <title>Invoice Template</title>
    <style>
        /* Custom CSS */
        body {
            font-family: Helvetica, sans-serif;
            font-size: 13px;
        }

        .container {
            max-width: 680px;
            margin: 0 auto;
            border: 2px solid #000; /* Add border here */
            padding: 20px; /* Optional: Add some padding around the content */
            position: relative;
        }

        .logotype {
            color: #fff;
            width: 75px;
            height: 75px;
            line-height: 75px;
            text-align: center;
            font-size: 11px;
        }

        .column-title {
            background: #eee;
            text-transform: uppercase;
            padding: 15px 5px 15px 15px;
            font-size: 11px
        }

        .column-detail {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .column-header {
            background: #eee;
            text-transform: uppercase;
            padding: 15px;
            font-size: 11px;
            border-right: 1px solid #eee;
        }

        .row {
            padding: 7px 14px;
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .alert {
            background: #ffd9e8;
            padding: 20px;
            margin: 20px 0;
            line-height: 22px;
            color: #333
        }

        .socialmedia {
            background: #eee;
            padding: 20px;
            display: inline-block
        }

        .download-button {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            text-align: center;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* If using an 'a' tag */
        }

        .download-button:hover {
            background-color: #0056b3;
        }
        .print-button {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            text-align: center;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* If using an 'a' tag */
        }

        .print-button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
<div class="container" id="print">

    <table width="100%">
        <tr>
            <td width="75px">
                <div>
                    <img class="logotype" src="{{ \App\Models\Logo::whereIs_active(true)->first() ?  asset('admin/logo/'. \App\Models\Logo::whereIs_active(true)->first()->logo) : asset('assets/images/logo/def_logo.png') }}">
                </div>
            </td>
            <td width="300px">
                <div
                    style="background: #ffd9e8;border-left: 15px solid #fff;padding-left: 30px;font-size: 26px;font-weight: bold;letter-spacing: -1px;height: 73px;line-height: 75px;">
                    Order invoice
                </div>
            </td>
            <td></td>
        </tr>
    </table>
    <br><br>
    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="50%" style="background:#eee;padding:20px;">
                <strong>Date:</strong> {{ $order->created_at }}<br>
                <strong>Payment type:</strong> {{ $order->payment_type }}<br>
            </td>
            <td style="background:#eee;padding:20px;">
                <strong>Order-code:</strong> {{ $order->order_code }}<br>
                <strong>E-mail:</strong> {{ $order->user->email }}<br>
                <strong>Phone:</strong> {{ $order->billingDetail->phone }}<br>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td>
                <table>
                    <tr>
                        <td style="vertical-align: text-top;">
                            <div style="background: #ffd9e8 url('{{ asset('assets/images/logo/delivery.png') }}'); width: 50px; height: 50px; margin-right: 10px; background-position: center; background-size: 42px; background-repeat: no-repeat"></div>
                        </td>

                        <td>
                            <strong>Delivery</strong><br>
                            {{ $order->billingDetail->name }}<br>
                            {!! nl2br(e($order->billingDetail->address1)) !!}<br>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td style="vertical-align: text-top;">
                            <div style="background: #ffd9e8 url('{{ asset('assets/images/logo/delivery.png') }}'); width: 50px; height: 50px; margin-right: 10px; background-position: center; background-size: 42px; background-repeat: no-repeat"></div>
                        </td>
                        <td>
                            <strong>Delivery</strong><br>
                            {{ $order->billingDetail->name }}<br>
                            {!! nl2br(e($order->billingDetail->address1)) !!}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <div
        style="background: #ffd9e8 url('{{ asset('assets/images/logo/product.png') }}') no-repeat;width: 50px;height: 50px;margin-right: 10px;background-position: center;background-size: 25px;float: left; margin-bottom: 15px;"></div>
    <h3>Your Products</h3>

    <table width="100%" style="border-collapse: collapse;border-bottom:1px solid #eee;">
        <tr>
            <td width="40%" class="column-header">Products</td>
            <td width="20%" class="column-header">Quantity</td>
            <td width="20%" class="column-header">Price</td>
            <td width="20%" class="column-header">Total</td>
        </tr>
        @foreach($items as $item)
            <tr>
                <td class="row"><span
                        style="color:#777;font-size:11px;">#64000L</span><br>{{ $item->cart->product->name }}</td>
                <td class="row">{{ $item->cart->quantity }}</td>
                <td class="row">{{ $item->cart->quantity }} <span style="color:#777">X</span> {{ $item->cart->price }}
                    TK
                </td>
                <td class="row">{{ $item->cart->total_price }} TK</td>
            </tr>
        @endforeach
    </table>
    <br>
    <table width="100%" style="background:#eee;padding:20px;">
        <tr>
            <td>
                <table width="300px" style="float:right">
                    @isset($order->discount)
                    <tr>
                        <td><strong>Discount:</strong></td>
                        <td style="text-align:right">{{ $order->discount }}%</td>
                    </tr>
                    @endisset
                    <tr>
                        <td><strong>Sub-total:</strong></td>
                        <td style="text-align:right">{{ $order->total_charge }} TK</td>
                    </tr>
                    <tr>
                        <td><strong>Shipping fee:</strong></td>
                        <td style="text-align:right">0 TK</td>
                    </tr>
                    <tr>
                        <td><strong>Grand total:</strong></td>
                        <td style="text-align:right">{{ $order->total_charge }} TK</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<button id="downloadButton" class="download-button">Download Invoice</button>
<a href="javascript:void(0);" class="print-button" onclick="printInvoice()">Print Invoice</a>
<!-- container -->
</body>
</html>

<script>
    function printInvoice() {
        var printContent = document.getElementById("print").innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();

        // Restore the original content after printing
        document.body.innerHTML = originalContent;
    }
</script>
<script>
    document.getElementById('downloadButton').addEventListener('click', function () {
        var element = document.getElementById('print');
        html2pdf(element, {
            margin: 10,
            filename: 'invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: true, dpi: 192, letterRendering: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        });
    });
</script>



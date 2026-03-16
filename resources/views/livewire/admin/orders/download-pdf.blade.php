<div class="pdf-container">
    <!-- Header with Company Branding -->
    <div class="pdf-header">
        <div class="header-top">
            <div class="company-info">
                <h1>AJM COMPANY</h1>
                <p class="company-tagline">Your Trusted Partner in Excellence</p>
            </div>
            <div class="report-badge">
                <span class="badge-primary">SALES REPORT</span>
            </div>
        </div>
        <div class="header-bottom">
            <div class="date-info">
                <i class="fa-solid fa-calendar-alt"></i>
                <span><strong>Date Generated:</strong> {{ now()->format('F j, Y') }}</span>
                <span class="time"><strong>Time:</strong> {{ now()->format('g:i A') }}</span>
            </div>
            <div class="report-id">
                <span><strong>Report ID:</strong> SR-{{ now()->format('Ymd') }}-{{ rand(1000, 9999) }}</span>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="pdf-card">
        <div class="card-header">
            <h3><i class="fa-solid fa-chart-line"></i> Product Sales Report Details</h3>
            <div class="header-actions">
                <span class="print-date">Printed: {{ now()->format('F j, Y g:i A') }}</span>
            </div>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th width="12%">Transaction Code</th>
                    <th width="10%">Buyer</th>
                    <th width="12%">Product Name</th>
                    <th width="8%">Price</th>
                    <th width="7%">Qty</th>
                    <th width="12%">Color & Size</th>
                    <th width="8%">Total</th>
                    <th width="10%">Payment Method</th>
                    <th width="8%">Status</th>
                    <th width="13%">Date Order</th>
                </tr>
            </thead>
            <tbody>
                @php $rowNumber = 1; @endphp
                @foreach ($orders as $order)
                    <tr class="{{ $rowNumber % 2 == 0 ? 'even-row' : 'odd-row' }}">
                        <td>
                            <span class="transaction-code">{{ $order->transaction_code }}</span>
                        </td>
                        <td>
                            <div class="buyer-info">
                                <span class="buyer-name">{{ $order->user->name }}</span>
                            </div>
                        </td>
                        <td class="text-capitalize">
                            <span class="product-name">{{ $order->product->product_name }}</span>
                        </td>
                        <td class="price-column d-flex gap-1">
                            <span class="currency">P</span>{{ number_format($order->order_price, 2) }}
                        </td>
                        <td class="quantity-column">
                            <span class="quantity-badge">{{ number_format($order->order_quantity) }}</span>
                            <span class="unit">pcs</span>
                        </td>
                        <td>
                            @if ($order->hasVariation())
                                <div class="variation-container">
                                    @if ($order->productColor)
                                        <span class="variation-item color-variation">
                                            <i class="fa-solid fa-palette"></i>
                                            <span class="variation-label">Color:</span>
                                            <span
                                                class="variation-value">{{ Str::upper($order->productColor->name) }}</span>
                                        </span>
                                    @endif
                                    @if ($order->productSize)
                                        <span class="variation-item size-variation">
                                            <i class="fa-solid fa-ruler"></i>
                                            <span class="variation-label">Size:</span>
                                            <span
                                                class="variation-value">{{ Str::upper($order->productSize->name) }}</span>
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="na-badge">N/A</span>
                            @endif
                        </td>
                        <td class="total-column">
                            <span class="total-amount">P{{ number_format($order->order_total_amount, 2) }}</span>
                        </td>
                        <td>
                            <span class="payment-method">
                                <i
                                    class="fa-solid fa-{{ $order->order_payment_method === 'Cash on Delivery' ? 'truck' : 'credit-card' }}"></i>
                                {{ $order->order_payment_method }}
                            </span>
                        </td>
                        <td class="status-column">
                            @if ($order->order_status === 'Pending')
                                <span class="status-badge pending">
                                    <i class="fa-solid fa-clock"></i> PENDING
                                </span>
                            @else
                                <span class="status-badge paid">
                                    <i class="fa-solid fa-check-circle"></i> PAID
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="date-container">
                                <span class="date">{{ date_format($order->created_at, 'M d, Y') }}</span>
                                <span class="time">{{ date_format($order->created_at, 'g:i A') }}</span>
                            </div>
                        </td>
                    </tr>
                    @php $rowNumber++; @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr class="footer-row">
                    <td colspan="4" class="footer-label">
                        <strong>Summary Statistics</strong>
                    </td>
                    <td class="footer-stat">
                        <span class="stat-label">Total Qty:</span>
                        <span class="stat-value">{{ $orders->sum('order_quantity') }}</span>
                    </td>
                    <td colspan="2" class="footer-total">
                        <span class="total-label">GRAND TOTAL:</span>
                        <span class="total-value">P{{ number_format($grandTotal, 2) }}</span>
                    </td>
                    <td colspan="3" class="footer-extra">
                        <span style="font-size: 12px; color: black;">
                            <i class="fa-solid fa-chart-bar"></i>
                            Avg: P{{ number_format($orders->count() > 0 ? $grandTotal / $orders->count() : 0, 2) }}
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Additional Information -->
        <div class="table-footer-info">
            <div class="info-left">
                <p><i class="fa-solid fa-info-circle"></i> This report includes all sales transactions from
                    {{ $orders->first() ? date_format($orders->first()->created_at, 'M d, Y') : 'N/A' }} to
                    {{ $orders->last() ? date_format($orders->last()->created_at, 'M d, Y') : 'N/A' }}</p>
            </div>
            <div class="info-right">
                <div class="signature-area">
                    <span class="generated-by">Generated by: <strong>{{ Auth::user()?->name }}</strong></span>
                    <span class="signature">_________________________</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="pdf-footer">
        <div class="footer-content">
            <div class="footer-left">
                <span class="company-name">AJM COMPANY</span>
                <span class="footer-divider">|</span>
                <span class="footer-address">123 Business Ave, Manila, Philippines</span>
            </div>
            <div class="footer-right">
                <span class="page-number">Page 1 of 1</span>
                <span class="footer-divider">|</span>
                <span class="confidential">CONFIDENTIAL</span>
            </div>
        </div>
    </div>
</div>

<!-- Styles for PDF -->
<style>
    /* Global Styling */
    body {
        font-family: 'Helvetica', 'Arial', sans-serif;
        font-size: 9px;
        line-height: 1.5;
        margin: 0;
        padding: 0;
        background: #f4f7fa;
    }

    .pdf-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px 25px;
        background: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    /* Header Styling */
    .pdf-header {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #3498db;
        background: linear-gradient(to right, #f8faff, #ffffff);
        padding: 15px 20px;
        border-radius: 8px 8px 0 0;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .company-info h1 {
        color: #2c3e50;
        margin: 0;
        font-size: 24px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .company-tagline {
        color: #7f8c8d;
        margin: 3px 0 0 0;
        font-size: 11px;
        font-style: italic;
    }

    .report-badge .badge-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 2px 5px rgba(52, 152, 219, 0.3);
    }

    .header-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 10px;
    }

    .date-info i,
    .date-info .time {
        margin-left: 15px;
    }

    .date-info .time {
        color: #7f8c8d;
    }

    .report-id {
        background: #e9ecef;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    /* Summary Cards */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: white;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #eef2f7;
    }

    .card-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: white;
        font-size: 18px;
    }

    .card-icon.bg-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
    }

    .card-icon.bg-success {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }

    .card-icon.bg-warning {
        background: linear-gradient(135deg, #f39c12, #e67e22);
    }

    .card-icon.bg-info {
        background: linear-gradient(135deg, #1abc9c, #16a085);
    }

    .card-content {
        display: flex;
        flex-direction: column;
    }

    .card-label {
        font-size: 10px;
        color: #7f8c8d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-value {
        font-size: 20px;
        font-weight: 800;
        color: #2c3e50;
        line-height: 1.2;
    }

    /* Table Card */
    .pdf-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #eef2f7;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-header {
        background: linear-gradient(to right, #f8faff, #ffffff);
        padding: 15px 20px;
        border-bottom: 2px solid #3498db;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 14px;
        font-weight: 600;
    }

    .card-header h3 i {
        color: #3498db;
        margin-right: 8px;
    }

    .print-date {
        font-size: 9px;
        color: #7f8c8d;
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 9px;
    }

    th {
        background: #34495e;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 8px;
        font-size: 9px;
        border: 1px solid #2c3e50;
    }

    td {
        padding: 10px 8px;
        border: 1px solid #e0e7ef;
        vertical-align: middle;
    }

    /* Row striping */
    .odd-row {
        background-color: #ffffff;
    }

    .even-row {
        background-color: #f8faff;
    }

    /* Remove hover scale effect */
    tbody tr:hover {
        background-color: #e8f0fe;
    }

    /* Transaction Code */
    .transaction-code {
        font-weight: 600;
        color: #2c3e50;
        background: #edf2f7;
        padding: 3px 8px;
        border-radius: 4px;
        font-family: monospace;
        font-size: 8px;
    }

    /* Buyer Info */
    .buyer-name {
        font-weight: 500;
        color: #2c3e50;
    }

    /* Product Name */
    .product-name {
        font-weight: 500;
        color: #2980b9;
    }

    /* Price Column */
    .price-column {
        font-weight: 500;
        color: #2c3e50;
        text-align: right;
    }

    .currency {
        font-size: 7px;
        color: #7f8c8d;
        margin-right: 2px;
    }

    /* Quantity Column */
    .quantity-column {
        text-align: center;
    }

    .quantity-badge {
        background: #3498db;
        color: white;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 8px;
    }

    .unit {
        font-size: 7px;
        color: #7f8c8d;
        margin-left: 2px;
    }

    /* Variation Styling */
    .variation-container {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .variation-item {
        display: flex;
        align-items: center;
        font-size: 8px;
        padding: 2px 0;
    }

    .variation-item i {
        width: 14px;
        color: #7f8c8d;
        font-size: 8px;
    }

    .variation-label {
        color: #7f8c8d;
        margin: 0 3px;
        font-size: 7px;
    }

    .variation-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .color-variation .variation-value {
        color: #e74c3c;
    }

    .size-variation .variation-value {
        color: #27ae60;
    }

    .na-badge {
        background: #ecf0f1;
        color: #7f8c8d;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 7px;
        font-style: italic;
    }

    /* Total Column */
    .total-column {
        text-align: right;
    }

    .total-amount {
        font-weight: 700;
        color: #27ae60;
        font-size: 10px;
    }

    /* Payment Method */
    .payment-method {
        display: flex;
        align-items: center;
        gap: 4px;
        background: #f0f3f8;
        padding: 3px 6px;
        border-radius: 20px;
        font-size: 7px;
        white-space: nowrap;
    }

    .payment-method i {
        color: #3498db;
        font-size: 8px;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 8px;
        white-space: nowrap;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    .status-badge.paid {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-badge i {
        font-size: 8px;
    }

    /* Date Container */
    .date-container {
        display: flex;
        flex-direction: column;
    }

    .date-container .date {
        font-weight: 600;
        color: #2c3e50;
        font-size: 8px;
    }

    .date-container .time {
        font-size: 7px;
        color: #7f8c8d;
    }

    /* Table Footer */
    tfoot .footer-row {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        color: white;
    }

    .footer-label {
        color: white !important;
        font-size: 10px;
        text-align: left;
    }

    .footer-stat {
        text-align: center;
    }

    .stat-label {
        color: #bdc3c7;
        font-size: 8px;
        margin-right: 4px;
    }

    .stat-value {
        color: white;
        font-weight: 600;
        font-size: 10px;
    }

    .footer-total {
        text-align: right;
    }

    .total-label {
        color: #f1c40f;
        font-size: 10px;
        font-weight: 600;
        margin-right: 8px;
    }

    .total-value {
        color: white;
        font-weight: 800;
        font-size: 12px;
    }

    .footer-extra {
        text-align: right;
    }

    .extra-info {
        background: rgba(255, 255, 255, 0.1);
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 8px;
        color: #ecf0f1;
    }

    .extra-info i {
        margin-right: 4px;
        color: #f1c40f;
    }

    /* Table Footer Info */
    .table-footer-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px dashed #dee2e6;
    }

    .info-left {
        font-size: 8px;
        color: #7f8c8d;
    }

    .info-left i {
        color: #3498db;
        margin-right: 5px;
    }

    .info-right {
        text-align: right;
    }

    .signature-area {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .generated-by {
        font-size: 8px;
        color: #2c3e50;
    }

    .signature {
        font-family: 'Brush Script MT', cursive;
        font-size: 14px;
        color: #7f8c8d;
    }

    /* Footer */
    .pdf-footer {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px solid #3498db;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 8px;
        color: #7f8c8d;
    }

    .company-name {
        font-weight: 600;
        color: #2c3e50;
    }

    .footer-divider {
        margin: 0 8px;
        color: #d0dae8;
    }

    .confidential {
        color: #e74c3c;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Print-specific styles */
    @media print {
        body {
            background: white;
            padding: 0;
            margin: 0;
        }

        .pdf-container {
            box-shadow: none;
            padding: 10px;
        }

        .summary-cards {
            break-inside: avoid;
        }

        table {
            break-inside: auto;
        }

        tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .summary-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .header-top {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }

        .header-bottom {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }

        .footer-content {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
    }
</style>

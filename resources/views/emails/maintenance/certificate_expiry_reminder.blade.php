<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Upcoming Certificate Expirations</title>
</head>

<body style="background-color:#f5f7fb;font-family:Arial,sans-serif;color:#333;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:30px 0;">
                <table width="600"
                    style="background-color:#fff;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                    <tr>
                        <td
                            style="background-color:#35408e;padding:25px;color:#fff;text-align:center;border-radius:8px 8px 0 0;">
                            <h1 style="margin:0;font-size:22px;">Upcoming Certificate Expiration Notice</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:25px;">
                            <p>The following equipment has certificates expiring before
                                <strong>{{ $earliestExpiry }}</strong>:</p>

                            <table width="100%" style="border-collapse:collapse;margin-top:20px;">
                                <thead>
                                    <tr style="background-color:#35408e;color:#fff;">
                                        <th style="padding:10px;">Equipment ID</th>
                                        <th style="padding:10px;">Expiry Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dueCertificates as $cert)
                                        <tr style="border-bottom:1px solid #eee;">
                                            <td style="padding:10px;">{{ $cert->equipment_id }}</td>
                                            <td style="padding:10px;">
                                                {{ \Carbon\Carbon::parse($cert->expiry_date)->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <p style="margin-top:20px;color:#35408e;">
                                Please schedule renewal before expiration.
                            </p>

                            <div style="text-align:center;margin-top:30px;">
                                <a href="{{ url('/') }}"
                                    style="background-color:#35408e;color:white;padding:12px 24px;border-radius:4px;text-decoration:none;font-weight:bold;">
                                    View Dashboard
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#f8f9fa;padding:20px;text-align:center;font-size:14px;color:#666;">
                            © 2025 NUFEPM. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

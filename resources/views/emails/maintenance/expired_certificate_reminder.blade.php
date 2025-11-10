<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired Equipment Certificates</title>
</head>

<body style="background-color: #f5f7fb; font-family: Arial, sans-serif; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 30px 0;">
                <table width="600"
                    style="background-color: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td
                            style="background-color: #35408e; padding: 25px 30px; border-radius: 8px 8px 0 0; text-align: center;">
                            <h1 style="color: white; font-size: 24px; margin: 0;">Expired Equipment Certificates</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <p>The following equipment certificates have <strong>expired</strong> as of
                                <strong>{{ $earliestExpiredDate }}</strong>:
                            </p>

                            <table width="100%" style="border-collapse: collapse; margin-top: 20px;">
                                <thead>
                                    <tr style="background-color: #35408e; color: white;">
                                        <th style="padding: 12px;">Equipment ID</th>
                                        <th style="padding: 12px;">Type</th>
                                        <th style="padding: 12px;">Model</th>
                                        <th style="padding: 12px;">Expiration Date</th>
                                        <th style="padding: 12px;">Location</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($expiredEquipment as $equip)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="padding: 12px;">{{ $equip->id }}</td>
                                            <td style="padding: 12px;">{{ $equip->type }}</td>
                                            <td style="padding: 12px;">{{ $equip->model }}</td>
                                            <td style="padding: 12px;">
                                                {{ \Carbon\Carbon::parse($equip->latestCertificate->expiry_date)->format('M d, Y') }}
                                            </td>
                                            <td style="padding: 12px;">
                                                {{ $equip->location ? $equip->location->building . ', ' . $equip->location->room : 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <p style="margin-top: 20px; color: #35408e; font-weight: bold;">
                                Immediate action is REQUIRED to maintain safety compliance.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666;">
                            © 2025 NUFEPM. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>

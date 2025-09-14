<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Overdue Maintenance Alert</title>
</head>

<body style="background-color: #f5f7fb; font-family: Arial, sans-serif; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 30px 0;">
                <table width="600"
                    style="background-color: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <tr>
                        <td
                            style="background-color: #35408e; padding: 25px 30px; border-radius: 8px 8px 0 0; text-align: center;">
                            <h1 style="color: white; font-size: 24px; margin: 0;">Overdue Fire Equipment Maintenance
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p>The following extinguishers are <strong>overdue for maintenance</strong> as of
                                <strong>{{ $oldestDue }}</strong>:
                            </p>
                            <table width="100%" style="border-collapse: collapse; margin-top: 20px;">
                                <thead>
                                    <tr style="background-color: #35408e; color: white;">
                                        <th style="padding: 12px;">Equipment ID</th>
                                        <th style="padding: 12px;">Next Maintenance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($extinguishers as $ext)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="padding: 12px;">{{ $ext->extinguisher_id }}</td>
                                            <td style="padding: 12px;">
                                                {{ \Carbon\Carbon::parse($ext->next_maintenance)->format('M d, Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p style="margin-top: 20px;">Please perform the required maintenance as soon as possible.
                            </p>
                            <div style="text-align: center; margin-top: 30px;">
                                <a href="{{ url('http://127.0.0.1:8000/') }}"
                                    style="background-color: #35408e; color: white; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                                    View Dashboard
                                </a>
                            </div>
                        </td>
                    </tr>
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

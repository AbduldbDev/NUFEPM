<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Fire Equipment Maintenance Reminder</title>
</head>

<body
    style="background-color: #f5f7fb; font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 30px 0;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

                    <tr>
                        <td
                            style="background-color: #35408e; padding: 25px 30px; border-radius: 8px 8px 0 0; text-align: center;">
                            <h1 style="color: white; margin: 0; font-size: 24px;">
                                Fire Equipment Maintenance Reminder
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 20px 0;">
                                The following Fire Equipment require <strong>maintenance before
                                    {{ $dueDate }}</strong>:
                            </p>

                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="border-collapse: collapse; margin: 25px 0;">
                                <thead>
                                    <tr style="background-color: #35408e; color: white;">
                                        <th style="padding: 12px 15px; text-align: left;">Fire Equipment ID</th>
                                        <th style="padding: 12px 15px; text-align: left;">Next Maintenance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($extinguishers as $ext)
                                        <tr style="border-bottom: 1px solid #eaeaea;">
                                            <td style="padding: 12px 15px;">{{ $ext->extinguisher_id }}</td>
                                            <td style="padding: 12px 15px; color: #35408e; font-weight: bold;">
                                                {{ \Carbon\Carbon::parse($ext->next_maintenance)->format('M d, Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <p style="margin: 20px 0;">
                                Please inspect before the due date to ensure safety.
                            </p>

                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 20px 0;">
                                        <a href="{{ url('http://127.0.0.1:8000/') }}"
                                            style="background-color: #35408e; color: white; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                                            View Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background-color: #f8f9fa; padding: 20px 30px; border-radius: 0 0 8px 8px; text-align: center; color: #666; font-size: 14px;">
                            <p style="margin: 0;">
                                © 2025 NUFEPM. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

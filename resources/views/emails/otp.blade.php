<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} – Your verification code</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- iOS dark mode tweak -->
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <style>
        /* Some clients honor embedded styles; still keep critical stuff inline */
        @media (prefers-color-scheme: dark) {
            .bg {
                background: #0b0b0c !important;
            }

            .card {
                background: #161617 !important;
                border-color: #2a2a2b !important;
            }

            .text {
                color: #e9e9ea !important;
            }

            .muted {
                color: #a7a7ad !important;
            }

            .btn {
                background: #4c8dff !important;
                color: #ffffff !important;
            }

            .code {
                background: #111215 !important;
                color: #ffffff !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#f5f7fb;" class="bg">
    <!-- Preheader (hidden in most clients) -->
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;">
        Your {{ config('app.name') }} verification code is {{ $code }}. It expires in 10 minutes.
    </div>

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f7fb;"
        class="bg">
        <tr>
            <td align="center" style="padding:24px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600"
                    style="max-width:600px;background:#ffffff;border:1px solid #e6e8ee;border-radius:12px;overflow:hidden;"
                    class="card">
                    <tr>
                        <td align="center" style="padding:28px 24px 12px 24px;">
                            <div style="font:600 18px/1.2 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,'Apple Color Emoji','Segoe UI Emoji';color:#111827;"
                                class="text">
                                {{ config('app.name') }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 8px 24px;">
                            <h1 style="margin:0;font:700 22px/1.3 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;color:#111827;"
                                class="text">
                                Verify your email
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 16px 24px;">
                            <p style="margin:8px 0 0 0;font:400 15px/1.6 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;color:#374151;"
                                class="text">
                                Dear {{ $name }}, Your {{ config('app.name') }} verification code is below to
                                finish signing in.
                                It expires in 10 minutes.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:8px 24px 16px 24px;">
                            <div class="code"
                                style="display:inline-block;background:#0f172a;color:#ffffff;border-radius:10px;
                          font:700 28px/1.2 ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace;
                          letter-spacing:6px;padding:16px 22px;">
                                <span
                                    style="display:inline-block;letter-spacing:6px;">{{ trim(chunk_split($code, 3, ' ')) }}</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:16px 24px 6px 24px;">
                            <p style="margin:0;font:400 13px/1.6 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;color:#6b7280;"
                                class="muted">
                                Didn’t request this? You can safely ignore this email. Someone might have typed your
                                address by mistake.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0 24px 24px 24px;">
                            <p style="margin:0;font:400 12px/1.6 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;color:#9ca3af;"
                                class="muted">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>

                <table role="presentation" width="600" style="max-width:600px;margin-top:12px;">
                    <tr>
                        <td style="padding:0 12px;">
                            <p style="margin:0;font:400 12px/1.6 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;color:#9ca3af;"
                                class="muted">
                                Trouble reading the code? Your code is: <strong
                                    style="letter-spacing:2px;color:#111827;">{{ $code }}</strong>
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>

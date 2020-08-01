<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="background-color: #eee; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #333333;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="100%" cellpadding="0" cellspacing="0">
                <h1 style="font-size: 20px;">A new message from contact form!</h1>
            </td>
        </tr>
        <tr>
            <td width="100%" cellpadding="0" cellspacing="0">
                <p><b>From:</b> {{ $contactName }} <i>({{ $contactEmail }})</i></p>
                <p><b>Subject:</b> {{ $contactSubject }}</p>
                <p><b>Message:</b></p>
                <p>{{ $contactMessage }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="color: #777777;"><i>That's it! Cheers!</i></p>
            </td>
        </tr>
    </table>
</body>
</html>
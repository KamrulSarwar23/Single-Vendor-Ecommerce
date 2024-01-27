<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
            <p style="font-size:1.1em">Hi,</p>
            <p>Thank you for choosing {{ $setting->site_name }} Brand.</p>
            <h4>
                 Your Name: {{ $name }}
                 <br>
                 Your Email: {{ $email }}
                 <br>
                 Your Password: {{ $password }}
            </h4>
            <p style="font-size:0.9em;">Regards,<br />{{ $setting->site_name }}</p>
            <hr style="border:none;border-top:1px solid #eee" />

        </div>
    </div>
</body>

</html>

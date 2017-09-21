<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>

<body>

<table border="0" cellpadding="0" cellspacing="0" width="800" align="center" style="width: 800px; border-width: 0; padding: 0; margin: 0 auto; border-spacing: 0; background-color: white; font-family: Arial, Helvetica, sans-serif; color: #231F20; text-align: left; font-weight: normal; font-size: 15px; line-height: 18px;">

    <tr>
        <td height="50" style="height: 50px;" colspan="3">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td width="20" style="width: 20px;">
            &nbsp;
        </td>
        <td style="vertical-align: top;">
            <h1 style="font-family: Arial, Helvetica, sans-serif; color: #231F20; text-align: left; font-weight: bold; font-size: 17px; line-height: 23px; margin: 0 0 15px 0">Dear <strong>{{ $basketInfo->user->name }}</strong></h1>

            <p style="font-family: Arial, Helvetica, sans-serif; color: #231F20; text-align: left; font-weight: normal; font-size: 15px; line-height: 22px; margin: 0;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium, consectetur dolorem dolorum ea exercitationem explicabo facere fugiat harum illum ipsum magnam magni molestias nihil, nobis recusandae saepe vitae voluptates!
            </p>
        </td>
        <td width="20" style="width: 20px;">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td width="20" style="width: 20px;">
            &nbsp;
        </td>
        <td style="vertical-align: top;">
            <p>Invoice</p>
            @include('_basketPartial', ['basketInfo' => $basketInfo])
        </td>
        <td width="20" style="width: 20px;">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td width="20" style="width: 20px;">
            &nbsp;
        </td>
        <td style="vertical-align: top;">
            <img src="{{ $message->embed(public_path().'/img/logo-email.jpg') }}" alt="Corozon" width="315" height="83" style="display: block; width: 315px; height: 83px; outline: none; border: none;">
            <p style="font-family: Arial, Helvetica, sans-serif; color: #231F20; text-align: left; font-size: 11px; line-height: 18px; font-weight: bold; margin: 0;">
                Corozon Platform</p>
            <p style="font-family: Arial, Helvetica, sans-serif; color: #706F6F; text-align: left; font-size: 11px; line-height: 18px; font-weight: normal; margin: 0;">
                PO Box 62056 Toronto, Ontario M4A 2W1</p>

            <p style="margin: 0; line-height: 0;">
                <span style="font-family: Arial, Helvetica, sans-serif; color: #231F20; text-align: left; font-size: 11px; line-height: 18px; font-weight: bold; margin: 0; display: inline-block; vertical-align: middle;"> Tel.:</span><span style="font-family: Arial, Helvetica, sans-serif; color: #706F6F; text-align: left; font-size: 11px; line-height: 18px; font-weight: normal; margin: 0; display: inline-block; vertical-align: middle;">1 844-869-4913</span>
            </p>

            <p style="margin: 0;"><a href="mailto:info@corozonplatform.com" style="font-family: Arial, Helvetica, sans-serif; color: #009FE3; text-align: left; font-size: 11px; line-height: 18px; font-weight: normal; text-decoration: none; margin: 0; display: inline-block;">info@corozonplatform.com</a></p>


            <p style="margin: 0;"><a href="mailto:www.corozonplatform.com" style="font-family: Arial, Helvetica, sans-serif; color: #009FE3; text-align: left; font-size: 11px; line-height: 18px; font-weight: normal; margin: 0; text-decoration: none; display: inline-block;">www.corozonplatform.com</a></p>
        </td>
        <td width="20" style="width: 20px;">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td height="50" style="height: 50px;" colspan="3">
            &nbsp;
        </td>
    </tr>

</table>

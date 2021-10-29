<?php

// Instructions
// =======================

// Replace all local URL.
// Replace all Vendor addresses.
// Replace Logo and its URL

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailsController extends Controller
{
    public static function instructor_welcome($name, $email, $password)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Welcome to LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Welcome to LMS Portal
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Your new account is activated now. Please use below details to login to your dashbaord.
                                </p>
                                <p>
                                    <strong>Email: </strong> '.$email.'
                                </p>
                                <p>
                                    <strong>Password: </strong> '.$password.'
                                </p>
                                <a href="https://lms.nutasurgical.com/instructor/login" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Login Now
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function student_welcome($name, $email, $password)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Welcome to LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Welcome to LMS Portal
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Your new account is activated now. Please use below details to login to your dashbaord.
                                </p>
                                <p>
                                    <strong>Email: </strong> '.$email.'
                                </p>
                                <p>
                                    <strong>Password: </strong> '.$password.'
                                </p>
                                <a href="https://lms.nutasurgical.com/login" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Login Now
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function new_course($name, $email, $title)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($mail_admin_address, "Admin");

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Course Approval';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Approval For New Course
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    A new course ('.$title.') is created by '.$name.' ('.$email.'). Visit your admin dashbaord to approve or reject this course. 
                                </p>
                                <a href="https://lms.nutasurgical.com/admin" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Go to Dashbaord
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function course_approval($title, $name, $email)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Course Approval | LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Congratulations 
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>Your course <b>('.$title.')</b> is approved and live on our website. </p>
                                <a href="https://lms.nutasurgical.com/instructor/login" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Go to Dashbaord
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function course_rejection($title, $name, $email)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Course Rejected | LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Rejection 
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>Your course <b>('.$title.')</b> was rejected by our team. Unfortunately, it does not meet the criteria of our website. For more information contact our customer support. </p>
                                <a href="https://lms.nutasurgical.com/instructor/login" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Go to Dashbaord
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function course_enrol_student($title, $name, $email)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Course Enroled';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Course Successfully Enroled
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>The course <b>('.$title.')</b> is enroled and can be shown on your dashboard. We wish you best of luck for your learning journey.</p>
                                <a href="https://lms.nutasurgical.com/student" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Go to Dashbaord
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function course_enrol_instructor($title, $name, $email)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Enrolment Alert';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Congratulations
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>A student just enroled your course <b>('.$title.')</b>. For more information about students, please visit your dashboard.</p>
                                <a href="https://lms.nutasurgical.com/instructor" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Go to Dashbaord
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function course_completion($title, $student_name, $student_email, $ins_name, $ins_email)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($ins_email, $ins_name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Course Completion Alert';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Course Completion
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$ins_name.',
                                </p>
                                <p>A student just completed the course <b>('.$title.')</b>. Student details are as follow:</p>
                                <p>
                                    <b>Name: </b> '.$student_name.'
                                    <b>Email: </b> '.$student_email.'
                                </p>
                                <p>
                                    Please visit your dashboard for further proceedings.
                                </p>
                                <a href="https://lms.nutasurgical.com/instructor" target="_blank">
                                    <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                        Go to Dashbaord
                                    </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function certificate_rejection($name, $email, $ins_name, $ins_email, $title)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
           
            $mail->isHTML(true);

            $mail->Subject = 'Certificate request not approved';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                    table.ins {
                      width: 100%;
                      border-collapse: collapse;
                    }
                    table.ins th{
                      border: 1px solid #f7f7f7;
                      background: #f7f7f7;
                      padding: 7px;
                    }
                    table.ins td{
                      border: 1px solid #f7f7f7;
                      padding: 7px;
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Certificate Not Approved 
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>
                                  Your instructor rejected your certification request. For more information you can contact our customer support or you can contact your instructor directly.
                                </p>
                                <table class="ins">
                                  <tr>
                                    <th>Instructor Name</th>
                                    <td>'.$ins_name.'</td>
                                  </tr>
                                  <tr>
                                    <th>Instructor Email</th>
                                    <td>'.$ins_email.'</td>
                                  </tr>
                                  <tr>
                                    <th>Course</th>
                                    <td>'.$title.'</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function certificate_approval($name, $email, $title, $file)
    {
        require '../vendor/autoload.php';

        $certificate = "https://lms.nutasurgical.com/uploads/certificates/".$file;
        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
            $mail->addAttachment($certificate, 'Certificate');
           
            $mail->isHTML(true);

            $mail->Subject = 'Certification | LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                    table.ins {
                      width: 100%;
                      border-collapse: collapse;
                    }
                    table.ins th{
                      border: 1px solid #f7f7f7;
                      background: #f7f7f7;
                      padding: 7px;
                    }
                    table.ins td{
                      border: 1px solid #f7f7f7;
                      padding: 7px;
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Congratulations
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>
                                  Your instructor has approved your certification request for the course <i><b>('.$title.')</b></i>. Please download the below attached certificate. In case of any queries, please contact our customer support. We wish you a bright future.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }       
    }
    public static function forget_password_student($name, $email, $hash)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
           
            $mail->isHTML(true);

            $mail->Subject = 'Reset Password | LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                    table.ins {
                      width: 100%;
                      border-collapse: collapse;
                    }
                    table.ins th{
                      border: 1px solid #f7f7f7;
                      background: #f7f7f7;
                      padding: 7px;
                    }
                    table.ins td{
                      border: 1px solid #f7f7f7;
                      padding: 7px;
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Recover Password
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>
                                  We have received a password reset request from your email. To recover your password click the recover button. If you have not done this, simply ignore this email.
                                </p>
                                <a href="https://lms.nutasurgical.com/student/recover/'.$hash.'" target="_blank">
                                  <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                      Recover your password
                                  </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }    
    }
    public static function forget_password_instructor($name, $email, $hash)
    {
        require '../vendor/autoload.php';

        // Environment Variables
        $mail_host = env('MAIL_HOST','default');
        $mail_username = env('MAIL_USERNAME','default');
        $mail_password = env('MAIL_PASSWORD','default');
        $mail_port = env('MAIL_PORT','default');
        $mail_from_address = env('MAIL_FROM_ADDRESS','default');
        $mail_from_name = env('MAIL_FROM_NAME','default');
        $mail_reply_to_address = env('MAIL_REPLYTO_ADDRESS','default');
        $mail_admin_address = env('MAIL_ADMIN_ADDRESS','default');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->Host = $mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username = $mail_username;
            $mail->Password = $mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $mail_port;

            $mail->setFrom($mail_from_address,$mail_from_name);
            $mail->addAddress($email, $name);

            $mail->addReplyTo($mail_reply_to_address, $mail_from_name);
           
            $mail->isHTML(true);

            $mail->Subject = 'Reset Password | LMS';
            $mail->Body    = '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <style>
                    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                    div, td {padding:0;}
                    div {margin:0 !important;}
                  </style>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {
                      font-family: Arial, sans-serif;
                    }
                    table.data{
                        width:100%;
                    }
                    table.data tr th{
                      background: #eee;
                    }
                    table.data tr, table.data td, table.data th{
                      margin: 0!important;
                    }
                    table.data tr th, table.data tr td{
                       padding: 13px;
                    }
                    table.data tr td{
                       background: #f7f7f7;
                    }
                    @media screen and (max-width: 530px) {
                      .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #555555;
                        text-decoration: none !important;
                        font-weight: bold;
                      }
                      .col-lge {
                        max-width: 100% !important;
                      }
                    }
                    @media screen and (min-width: 531px) {
                      .col-sml {
                        max-width: 27% !important;
                      }
                      .col-lge {
                        max-width: 73% !important;
                      }
                    }
                    table.ins {
                      width: 100%;
                      border-collapse: collapse;
                    }
                    table.ins th{
                      border: 1px solid #f7f7f7;
                      background: #f7f7f7;
                      padding: 7px;
                    }
                    table.ins td{
                      border: 1px solid #f7f7f7;
                      padding: 7px;
                    }
                  </style>
                </head>
                <body style="margin:0;padding:0;word-spacing:normal;background-color:#f7f7f7;">
                  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f7f7f7;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                      <tr>
                        <td align="center" style="padding:0;">
                          <!--[if mso]>
                          <table role="presentation" align="center" style="width:600px;">
                          <tr>
                          <td>
                          <![endif]-->
                          <table>
                            <tr style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://lms.nutasurgical.com" style="text-decoration:none;">
                                  <img src="https://lms.nutasurgical.com/assets/images/brand/logo/logo.png" alt="Logo" style="width:80%;max-width:180px;height:auto;border:none;text-decoration:none;color:#ffffff;">
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- Body -->
                          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px 30px 0px 30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:10px;font-size:26px;line-height:25px;font-weight:bold;letter-spacing:-0.02em;text-align: center;">
                                    Recover Password
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td style="padding:20px;font-size:18px;background:#fff;">
                                <p>
                                    Dear '.$name.',
                                </p>
                                <p>
                                  We have received a password reset request from your email. To recover your password click the recover button. If you have not done this, simply ignore this email.
                                </p>
                                <a href="https://lms.nutasurgical.com/instructor/recover/'.$hash.'" target="_blank">
                                  <button style="background:#754FFE;padding:8px 15px 8px 15px;color:#fff;border:1px solid #754FFE;border-radius: 4px;font-size: 16px;">
                                      Recover your password
                                  </button>
                                </a>
                              </td>
                            </tr>
                          </table>
                          <!-- footer -->
                          <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                              <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                  &copy; Copyright 2021. All rights reserved.
                                </p>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td>
                          </tr>
                          </table>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </div>

                </body>
                </html>';

            $mail->send();     
       } catch (Exception $e) {
           return $e;
       }    
    }
}

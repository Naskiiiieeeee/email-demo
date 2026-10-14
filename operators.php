<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class System_operators {
    public function sendEmail($empID, $mobile_number) {
        $code = $this->randomStringGenerator();
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
    
            $mail->setFrom('', 'Gkass');
            $mail->addAddress($empID);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Account Registration';

            $safe_number = htmlspecialchars($mobile_number, ENT_QUOTES, 'UTF-8');
            $year = date('Y');

            $message_body = <<<HTML
                <!DOCTYPE html>
                <html>
                <body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;padding:30px 0;">
                    <tr>
                    <td align="center">
                        <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:8px;overflow:hidden;">

                        <tr>
                            <td align="center" style="background-color:#2563eb;padding:28px 20px;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;">Account Confirmation</h1>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:36px 40px;color:#333333;">
                            <h2 style="margin:0 0 16px;font-size:20px;color:#111827;">Your account is now active!</h2>
                            <p style="margin:0 0 16px;font-size:15px;line-height:1.6;">Good day!</p>
                            <p style="margin:0 0 20px;font-size:15px;line-height:1.6;">
                                We're happy to let you know that your account has been <strong>activated successfully</strong>.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                <td style="padding:14px 18px;font-size:14px;color:#6b7280;">Registered Phone Number</td>
                                <td align="right" style="padding:14px 18px;font-size:15px;font-weight:bold;color:#111827;">{$safe_number}</td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                <td style="padding:14px 18px;font-size:14px;color:#6b7280;">Transaction code</td>
                                <td align="right" style="padding:14px 18px;font-size:15px;font-weight:bold;color:#111827;">{$code}</td>
                                </tr>
                            </table>

                            <p style="margin:0;font-size:13px;line-height:1.6;color:#6b7280;">
                                If you did not register this account, please ignore this email or contact the administrator.
                            </p>

                            </td>
                        </tr>

                        <tr>
                            <td align="center" style="background-color:#f9fafb;padding:20px;font-size:12px;color:#9ca3af;border-top:1px solid #e5e7eb;">
                            &copy; {$year} Kangkong-Team. All rights reserved.<br>
                            This is an automated message, please do not reply.
                            </td>
                        </tr>

                        </table>
                    </td>
                    </tr>
                </table>
                </body>
                </html>
                HTML;

            $mail->Body = $message_body;
            $mail->AltBody = 'Good day, your account with a registered phone number " ' . $mobile_number . ' ", has activated successfully!';
    
            if (!$mail->send()) {
                echo '
                <script>
                alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");
                </script>
                ';
            } else {
                echo '
                <script>
                    alert("Renewal Success, Transaction code sent to your email"); window.location="index.php";
                </script>
                ';
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    public function randomStringGenerator($length = 8) {
        return bin2hex(random_bytes($length / 2));
    }

    public function sendSMS($pNumber, $message){    
        $ch = curl_init();
        $parameters = array(
            'apikey' => '', 
            'number' => $pNumber,
            'message' =>  $message,
            'sendername' => ''
        );
        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);
    }

    public function sendEmailMailtrap($email, $mobile_number) {
        $code = $this->randomStringGenerator();
        $mail = new PHPMailer(true);
        try {
            // $mail->SMTPDebug   = SMTP::DEBUG_SERVER;
            $mail->Debugoutput = 'html';

            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'c4cf811d18af69';
            $mail->Password   = '348efdb8320faf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('no-reply@newsletter-demo.test', 'Newsletter Demo');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Newsletter Subscription Confirmed';

            $safe_number = htmlspecialchars($mobile_number, ENT_QUOTES, 'UTF-8');
            $year = date('Y');

            $message_body = <<<HTML
                <!DOCTYPE html>
                <html>
                <body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;padding:30px 0;">
                    <tr>
                    <td align="center">
                        <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:8px;overflow:hidden;">

                        <tr>
                            <td align="center" style="background-color:#2563eb;padding:28px 20px;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;">Subscription Confirmed</h1>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:36px 40px;color:#333333;">
                            <h2 style="margin:0 0 16px;font-size:20px;color:#111827;">Thanks for subscribing!</h2>
                            <p style="margin:0 0 20px;font-size:15px;line-height:1.6;">
                                You're now signed up to receive our newsletter updates.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                <td style="padding:14px 18px;font-size:14px;color:#6b7280;">Contact Number on File</td>
                                <td align="right" style="padding:14px 18px;font-size:15px;font-weight:bold;color:#111827;">{$safe_number}</td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                <td style="padding:14px 18px;font-size:14px;color:#6b7280;">Reference Code</td>
                                <td align="right" style="padding:14px 18px;font-size:15px;font-weight:bold;color:#111827;">{$code}</td>
                                </tr>
                            </table>

                            <p style="margin:0;font-size:13px;line-height:1.6;color:#6b7280;">
                                You can unsubscribe at any time by contacting us.
                            </p>

                            </td>
                        </tr>

                        <tr>
                            <td align="center" style="background-color:#f9fafb;padding:20px;font-size:12px;color:#9ca3af;border-top:1px solid #e5e7eb;">
                            &copy; {$year} Newsletter Demo. All rights reserved.
                            </td>
                        </tr>

                        </table>
                    </td>
                    </tr>
                </table>
                </body>
                </html>
                HTML;

            $mail->Body    = $message_body;
            $mail->AltBody = 'Thanks for subscribing! Contact number on file: ' . $mobile_number;

            $mail->send();
            echo '<script>
                alert("Subscribed! Confirmation sent to your email.");
                window.location="index.php";
            </script>';
        } catch (Exception $e) {
            $err = json_encode("Message could not be sent. Mailer Error: " . $mail->ErrorInfo);
            echo "<script>alert($err);</script>";
        }
    }


    public function sendEmailMailtrapLive($email, $mobile_number) {
        $code = $this->randomStringGenerator();
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug   = SMTP::DEBUG_SERVER; 
            $mail->Debugoutput = 'html';

            $mail->isSMTP();
            $mail->Host       = 'live.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'api';                 
            $mail->Password   = '2edf43a1f45796826ec0af4add96348a';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('no-reply@jmca.com', 'Newsletter Demo');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Newsletter Subscription Confirmed';

            $safe_number = htmlspecialchars($mobile_number, ENT_QUOTES, 'UTF-8');
            $year = date('Y');

            $message_body = <<<HTML
                <!DOCTYPE html>
                <html>
                <body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;padding:30px 0;">
                    <tr>
                    <td align="center">
                        <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:8px;overflow:hidden;">

                        <tr>
                            <td align="center" style="background-color:#2563eb;padding:28px 20px;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;">Subscription Confirmed</h1>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:36px 40px;color:#333333;">
                            <h2 style="margin:0 0 16px;font-size:20px;color:#111827;">Thanks for subscribing!</h2>
                            <p style="margin:0 0 20px;font-size:15px;line-height:1.6;">
                                You're now signed up to receive our newsletter updates.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                <td style="padding:14px 18px;font-size:14px;color:#6b7280;">Contact Number on File</td>
                                <td align="right" style="padding:14px 18px;font-size:15px;font-weight:bold;color:#111827;">{$safe_number}</td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;margin-bottom:24px;">
                                <tr>
                                <td style="padding:14px 18px;font-size:14px;color:#6b7280;">Reference Code</td>
                                <td align="right" style="padding:14px 18px;font-size:15px;font-weight:bold;color:#111827;">{$code}</td>
                                </tr>
                            </table>

                            <p style="margin:0;font-size:13px;line-height:1.6;color:#6b7280;">
                                You can unsubscribe at any time by contacting us.
                            </p>

                            </td>
                        </tr>

                        <tr>
                            <td align="center" style="background-color:#f9fafb;padding:20px;font-size:12px;color:#9ca3af;border-top:1px solid #e5e7eb;">
                            &copy; {$year} Newsletter Demo. All rights reserved.
                            </td>
                        </tr>

                        </table>
                    </td>
                    </tr>
                </table>
                </body>
                </html>
                HTML;

            $mail->Body    = $message_body;
            $mail->AltBody = 'Thanks for subscribing! Contact number on file: ' . $mobile_number;

            $mail->send();
            echo '<script>
                alert("Subscribed! Confirmation sent to your email.");
                window.location="index.php";
            </script>';
        } catch (Exception $e) {
            $err = json_encode("Message could not be sent. Mailer Error: " . $mail->ErrorInfo);
            echo "<script>alert($err);</script>";
        }
    }
}

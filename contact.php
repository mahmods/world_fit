<?php
require_once './vendor/autoload.php';

$helperLoader = new SplClassLoader('Helpers', './vendor');
$mailLoader   = new SplClassLoader('SimpleMail', './vendor');

$helperLoader->register();
$mailLoader->register();

use Helpers\Config;
use SimpleMail\SimpleMail;

$config = new Config;
$config->load('./config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['form-name']));
    $email   = stripslashes(trim($_POST['form-email']));
    $subject = stripslashes(trim($_POST['form-subject']));
    $message = stripslashes(trim($_POST['form-message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }

    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($name && $email && $emailIsValid && $subject && $message) {
        $mail = new SimpleMail();

        $mail->setTo($config->get('emails.to'));
        $mail->setFrom($config->get('emails.from'));
        $mail->setSender($name);
        $mail->setSenderEmail($email);
        $mail->setSubject($config->get('subject.prefix') . ' ' . $subject);

        $body = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
            <head>
                <meta charset=\"utf-8\">
            </head>
            <body>
                <h1>{$subject}</h1>
                <p><strong>{$config->get('fields.name')}:</strong> {$name}</p>
                <p><strong>{$config->get('fields.email')}:</strong> {$email}</p>
                <p><strong>{$config->get('fields.message')}:</strong> {$message}</p>
            </body>
        </html>";

        $mail->setHtml($body);
        $mail->send();

        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?>
    <?php include("header.php"); ?>
    <section class="about-section">
        <div class="container">
            <h3 class="text-uppercase">CONTACT US</h3>
            <h1 class="text-uppercase">GET IN TOUCH</h1>
            <p>
                <span class="fightclub-icon-style fightclub-lines-on" style="font-size:3em;color:#a7e4c2;">
                    <i class="fightclub-icon  fightclub-icon-mail"></i>
                </span>
            </p>
            <p class="content"></p>
        </div>
    </section>

    <section class="contact-form">
        <div class="container">
            <div class="row justify-content-center">
                <?php if(!empty($emailSent)): ?>
                <div class="col-8">
                    <div class="alert alert-success text-center">
                        <?php echo $config->get('messages.success'); ?>
                    </div>
                </div>
                <?php else: ?>
                <?php if(!empty($hasError)): ?>
                <div class="col-8">
                    <div class="alert alert-danger text-center">
                        <?php echo $config->get('messages.error'); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
                        <div class="input-group col-12 mb-3">
                                <input type="text" class="form-control" id="form-name" name="form-name" placeholder="<?php echo $config->get('fields.name'); ?>" required>
                                <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.email'); ?>" required>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <input type="text" class="form-control" id="form-subject" name="form-subject" placeholder="<?php echo $config->get('fields.subject'); ?>"required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <textarea class="form-control" rows="3" id="form-message" name="form-message" placeholder="<?php echo $config->get('fields.message'); ?>"required></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" style="cursor:pointer;margin-top:0" class="button"><?php echo $config->get('fields.btn-send'); ?></button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="./js/contact-form.js"></script>
    <script type="text/javascript">
        new ContactForm('#contact-form');
    </script>

    <?php include("footer.php"); ?>
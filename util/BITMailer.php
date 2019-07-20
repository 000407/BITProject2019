<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus - PC
 * Date: 7/20/2019
 * Time: 2:51 PM
 */

class BITMailer
{
    private $mailer;

    /**
     * BITMailer constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->mailer = new PHPMailer(true);

        //Server settings
        $this->mailer->SMTPDebug = 2;                                       // Enable verbose debug output
        $this->mailer->isSMTP();                                            // Set mailer to use SMTP
        $this->mailer->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $this->mailer->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mailer->Username   = 'stddemoemail@gmail.com';                     // SMTP username
        $this->mailer->Password   = 'BIT123@UCSC';                               // SMTP password
        $this->mailer->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $this->mailer->Port       = 587;                                    // TCP port to connect to
        $this->mailer->setFrom('stddemoemail@gmail.com', 'Mailer');
        $this->mailer->addReplyTo('info@bitproject2019.com', 'Information');
    }

    /**
     * @param mixed ...$recipients
     * @return BITMailer
     * @throws Exception
     */
    public function addTo(...$recipients){
        foreach($recipients as $recipient){
            $this->mailer->addAddress($recipient);
        }
        return $this;
    }

    public function addSubject($subject){
        $this->mailer->Subject = $subject;
        return $this;
    }

    public function addBody($bodyText, $alternativeBody = null, $isHtml = false){
        $this->mailer->isHTML($isHtml);
        $this->mailer->Body = $bodyText;
        $this->mailer->AltBody = $alternativeBody;
        return $this;
    }

    public function send(){
        try {
            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}
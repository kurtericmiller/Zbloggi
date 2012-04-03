<?php
/**
 * Action Helper for sending mail
 *
 * @uses Zend_Controller_Action_Helper_Abstract
 */
class Action_Helper_Mailer extends Zend_Controller_Action_Helper_Abstract
{
  /**
   * @var Zend_Loader_PluginLoader
   */
  public $pluginLoader;
  /**
   * Constructor: initialize plugin loader
   *
   * @return void
   */
  public function __construct()
  {
    $this->pluginLoader = new Zend_Loader_PluginLoader();
  }
  /**
   * Send an email
   *
   * @param  string $sender
   * @param  string $sendee
   * @param  string $body
   * @param  string $subject
   * @return void
   */
  public function mailer($sender, $sendee, $body, $subject)
  {
    if (APPLICATION_ENV == 'testing') {
      return;
    }
    //    $configs = $this->getActionController()->getInvokeArg('bootstrap')->getOption('configs');
    //    $mailConfig = new Zend_Config_Ini($configs['mailConfigPath']);
    //    $host = $mailConfig->admin->host;
    //    $ssl = $mailConfig->admin->ssl;
    //    $port = $mailConfig->admin->port;
    //    $auth = $mailConfig->admin->auth;
    //    $username = $mailConfig->admin->username;
    //    $password = $mailConfig->admin->password;
    //    $config = array('ssl' => $ssl, 'port' => $port, 'auth' => $auth, 'username' => $username, 'password' => $password);
    //    $tr = new Zend_Mail_Transport_Sendmail('-f' . $sender);
    //    Zend_Mail::setDefaultTransport($tr);
    $mail = new Zend_Mail();
    $mail->setBodyText($body);
    $mail->setFrom($sender);
    $mail->setReplyTo($sender);
    $mail->addTo($sendee);
    $mail->setSubject($subject);
    $mail->send();
  }
  /**
   * Strategy pattern: call helper as broker method
   *
   * @param  string $sender
   * @param  string $sendee
   * @param  string $body
   * @param  string $subject
   * @return void
   */
  public function direct($sender, $sendee, $body, $subject)
  {
    $this->mailer($sender, $sendee, $body, $subject);
  }
}

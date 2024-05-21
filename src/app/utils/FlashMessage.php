<?php

namespace app\utils;

use app\utils\Session;

class FlashMessage
{
    private string $pageRedirect = '';
    private int $refreshDelay = 1;
    public function setPageRedirect($pageRedirect, $refreshDelay = 1)
    {
        $this->pageRedirect = $pageRedirect;
        $this->refreshDelay = $refreshDelay;
    }

    public function displayFlashMessage(){
        Session::start();
        $this->displaySuccessMessage();
        $this->displayErrorMessage();
    }
    private function displaySuccessMessage()
    {
        $checkMarkIcon = '&#10004;';
        if (!isset($_SESSION['success_msg'])) {
            return;
        }
        $this->displayMessage('success_msg', $checkMarkIcon, $_SESSION['success_msg']);
        
        if ($this->pageRedirect) {
            header("refresh:{$this->refreshDelay};url={$this->pageRedirect}");
            exit;
        }
    }
    private function displayErrorMessage()
    {
        $xMarkIcon = '&times;';
        if (!isset($_SESSION['error_msg'])) {
            return;
        }
        $this->displayMessage('error_msg', $xMarkIcon, $_SESSION['error_msg']);
    }

    private function displayMessage($messageType, $icon, $message)
    {
        $messageContainerBody = "<div class=\"message-container\">";
        $messageContainerBody .= "<li class=\"{$messageType}\"> <span> {$icon}</span> {$message}</li>";
        $messageContainerBody .= "</div>";

        echo $messageContainerBody;

        unset($_SESSION[$messageType]);
    }
}

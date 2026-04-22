<?php 
class Model_Core_Message {

    public function setSuccess($m){
        if(!array_key_exists('message', $_SESSION)){
            $_SESSION['message'] = [];
        }
        $_SESSION['message']['success'] = $m;
        return $this;
    }

    public function setFailure($m){
       if(!array_key_exists('message', $_SESSION)){
            $_SESSION['message'] = [];
        }
        $_SESSION['message']['failure'] = $m;
        return $this;
    }

    public function setNotice($m){
        if(!array_key_exists('message', $_SESSION)){
            $_SESSION['message'] = [];
        }
        $_SESSION['message']['notice'] = $m;
        return $this;
    }

    public function getSuccess() {
        if(!array_key_exists('message', $_SESSION) || !array_key_exists('success', $_SESSION['message'])){
            return null;
        }
         return $_SESSION['message']['success'];
        
    }

    public function getFailure(){
        if(!array_key_exists('message', $_SESSION) || !array_key_exists('failure', $_SESSION['message'])){
            return null;
        }
        return $_SESSION['message']['failure'];
    }

    public function getNotice() {
        if(!array_key_exists('message', $_SESSION) || !array_key_exists('notice', $_SESSION['message'])){
            return null;
        }
        return $_SESSION['message']['notice'];
    }

    public function clearMessages(){
        $_SESSION['message'] = [];
    }
}
?>
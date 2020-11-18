<?php 

namespace App\Infrastructure\Files;

class Logger {

    private $date;
    private $message;
    private $pathFile;

    public function __construct($date = '', $message = '', $pathFile = '')
    {
        $this->date = $date;
        $this->message = $message;
        $this->pathFile = $pathFile;
    }

    public function getDate()
    {
        $this->date = date("d/m/Y H:i:s");
        return $this->date;
    }

    public function getMessage($message)
    {
        $this->message = $message;
        return $this->message;
    }

    private function getFilePath()
    {
        $path = 'src/Infrastructure/Files/Logs.log';
        $this->pathFile = $path;
        return $this->pathFile;
    }

    private function OpenFile($path)
    {
        $logFile = fopen($path, 'a') or die('Error opening file');
        return $logFile;
    }

    public function WriteFile($message)
    {
        $logFile = $this->OpenFile($this->getFilePath());
        $data = fwrite($logFile, "\n".$this->getDate().' - '.$message. ' - ' .$this->getRealIP());
        if($data === false) {
            fwrite($logFile, "\n".$this->getDate().' - '.'Error al realizar la operación');
        }
        return $data;
        $this->CloseFile($logFile);
    }

    private function CloseFile($logFile)
    {
        fclose($logFile);
    }

    public function getRealIP() 
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }

}

?>
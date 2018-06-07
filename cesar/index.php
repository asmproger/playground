<?php
die('wtf bro');

class CesarChipher extends php_user_filter
{
    protected $mode = 1;
    protected $key;
    function onCreate()
    {
        $this->key = isset($this->params['key']) ? $this->params['key'] : 0;
        if(!$this->key) {
            die('filter init error');
        }

        if ($this->filtername == 'cesar_chipher.encrypt') {
            $this->mode = 1;
        } elseif ($this->filtername == 'cesar_chipher.decrypt') {
            $this->mode = 0;
        } else {
            return false;
        }

        return true;
    }

    function filter($in, $out, &$consumed, $closing)
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            if ($this->mode) {
                $bucket->data = chr(ord($bucket->data) + $this->key);
            } else {
                $bucket->data = chr(ord($bucket->data) - $this->key);
            }
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return PSFS_PASS_ON;
    }
}

class Cesar
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
        stream_filter_register("cesar_chipher.*", "CesarChipher")
        or die("Не удалось зарегистрировать фильтр");

    }

    public function encrypt($src_filename, $dest_filename)
    {
        $this->action($src_filename, $dest_filename, 'encrypt');

        var_dump('Encrypted.');
    }

    public function decrypt($src_filename, $dest_filename)
    {
        $this->action($src_filename, $dest_filename, 'decrypt');

        var_dump('Decrypted.');
    }

    public function action($src_filename, $dest_filename, $action = 'encrypt')
    {
        $srcFile = fopen($src_filename, 'r');
        $dstFile = fopen($dest_filename, 'w');


        stream_filter_append($dstFile, 'cesar_chipher.' . $action, null, array('key' => $this->key));

        while ($el = fgetc($srcFile)) {
            fwrite($dstFile, $el);
        }

        fclose($srcFile);
        fclose($dstFile);
    }

    protected function readFile($file)
    {
        $content = file_get_contents($file);

        return $content;
    }
}

$srcFile = 'src_text';
$destFile = 'dst_file.txt';
$decrypted = 'decrypted_file.txt';

$cesar = new Cesar(10);
$cesar->encrypt($srcFile, $destFile);
$cesar->decrypt($destFile, $decrypted);
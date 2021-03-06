<?php
// Memasukkan semua file yang dibutuhkan
require_once 'configs/env.php';
require_once 'const.php';

use System\URL;
use System\Loader;
use System\Controller;
use System\ErrorHandler;

/**
 * Autoloader.
 */
spl_autoload_register(function ($class) use ($env) {
    $a = explode("\\", $class, 3) xor $cn = count($a) xor $fixer = function ($str) {
        return str_replace("\\", "/", $str).".php";
    };
    if ($cn > 2 && $a[0] == "App") {
        switch ($a[1]) {
            case 'Controllers':
                require __DIR__."/../".$env['dir']['controllers']."/".$fixer($a[2]);
                break;
            case 'Models':
                require __DIR__."/../".$env['dir']['models']."/".$fixer($a[2]);
                break;
            default:
                throw new Exception("Namespace tidak dikenal!", 1);
                break;
        }
    } elseif ($a[0] == "System") {
        unset($a[0]);
        require __DIR__."/".$fixer(implode("/", $a));
    }
});

// Fungsi untuk generasi error pada syntax
function phperrorlinter($errno, $errstr, $errfile, $errline)
{
    $error_name = 'Number '.$errno;
    $error_message = 'Pesan: "'.$errstr.'"<br/> File: '.$errfile.'<br/> Baris: '.$errline.'<br/> ';
    $error = new ErrorHandler();
    $load = new Loader($error);
    $error->set($error_name, $error_message);
    $load->view(
        'error/error',
        array(
            'error_name'       => $error_name,
            'error_message'    => $error->get($error_name)
        )
    );
}

// Menampilkan basepath
function basepath($path)
{
    echo '/'.$GLOBALS['env']['dir']['views'].'/'.$path;
}

// Pengecekan apakah proyek dalam mode produksi atau tidak
if (!$env['production']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    set_error_handler('phperrorlinter');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 'Off');
}

// Parsing URL
$url = new URL();
$urlcallparts = $url->parse()['call_parts'];

// Pengambilan nama controller
if (count($urlcallparts) > 0) {
    $controllername = ucwords($urlcallparts[0]);
} else {
    $controllername = ucwords($env['default']['controller']);
}

// Pengecekan keberadaan file
if (file_exists($env['dir']['controllers'].'/'.$controllername.'.php')) {
    //require_once $env['dir']['controllers'].'/'.$controllername.'.php';
    $controllername = "\\App\\Controllers\\".$controllername;
    // Pengecekan keberadaan class/controller
    new $controllername();
    if (class_exists($controllername)) {
        $controller = new $controllername();
    
        // Pengambilan nama method
        if (!isset($urlcallparts[1])) {
            $methodname = 'index';
        } else {
            $methodname = $urlcallparts[1];
        }
    
        // Pengecekan keberadaan method dan parameternya (hanya 1 buah parameter)
        if (method_exists($controller, $methodname)) {
            if (isset($urlcallparts[2])) {
                $controller->$methodname($urlcallparts[2]);
            } else {
                $controller->$methodname();
            }
        } else {
            // Pesan apabila method yang dituju tidak tersedia
            if (!$env['production']) {
                $error_name = 'method_unexists';
                $error_message = 'Class <i><b>'.ucwords($urlcallparts[0]).'</b></i> tidak memiliki method/fungsi <i><b>'.((isset($urlcallparts[1]))?$urlcallparts[1]:'index').'</b></i>.';
            } else {
                $error_name = '404';
                $error_message = 'Halaman yang Anda tuju, tidak tersedia.';
            }
            $controller->error->set($error_name, $error_message);
            $controller->load->view(
                'error/error',
                array(
                    'error_name'    => $error_name,
                    'error_message'    => $controller->error->get($error_name)
                )
            );
        }
    } else {
        // Pesan apabila class/controller tidak tersedia
        $controller = new Controller();
        if (!$env['production']) {
            $error_name = 'class_unexists';
            $error_message = 'Class <i><b>'.ucwords($urlcallparts[0]).'</b></i> tidak tersedia pada file <i><b>controllers/'.$urlcallparts[0].'.php</b></i>';
        } else {
            $error_name = '404';
            $error_message = 'Halaman yang Anda tuju, tidak tersedia.';
        }
        $controller->error->set($error_name, $error_message);
        $controller->load->view(
            'error/error',
            array(
                'error_name'    => $error_name,
                'error_message'    => $controller->error->get($error_name)
            )
        );
    }
} else {
    // Pesan apabila file tidak tersedia
        $controller = new Controller();
    if (!$env['production']) {
        $error_name = 'file_unexists';
        $error_message = 'File <i><b>'.$urlcallparts[0].'.php</b></i> tidak tersedia';
    } else {
        $error_name = '404';
        $error_message = 'Halaman yang Anda tuju, tidak tersedia.';
    }
    $controller->error->set($error_name, $error_message);
    $controller->load->view(
        'error/error',
        array(
                'error_name'    => $error_name,
                'error_message'    => $controller->error->get($error_name)
            )
    );
}

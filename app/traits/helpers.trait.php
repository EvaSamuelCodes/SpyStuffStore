<?php

//This is a subset of functions I use frequently on freelance projects.
//Most of it at this point is original, but some of these methods have roots 
//as far back as the Usenet. 

trait helpers {

    public function pretty($thing = false) {
        if ($thing) {
            if (is_array($thing) || is_object($thing)) {
                print "<pre>\n";
                print_r($thing);
                print "</pre>\n";
            } else {
                print "<pre>";
                print $thing;
                print "</pre>";
            }
        }
    }

    public function rick_roll() {
        $this->safe_redirect('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
    }

    public function track() {
        return false;
        //return json_decode(file_get_contents('http://ip-api.com/php/' . $_SERVER['REMOTE_ADDR']));
    }

    private function memory_usage($size): string {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    public function safe_redirect(string $url) {
        ob_start();
        ob_clean();
        ob_end_clean();
        header('Location: ' . $url);
        exit;
    }

    public function is_session_started(): bool {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                return session_id() === '' ? false : true;
            }
        }
        return false;
    }

    public function show_status_messages() {
        if (isset($_SESSION['messages'])) {
            if (count($_SESSION['messages'])) {
                foreach ($_SESSION['messages'] as $message) {
                    print "<div class=\"alert\">{$message}</div>";
                }
                unset($_SESSION['messages']);
            }
        }
    }

}

<?php

class fish_bowl {

    use helpers;

    public function __construct() {
       
        if (strlen(FILE_ROOT) == 0) {
            die('Uh oh. I do not know where I live! Help!');
        }

        $address = $this->get_route();
        $this->implement_class($address);
    }

    //ROUTING

    private function get_route(): array {

        $this->method = strtolower(trim($_SERVER['REQUEST_METHOD']));

        $this->address = explode('/', $_SERVER['REQUEST_URI']);

        //Assume empty methods go to main.
        if (!empty($this->address[1])) {
            if (empty($this->address[2])) {
                $this->address[2] = 'main';
            }
            //Assume classname/123 default to main.
            if (is_numeric($this->address[2])) {
                $this->address[3] = ($this->address[2]);
                $this->address[2] = 'main';
            }
            $id = false;
            if (isset($this->address[3])) {
                $id = filter_var($this->address[3], FILTER_SANITIZE_STRING);
            }

            $this->address = [
                'class' => filter_var($this->address[1], FILTER_SANITIZE_STRING),
                'method' => filter_var($this->address[2], FILTER_SANITIZE_STRING),
                'id' => $id,
            ];
        } else {
            $this->address = [
                'class' => DEFAULT_CLASS,
                'method' => 'main',
                'id' => false,
            ];
        }

        return $this->address;
    }

    //CLASS RENDERING

    public function implement_class(array $route = []) {
        if ($route['class'] == 'default') {
            $file = FILE_ROOT . '/app/classes/' . DEFAULT_CONTROLLER . '.php';
            if (file_exists($file)) {
                $this->safe_redirect(DEFAULT_CONTROLLER);
            } else {

                exit("class does not exist.");
            }
        } else {
            $file = FILE_ROOT . '/app/classes/' . $route['class'] . '.class.php';
            if (file_exists($file)) {
                $object = $route['class'];
            } else {
                print "Trying to open: {$file}\n";
                exit("class does not exist.");
            }

            // So, to avoid the php strict errors which are clogging up the logs,
            // we need to create a static resource. This should do it.

            $application_object = new $object();
            if (method_exists($route['class'], $route['method'])) {
                call_user_func([$application_object, $route['method']], $this);
            } else {

                //last ditch to figure it out. Best guess.
                //If the method is numeric, then default to main and re-assign.


                header("HTTP/1.0 404 Not Found");
                exit("Sorry, couldn't establish route for: {$route['class']}/{$route['method']}");
            }
        }
    }

}

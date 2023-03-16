<?php

class CartController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Cart');
    }

    public function index($errors = [])
    {
        $session = new Session();

        if ($session->getLogin()) {

            $user_id = $session->getUserId();
            $cart = $this->model->getCart($user_id);

            $data = [
                'titulo' => 'Carrito',
                'menu' => true,
                'user_id' => $user_id,
                'data' => $cart,
                'errors' => $errors
            ];

            $this->view('carts/index', $data);

        } else {
            header('location:' . ROOT);
        }
    }

    public function addProduct($product_id, $user_id)
    {
        $errors = [];

        if ($this->model->verifyProduct($product_id, $user_id) == false) {
            if ($this->model->addProduct($product_id, $user_id) == false) {
                array_push($errors, 'Error al insertar el producto en el carrito');
            }
        }
        $this->index($errors);


    }

    public function update()
    {
        if (isset($_POST['rows']) && isset($_POST['user_id']) && isset($_POST['admin_id'])) {
            $errors = [];
            $rows = $_POST['rows'];
            $user_id = $_POST['user_id'];
            $admin_id = $_POST['admin_id'];

            for ($i = 0; $i < $rows; $i++) {
                $product_id = $_POST['i' . $i];
                $quantity = $_POST['c' . $i];
                if (!$this->model->update($user_id,$admin_id, $product_id, $quantity)) {
                    array_push($errors, 'Error al actualizar el producto');
                }
            }
            $this->index($errors);
        }
    }

    public function delete($product, $user, $admin)
    {
        $errors = [];

        if (!$this->model->delete($product, $user, $admin)) {
            array_push($errors, 'Error al borrar el registro del carrito');
        }

        $this->index($errors);
    }

    public function verify()
    {
        $session = new Session();
        $user = $session->getUser();
        $cart = $this->model->getCart($user->id);
        $payment = $_POST['payment'] ?? '';
        $address = $this->model->getAddresses($user->id);

        $data = [
            'titulo' => 'Carrito | Verificar los datos',
            'menu' => true,
            'payment' => $payment,
            'user' => $user,
            'data' => $cart,
            'address' => $address,
        ];

        $this->view('carts/verify', $data);
    }

    public function thanks()
    {
        $session = new Session();
        $user = $session->getUser();

        if ($this->model->closeCart($user->id, 1)) {

            $data = [
                'titulo' => 'Carrito | Gracias por su compra',
                'data' => $user,
                'menu' => true,
            ];

            $this->view('carts/thanks', $data);

        } else {

            $data = [
                'titulo' => 'Error en la actualización del carrito',
                'menu' => false,
                'subtitle' => 'Error en la actualización de los productos del carrito',
                'text' => 'Existió un problema al actualizar el estado del carrito. Por favor, pruebe más tarde o comuníquese con nuestro servicio de soporte',
                'color' => 'alert-danger',
                'url' => 'login',
                'colorButton' => 'btn-danger',
                'textButton' => 'Regresar',
            ];

            $this->view('mensaje', $data);

        }

    }

    public function addressform()
    {
        $session = new Session();

        if( ! $session->getLogin()){
            header('LOCATION:' . ROOT);
        }

        $user = $session->getUser();
        $data = [
            'titulo' => 'Carrito | Forma de pago',
            'subtitle' => 'Rellenar dirección de envío',
            'menu' => true,
            'wtf' => $user,

        ];
        var_dump($user);

        $this->view('carts/addressform', $data);

    }

    public function checkout()
    {
        $session = new Session();
        $user = $session->getUser();
        if ($session->getLogin()) {

            $data = [
                'titulo' => 'Carrito | Datos de envío',
                'subtitle' => 'Checkout | Verificar dirección de envío',
                'menu' => true,
                'data' => $user,
            ];
            $this->view('carts/address', $data);

        } else {
            $data = [
                'titulo' => 'Carrito | Checkout',
                'subtitle' => 'Checkout | Iniciar sesion',
                'menu' => true,
                 'data' => $user,
            ];

            $this->view('carts/checkout', $data);
        }
    }

    public function paymentmode()
    {
        $session = new Session();

        if( ! $session->getLogin()){
            header('LOCATION:' . ROOT);
        }

        $errors = [];
        $user = $session->getUser();
        var_dump($errors);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $firstName = $_POST['first_name'] ?? '';
            $lastName1 = $_POST['last_name_1'] ?? '';
            $lastName2 = $_POST['last_name_2'] ?? '';
            $email = $_POST['email'] ?? '';
            $address = $_POST['address'] ?? '';
            $city = $_POST['city'] ?? '';
            $state = $_POST['state'] ?? '';
            $postcode = $_POST['postcode'] ?? '';
            $country = $_POST['country'] ?? '';

            if( ! ($user->first_name == $firstName)) {
                if ($firstName == '') {
                    array_push($errors, 'Hay que poner un Nombre Obligatorio');
                } else {
                    $user->first_name = $firstName;
                }
            }

            if( ! ($user->last_name_1 == $lastName1)){
                if($lastName1 == ''){
                    array_push($errors , 'Hay que poner el Primer apellido Obligatorio');
                }else {
                    $user->last_name_1 = $lastName1;
                }
            }

            if( ! ($user->last_name_2 == $lastName2)){
                if($lastName2 == ''){
                    array_push($errors , 'Hay que poner el Segundo apellido Obligatorio');
                }else {
                    $user->last_name_2 = $lastName2;
                }
            }

            if( ! ($user->email == $email)){
                if($email == ''){
                    array_push($errors , 'Hay que poner el Email Obligatorio');
                }else {
                    $user->last_name_2 = $lastName2;
                }
            }

            if( ! ($user->address == $address)){
                if($address == ''){
                    array_push($errors , 'Hay que poner la Direccion Obligatorio');
                }else {
                    $user->address = $address;
                }
            }

            if( ! ($user->city == $city)){
                if($city == ''){
                    array_push($errors , 'Hay que poner la ciudad Obligatorio');
                }else {
                    $user->city = $city;
                }
            }

            if( ! ($user->state == $state)){
                if($state == ''){
                    array_push($errors , 'Hay que poner la Probincia Obligatorio');
                }else {
                    $user->state = $state;
                }
            }

            if( ! ($user->zipcode == $postcode)){
                if($postcode == 0){
                    array_push($errors , 'Hay que poner el Codigo Postal Obligatorio');
                }else {
                    $user->zipcode = $postcode;
                }
            }

            if( ! ($user->country == $country)){
                if($country == ''){
                    array_push($errors , 'Hay que poner el Pasis Obligatorio');
                }else {
                    $user->country = $country;
                }
            }

        }


        if (count($errors) > 0) {
            $data = [
                'titulo' => 'Carrito | Checkout',
                'subtitle' => 'Checkout | Iniciar session',
                'menu' => true,
                'data' => $user,
                'errors' => $errors,
            ];
            $this->view('carts/addressform', $data);
        } else {
            $session->login($user);
            $this->model-> updateAddresses($user);
            $data = [
                'titulo' => 'Carrito | Forma de pago',
                'subtitle' => 'Checkout | Forma de pago',
                'menu' => true,
                'data' => $user,
            ];

            $this->view('carts/paymentmode', $data);
        }

    }

}
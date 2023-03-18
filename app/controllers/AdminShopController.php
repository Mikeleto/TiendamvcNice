<?php


require_once '../app/models/Cart.php';
class AdminShopController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminShop');
    }

    public function index()
    {
        $session = new AdminSession();

        if ($session->getLogin()) {
            $data = [
                'titulo' => 'Bienvenid@ a la administración de la tienda',
                'menu' => false,
                'admin' => true,
                'subtitle' => 'Administración de la tienda',
            ];
            $this->view('admin/shop/index', $data);
        } else {
            header('LOCATION:' . ROOT . 'admin');
        }

    }

    public function payMode()
    {
        $users = $this->model->getPayment();

        $status = $this->model->getConfigs('adminStatus');
        $data = [
            'titulo' => 'Carrito | Forma de pago',
            'subtitle' => 'Checkout | Forma de pago',
            'menu' => true,
            'users' => $users,
            'status' => $status,
        ];

        $this->view('admin/shop/payMode', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = [];
            $name = $_POST['name'] ?? '';


            $dataForm = [
                'name' => $name,


            ];

            if (empty($name)) {
                array_push($errors, 'El nombre de usuario es requerido');
            }


            if (!$errors) {

                if ($this->model->createPay($dataForm)) {
                    header("location:" . ROOT . 'AdminShop');
                } else {

                    $data = [
                        'titulo' => 'Error en la creación del metodo de pago',
                        'menu' => false,
                        'errors' => [],
                        'subtitle' => 'Error al crear un nuevo metodo de pago',
                        'text' => 'Se ha producido un error durante el proceso de creación de un metodo de pago',
                        'color' => 'alert-danger',
                        'url' => 'adminUser',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Volver',
                    ];
                    $this->view('mensaje', $data);

                }

            } else {

                $data = [
                    'titulo' => 'Metodo de pago',
                    'menu' => false,
                    'admin' => true,
                    'errors' => $errors,
                    'data' => $dataForm,
                ];

                $this->view('admin/shop/create', $data);

            }

        } else {

            $data = [
                'titulo' => 'Metodo de pago',
                'menu' => false,
                'admin' => true,
                'data' => [],
            ];

            $this->view('admin/shop/create', $data);

        }
    }

    public function updatePay($id)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';

            if ($name == '') {
                array_push($errors, 'El nombre del usuario es requerido');
            }
            if ( ! $errors ) {
                $data = [
                    'id' => $id,
                    'name' => $name,

                ];
                $errors = $this->model->setPay($data);
                if ( ! $errors ) {
                    header("location:" . ROOT . 'adminShop');
                }
            }
            }




        $user = $this->model-> getPaymentById($id);
        $status = $this->model->getConfigs('adminStatus');

        $data = [
            'titulo' => 'Administración de Usuarios - Editar',
            'menu' => false,
            'admin' => true,
            'data' => $user,
            'status' => $status,
            'errors' => $errors,
        ];

        $this->view('admin/shop/updatePay', $data);
    }
    public function sales()
    {
        $session = new AdminSession();
        if ($session->getLogin()) {
           $users = $this->model->getSales();
            $data = [
                'titulo' => 'Administración de Usuarios',
                'menu' => false,
                'admin' => true,
               'users' => $users,
            ];
            $this->view('admin/shop/sales', $data);
        } else {
            header('LOCATION:' . ROOT . 'admin');
        }

    }


    public function moreSales($id)
    {
        $session = new AdminSession();
        if ($session->getLogin()) {



            $data = [
                'titulo' => 'Administración de Usuarios',
                'menu' => false,
                'admin' => true,
                'data' => $this->model->getSalesById($id),

            ];
            $this->view('admin/shop/moreSales', $data);
        } else {
            header('LOCATION:' . ROOT . 'admin');
        }

    }


    public function search()
    {
        $search = $_POST['search'] ?? '';

        if ($search != '') {
            $dataSearch = $this->model->getProducts($search);

            $data = [
                'titulo' => 'Buscador de productos',
                'subtitle' => 'Resultado de la búsqueda',
                'data' => $dataSearch,
                'menu' => true,
            ];

            $this->view('adminShop/search', $data);
        } else {
            header('location:' . ROOT);
        }
    }

    public function deletePay($id)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $errors = $this->model-> deletePay($id);

            if ( ! $errors ) {
                header('location:' . ROOT . 'adminShop');
            }

        }

        $user = $this->model->getPaymentById($id);

        $data = [
            'titulo' => 'Administración de Usuarios - Eliminación',
            'menu' => false,
            'admin' => true,
            'data' => $user,
            'errors' => $errors,
        ];

        $this->view('admin/shop/deletePay', $data);
    }

}

<?php

class AdminSearchController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Search');
    }

    public function products()
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

            $this->view('admin/search/index', $data);
        } else {
            header('location:' . ROOT);
        }
    }
}
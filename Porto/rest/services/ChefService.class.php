<?php
require_once __DIR__ .  '/../dao/ChefDao.class.php';

class ChefService {
    private $chef_dao;

    public function __construct() {
        $this->chef_dao = new ChefDao();
    }

    public function get_all_chefs() {
        return $this->chef_dao->get();
    }

    public function add_chef($chef) {
        return $this->chef_dao->add($chef);
    }

    public function get_chefs($offset, $limit, $search, $order_column, $order_direction) {
        return $this->chef_dao->get_chefs($offset, $limit, $search, $order_column, $order_direction);
    }

    public function count_chefs($search) {
        return $this->chef_dao->count_chefs($search);
    }

    public function get_chef_by_id($chef_id) {
        return $this->chef_dao->get_chef_by_id($chef_id);
    }

    public function delete_chef_by_id($chef_id) {
        return $this->chef_dao->delete_chef_by_id($chef_id);
    }
}
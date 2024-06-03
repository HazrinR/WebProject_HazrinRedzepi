<?php
require_once __DIR__ . '/BaseDao.class.php';

class ChefDao extends BaseDao
{
    //for jwt
    public function __construct() {
        parent::__construct("chefs");
    }

    public function add($chef) {
        return $this->insert('chefs', $chef);
    }

    public function get_chefs($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT * 
                  FROM chefs
                  WHERE LOWER(sname) LIKE CONCAT('%', :search, '%') 
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, ['search' => strtolower($search)]);
    }

    public function get_chefs_new() {
        $query = "SELECT * 
                  FROM chefs";
        return $this->query($query, []);
    }

    public function count_chefs($search) {
        $query = "SELECT COUNT(*) AS count 
                  FROM chefs
                  WHERE LOWER(name) LIKE CONCAT('%', :search, '%')";
        return $this->query_unique($query, ['search' => strtolower($search)]);
    }

    public function get() {
        return $this->get_chefs(0, PHP_INT_MAX, '', 'id', 'ASC');
    }

    public function get_chef_by_id($chef_id){
        return $this->query_unique("SELECT * FROM chefs WHERE id = :id", ["id" => $chef_id]);
    }

    public function delete_chef_by_id($chef_id) {
        $this->execute("DELETE FROM chefs WHERE id = :id", ["id" => $chef_id]);
    }
}
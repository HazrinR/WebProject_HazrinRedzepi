<?php

require_once __DIR__ . '/BaseDao.class.php';

class UserDao extends BaseDao
{

  public function __construct() {
    parent::__construct("users");
  }

  public function add($user) {
    return $this->insert('users', $user);
  }
  public function get_users($offset, $limit, $search, $order_column, $order_direction) {
    $query = "SELECT * 
              FROM users
              WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')
              ORDER BY {$order_column} {$order_direction}
              LIMIT {$offset}, {$limit}";
    return $this->query($query, ['search' => strtolower($search)]);
  }
  public function count_users($search) {
    $query = "SELECT COUNT(*) AS count 
              FROM users
              WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')";
    return $this->query_unique($query, ['search' => strtolower($search)]);
  }
  
   public function get_users_new() {
        $query = "SELECT * 
                  FROM users";
        return $this->query($query, []);
    }

  
  public function get() {
    return $this->get_users(0, PHP_INT_MAX, '', 'user_id', 'ASC');
  }
  public function get_user_by_id($user_id){
    return $this->query_unique("SELECT * FROM users WHERE user_id = :id", ["id" => $user_id]);
  }

  public function delete_user_by_id($user_id) {
    $this->execute("DELETE FROM users WHERE user_id = :id", ["id" => $user_id]);
  }
  public function get_all_users(){
    $query = "SELECT *
              FROM users;";
    return $this->query($query, []);
}
}
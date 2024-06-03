<?php

require_once __DIR__ . '/../dao/UserDao.class.php';

class UserService {

      private $user_dao;

      public function __construct() {
            $this->user_dao = new UserDao();
      }

      public function get_all_users() {
            return $this->user_dao->get_all_users();
      }

      public function add_user($user) {
            return $this->user_dao->add($user);
      }

      public function get_users($offset, $limit, $search, $order_column, $order_direction) {
            return $this->user_dao->get_users($offset, $limit, $search, $order_column, $order_direction);
      }
      public function count_users($search) {
            return $this->user_dao->count_users($search);
      }
      public function get_user_by_id($user_id) {
            return $this->user_dao->get_user_by_id($user_id);
      }

      public function delete_user_by_id($user_id) {
            return $this->user_dao->delete_user_by_id($user_id);
      }
}
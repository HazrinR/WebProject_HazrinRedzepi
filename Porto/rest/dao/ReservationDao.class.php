<?php
require_once __DIR__ . '/BaseDao.class.php';

class ReservationDao extends BaseDao {
    public function __construct() {
        parent::__construct("reservations");
    }

    public function add($reservation) {
        return $this->insert('reservations', $reservation);
    }

    public function get_reservations($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT * 
                  FROM reservations
                  WHERE LOWER(patient_id) LIKE CONCAT('%', :search, '%') OR LOWER(doctor_id) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, ['search' => strtolower($search)]);
    }

    public function count_reservations($search) {
        $query = "SELECT COUNT(*) AS count 
                  FROM reservations
                  WHERE LOWER(patient_id) LIKE CONCAT('%', :search, '%') OR LOWER(doctor_id) LIKE CONCAT('%', :search, '%')";
        return $this->query_unique($query, ['search' => strtolower($search)]);
    }

    public function get() {
        return $this->get_reservations(0, PHP_INT_MAX, '', 'reservation_id', 'ASC');
    }

    public function get_reservation_by_id($reservation_id){
        return $this->query_unique("SELECT * FROM reservations WHERE reservation_id = :id", ["id" => $reservation_id]);
    }

    public function delete_reservation_by_id($reservation_id) {
        $this->execute("DELETE FROM reservations WHERE reservation_id = :id", ["id" => $reservation_id]);
    }
}
/*
class Appointment {
    public $appointment_id;
    public $patient_id;
    public $doctor_id;
    public $appointment_date;
    public $status;

    public function __construct($patient_id, $doctor_id, $appointment_date, $status) {
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->appointment_date = $appointment_date;
        $this->status = $status;
    }
}
*/
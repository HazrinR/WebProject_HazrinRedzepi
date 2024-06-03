<?php
 
require_once __DIR__ .  '/../dao/ReservationDao.class.php';

class ReservationService {
    private $reservation_dao;

    public function __construct() {
        $this->reservation_dao = new ReservationDao();
    }

    public function get_all_reservations() {
        return $this->reservation_dao->get();
    }

    public function add_reservation($reservation) {
        return $this->reservation_dao->add($reservation);
    }

    public function get_reservations($offset, $limit, $search, $order_column, $order_direction) {
        return $this->reservation_dao->get_reservations($offset, $limit, $search, $order_column, $order_direction);
    }

    public function count_reservations($search) {
        return $this->reservation_dao->count_reservations($search);
    }

    public function get_reservation_by_id($reservation_id) {
        return $this->reservation_dao->get_reservation_by_id($reservation_id);
    }

    public function delete_reservation_by_id($reservation_id) {
        return $this->reservation_dao->delete_reservation_by_id($reservation_id);
    }

}

/*class Reservation {
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
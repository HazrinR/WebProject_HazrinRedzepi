var ReservationService = {
    reload_reservation_datatable: function() {
        Utils.get_datatable("admin-table-reservations", Constants.API_BASE_URL + "reservations",
            [
                { data: "action" }, // Pretpostavka: kolona sa akcijama (brisanje, izmena)
                { data: "patient_id" }, // Pretpostavka: kolona za ID pacijenta
                { data: "doctor_id" }, // Pretpostavka: kolona za ID doktora
                { data: "appointment_date" }, // Pretpostavka: kolona za datum pregleda
                { data: "status" } // Pretpostavka: kolona za status pregleda
            ],
            null,
            function() {
                console.log("Datatable drawn");
            }
        );
    },
    delete_reservation: function(reservation_id) {
        if (confirm("Are you sure you want to delete the reservation with ID " + reservation_id + "?")) {
            RestClient.delete(
                "delete_reservation.php?id=" + reservation_id,
                {},
                function(data) {
                    ReservationService.reload_reservation_datatable();
                    console.log("Deleted data: " + data);
                },
                function(error) {
                    console.log(error);
                }
            );
        } else {
            console.log("Dismissed!"); // Dodata poruka u slučaju odbijanja brisanja
        }
    },
};
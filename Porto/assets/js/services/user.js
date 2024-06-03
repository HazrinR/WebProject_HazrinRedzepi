var UserService = {
    //za chefove se isto zove user -ne moze
    open_edit_user_modal: function (user_id) {
      RestClient.get("get_user.php?id=" + user_id, function (data) {
        console.log("DATA IS ", data);
        $("#edit-user-modal").modal("toggle"); // Pretpostavka: koristimo modal za izmjenu pacijenta
        $("#edit-user-form input[name='id']").val(data.id); // Prilagođavanje imena polja prema backend-u
        $("#edit-user-form input[name='name']").val(data.name); // Prilagođavanje imena polja prema backend-u
        $("#edit-user-form input[name='email']").val(data.email); // Prilagođavanje imena polja prema backend-u
        $("#edit-user-form input[name='created_at']").val(data.created_at); // Prilagođavanje imena polja prema backend-u
      });
    },
    delete_user: function (id) {
      if (confirm("Are you sure you want to delete this user?")) {
        RestClient.delete(
          "users/delete" + id,
          { },
          function (data) {
            UserService.reload_users_table();
          }
        );
      } else {
        console.log("Dismissed!"); // Ispravljena greška u logovanju
      }
    },
    reload_users_table: function() {
      Utils.get_datatable(
        "tbl_users",
        Constants.API_BASE_URL + "users/add", // Pretpostavka: API za dobavljanje pacijenata
        [
          { data: "action" }, // Pretpostavka: kolona sa akcijama (izmena, brisanje)
          { data: "name" }, // Pretpostavka: kolona za ime pacijenta
          { data: "date_of_birth" }, // Pretpostavka: kolona za datum rođenja pacijenta
          { data: "gender" }, // Pretpostavka: kolona za pol pacijenta
          { data: "contact_number" }, // Pretpostavka: kolona za kontakt telefon pacijenta
        ]
      );
    }
  };
  
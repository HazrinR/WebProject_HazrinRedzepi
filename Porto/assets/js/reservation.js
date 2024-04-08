let reservations = [];

$("#reservation-form").validate({
    rules: {
        "reservation-name": {
            required: true,
            minlength: 5
        },
        "reservation-email": {
            required: true,
            email: true
        },
        "reservation-subject": {
            required: true
        },
        "reservation-date": {
            required: true,
            dateISO: true
        },
        "reservation-message": {
            required: true,
            minlength: 10
        }
    },
    messages: {
        "reservation-name": {
            required: "Please enter your name"
        },
        "reservation-email": {
            required: "Please enter an email"
        },
        "reservation-subject": {
            required: "Please enter a subject"
        },
        "reservation-date": {
            required: "Please enter a valid date"
        },
        "reservation-message": {
            required: "Please enter a message you want to send",
            minlength: "Please enter a valid message"
        }
    },
    submitHandler: function(form, event) {
        event.preventDefault(); // da mi ne submita
        blockUi("body");
        let reservation = serializeForm(form);
        console.log(JSON.stringify(reservation));

        reservations.push(reservation);
        console.log("Reservations = ", reservations);
        $("#reservation-form")[0].reset();

        unblockUi("body");
    }
});

$("body").on("click focus", "input, textarea", function() {
    const $inputs = $("input, textarea");
    const $blankInputs = $inputs.filter(function() {
        return !$(this).val().trim();
    });

    $inputs.css("border", "1px solid rgba(20, 20, 20, 0.1)");
    $blankInputs.css("border", "1px solid red");
});

blockUi = (element) => {
    $(element).block({
        message: '<div class="spinner-border text-primary" role="status"></div>',
        css: {
            backgroundColor: "transparent",
            border: "0"
        },
        overlayCSS: {
            backgroundColor: "#000000",
            opacity: 0.25
        }
    });
}

unblockUi = (element) => {
    $(element).unblock({});
}

serializeForm = (form) => {
    let jsonResult = {};
    //console.log($(form).serializeArray());
    //serializeArray() reutrns an array of: name: [name of filed], value: [value of filed] for each field in the form
    $.each($(form).serializeArray(), function() {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}
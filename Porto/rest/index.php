<?php
/*require_once __DIR__ . '/../vendor/autoload.php'; // Uključivanje Composer autoload skripte

//  rute definirane u odvojenim datotekama, ukljucujemo na sljedeći način
require_once __DIR__ . '/routes/chef_routes.php';
require_once __DIR__ . '/routes/status_routes.php';
require_once __DIR__ . '/routes/patient_routes.php';
require_once __DIR__ . '/routes/contact_routes.php';
require_once __DIR__ . '/routes/reservation_routes.php';

// Pokretanje aplikacije*/

require_once __DIR__ . '/../vendor/flightphp/core/flight/Flight.php'; //putanja za Flight umjesto /vendor/autoload.php , upustvo kaze ako Flight nije instaliran sa composerom vec samo kopiran ide ovako https://docs.flightphp.com/install

require_once __DIR__ . '/../rest/dao/ChefDao.class.php';
require_once __DIR__ . '/routes/chef_routes.php';

require_once __DIR__ . '/../rest/dao/StatusDao.class.php';
require_once __DIR__ . '/routes/status_routes.php';

require_once __DIR__ . '/../rest/dao/UserDao.class.php';
require_once __DIR__ . '/routes/user_routes.php';

require_once __DIR__ . '/../rest/dao/ContactDao.class.php';
require_once __DIR__ . '/routes/contact_routes.php';

require_once __DIR__ . '/../rest/dao/Reservation/Dao.class.php';
require_once __DIR__ . '/routes/reservation_routes.php';

/*require_once __DIR__ . '/../rest/dao/AuthDao.class.php';
require_once __DIR__ . '/routes/auth_routes.php';*/
Flight::start();
?>
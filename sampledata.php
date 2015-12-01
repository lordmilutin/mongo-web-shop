    <?php
     
    // connect
    $m = new MongoClient();
     
    // select a database
    $db = $m->bazepicerija;
         
    // Pica
    $collection = $db->hrana;
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Hawaii",       "slika" => "pizza1.jpg",  "velicina" => 27,       "cena" => 880, "sastojci" => array( "paradajz sos", "kackavalj", "sunka", "ananas")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Srpska",       "slika" => "pizza2.jpg",  "velicina" => 27,       "cena" => 880, "sastojci" => array( "paradajz sos", "sir, kobasica, slanina, ljuta paprika, jaje")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Mexicana",     "slika" => "pizza3.jpg",  "velicina" => 27,       "cena" => 880, "sastojci" => array( "paradajz sos", "kackavalj, pecenica, kulen, ljuta paprika")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Grcka",        "slika" => "pizza2.jpg",  "velicina" => 27,       "cena" => 710, "sastojci" => array( "paradajz sos", "feta sir, slatka paprika, svez paradajz, crni luk")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Himalaya",     "slika" => "pizza3.jpg",  "velicina" => 27,       "cena" => 810, "sastojci" => array( "paradajz sos", "luk, paprika, pecurke, posni kackavalj, masline")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Massimo",      "slika" => "pizza4.jpg",  "velicina" => 27,       "cena" => 1100, "sastojci" => array( "paradajz sos", "njegoska prsuta", "pecenica", "kackavalj", "preliv (veli sir, jaje, pavlaka, maslinovo ulje)")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Pronto",       "slika" => "pizza2.jpg",  "velicina" => 27,       "cena" => 880, "sastojci" => array( "paradajz sos", "kackavalj", "sunka", "sveza paprika", "slanina", "kulen")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Napolitana",   "slika" => "pizza2.jpg",  "velicina" => 27,   "cena" => 810, "sastojci" => array( "paradajz sos", "kackavalj", "svez paradajz", "slanina", "zelene masline")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Margarita",    "slika" => "pizza2.jpg",  "velicina" => 27,       "cena" => 680, "sastojci" => array( "paradajz sos",  "dimljeni kackavalj", "maslina", "bosiljak")  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Primavera",    "slika" => "pizza3.jpg",  "velicina" => 27,       "cena" => 960, "sastojci" => array( "paradajz sos", "sunka", "kulen", "slanina", "pavlaka", "kackavalj", "pecurke", "crne masline", "jaje" )  ));
    $collection->insert(array( "kategorija" => "Pica", "naziv" => "Capricciosa",  "slika" => "pizza4.jpg",  "velicina" => 27,   "cena" => 860, "sastojci" => array( "paradajz sos", "pecurke", "sunka", "kackavalj", "crne masline", "jaje")  ));
     
    // Pasta
    //$collection = $db->Pasta;
    $collection->insert(array( "kategorija" => "Pasta", "naziv" => "Bolognese",      "slika" => "pasta1.jpg",   "porcija" => "500gr",           "cena" => 540,  "sastojci" => array( "junece mleveno meso", "crni luk", "pelat", "zacini", "kackavalj")  ));
    $collection->insert(array( "kategorija" => "Pasta", "naziv" => "Ibiza",          "slika" => "pasta1.jpg",   "porcija" => "500gr",           "cena" => 510,  "sastojci" => array( "sunka", "paradajz pire", "pelat", "zacini", "kackavalj")  ));
    $collection->insert(array( "kategorija" => "Pasta", "naziv" => "Quatro Formagi", "slika" => "pasta1.jpg",   "porcija" => "500gr",   "cena" => 540,  "sastojci" => array( "mocarela", "dimljeni kackavalj", "feta sir", "gorgonzola", "pavlaka", "kackavalj")  ));
    $collection->insert(array( "kategorija" => "Pasta", "naziv" => "Nesta",          "slika" => "pasta2.jpg",   "porcija" => "600gr",           "cena" => 610,  "sastojci" => array( "pileci file", "mocarela", "dimljeni kackavalj", "feta sir", "gorgonzola", "pavlaka", "kackavalj")  ));
    $collection->insert(array( "kategorija" => "Pasta", "naziv" => "Lazagna",        "slika" => "pasta2.jpg",   "porcija" => "500gr",           "cena" => 570,  "sastojci" => array( "junece mleveno meso", "crni luk", "pelat", "zacini", "kackavalj")  ));
     
    // Sendvic
    //$collection = $db->Sendvic;
    $collection->insert(array( "kategorija" => "Sendvic", "naziv" => "Posni",      "slika" => "sendvic1.jpg",   "cena" => 190,  "sastojci" => array( "tunjevina", "posni kackavalj", "marinirane pecurke", "secerac")  ));
    $collection->insert(array( "kategorija" => "Sendvic", "naziv" => "Tuna",       "slika" => "sendvic1.jpg",   "cena" => 180,  "sastojci" => array( "tunjevina", "paradajz", "crne masline", "crni luk")  ));
    $collection->insert(array( "kategorija" => "Sendvic", "naziv" => "Sunka",      "slika" => "sendvic1.jpg",   "cena" => 150,  "sastojci" => array( "sunka", "kackavalj", "marinirane pecurke", "majonez", "pavlaka")  ));
    $collection->insert(array( "kategorija" => "Sendvic", "naziv" => "Kulen",      "slika" => "sendvic1.jpg",   "cena" => 190,  "sastojci" => array( "kulen", "kackavalj", "kiseli krastavac", "kajmak")  ));
    $collection->insert(array( "kategorija" => "Sendvic", "naziv" => "Suvi vrat",  "slika" => "sendvic1.jpg",   "cena" => 190,  "sastojci" => array( "suvi vrat", "kackavalj", "marinirane pecurke", "pavlaka")  ));
     
    // Palacinka
    //$collection = $db->Palacinka;
    $collection->insert(array( "kategorija" => "Palacinka", "naziv" => "Nutella",     "slika" => "pancake1.jpg",  "cena" => 240,          "sastojci" => array( "nutella", "mlevena plazma", "toping jagoda")  ));
    $collection->insert(array( "kategorija" => "Palacinka", "naziv" => "Eurokrem",    "slika" => "pancake1.jpg",  "cena" => 240,          "sastojci" => array( "eurokrem", "mlevena plazma", "toping cokolada")  ));
    $collection->insert(array( "kategorija" => "Palacinka", "naziv" => "Med i orasi", "slika" => "pancake1.jpg",  "cena" => 290,          "sastojci" => array( "med", "orasi")  ));
    $collection->insert(array( "kategorija" => "Palacinka", "naziv" => "Sunka",       "slika" => "pancake2.jpg",  "cena" => 240,          "sastojci" => array( "sunka", "pavlaka", "sampinjoni", "kackavalj")  ));
    $collection->insert(array( "kategorija" => "Palacinka", "naziv" => "Suvi vrat",   "slika" => "pancake2.jpg",  "cena" => 300,          "sastojci" => array( "suvi vrat", "pavlaka", "sampinjoni", "kackavalj")  ));
    $collection->insert(array( "kategorija" => "Palacinka", "naziv" => "Kulen",       "slika" => "pancake2.jpg",  "cena" => 290,          "sastojci" => array( "kulen", "pavlaka", "sampinjoni", "kackavalj")  ));
     
     
    // find everything in the collection
    $cursor = $collection->find();
     
    // iterate through the results
    foreach ($cursor as $document) {
        echo $document["naziv"] . "</br>";
    }
     
?>
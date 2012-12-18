<?php
/**
* парсер специальностей/регионов/вузов с osvita.ua
* php, mysql, propel
*
* фронтенд (выпадающие связанные списки, модуль для dle 9.6) - https://github.com/Ulv/dle-module-linked-selects.git 
*
* author:        Vladimir Chmil <ulv8888@gmail.com>
* link:          https://github.com/Ulv/parser-for-dle-module-linked-selects.git 
* frontend link: https://github.com/Ulv/dle-module-linked-selects.git 
*/
error_reporting(E_ALL);

$outasJSON     = false;
$debug         = true;
$debug         = ($outasJSON == true) ? false : $debug;

date_default_timezone_set('UTC');

require_once 'propel/Propel.php';
require "lib/nokogiri.php";
require "lib/class.curl.php";


try {
    if ($debug == true)
        echo "Initial DB Operations" . PHP_EOL;
    
    // initial configuration
    Propel::init("dbgen/build/conf/spectovuz-conf.php");
    set_include_path("dbgen/build/classes" . PATH_SEPARATOR . get_include_path());

    if ($debug == true)
        echo "Getting data from osvita.ua..." . PHP_EOL;
    
    $c = new curl('http://ru.osvita.ua/vnz/guide/');
    $c->setopt(CURLOPT_FOLLOWLOCATION, true);
    $html = $c->exec();
    unset($c);
    
    $saw = new nokogiri($html);
    $t   = $saw->get('.glists')->toArray();

    foreach ($t[2]["ul"] as $oneColumn) {
        foreach ($oneColumn["li"] as $oneLi) {
            $specTitle = $oneLi["a"][0]["#text"][0];

            if ($debug == true)
                echo "Parsing '".$specTitle."'" . PHP_EOL;

            $s = SpecQuery::create()->filterByTitle($specTitle)->findOne();
            
            if (is_null($s)) {
                // insert 
                $speciality = new Spec();
                $speciality->setTitle($specTitle);
                $specId = 0;
            } else {
                $specId = $s->getId();
            }

            $page = new curl("http://ru.osvita.ua".$oneLi["a"][0]["href"]);
            $page->setopt(CURLOPT_FOLLOWLOCATION, true);
            $saw_inner = new nokogiri($page->exec());
            $t = $saw_inner->get('.gsearch')->toArray();

            foreach ($t[0]["tbody"][0] as $row) {
                foreach ($row as $one) {
                    // название вуза
                    $vuzTitle = $one["td"][1]["h3"][0]["a"][0]["title"];
                    $regionTitle = $one["td"][2]["#text"][0];

                    $v = VuzQuery::create()->filterByTitle($vuzTitle)->findOne();
                    $r = RegionQuery::create()->filterByTitle($regionTitle)->findOne();

                    if (is_null($v)) {
                        $vuz = new Vuz();
                        $vuz->setTitle($vuzTitle);
                        $vuzId = 0;
                    } else {
                        $vuzId = $v->getId();
                    }

                    if (is_null($r)) {
                        // insert 
                        $region = new Region();
                        $region->setTitle($regionTitle);
                        $regId = 0;
                    } else {
                        $regId = $r->getId();
                    }
                    
                    if ($specId ==0 || $vuzId ==0 || $regId ==0) {

                        $sp = new SpecToVuz();

                        if ($specId == 0) {
                            $sp->setSpec($speciality);
                        } else {
                            $sp->setSpecId($specId);
                        }


                        if ($vuzId == 0) {
                            $sp->setVuz($vuz);
                        } else {
                            $sp->setVuzId($vuzId);
                        }
                        
                        if ($regId == 0) {
                            $sp->setRegion($region);
                        } else {
                            $sp->setRegionId($regId);
                        }

                        $sp->save();

                        unset($vuz);
                        unset($region);
                    }

                }
            }

            unset($t);
            unset($saw_inner);
            unset($page);
            unset($speciality);

        }
        
    }

}
catch (PDOException $e) {
    if ($outasJSON == true) {
        $msg = json_encode(array(
            "error" => $e->getMessage()
        ));
    } else {
        $msg = $e->getMessage();
    }
    echo $msg;
}
?>


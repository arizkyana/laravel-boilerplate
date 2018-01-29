<?php
/**
 * Created by PhpStorm.
 * User: agung
 * Date: 11/4/2017
 * Time: 19:50
 */

namespace App\Utils;


use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

use DiDom;

class Disduk
{

    public static function get_detail_warga($nik, $kk)
    {

        $document = new DiDom\Document(Config::get('disduk.URL') . $nik . $kk, true);
        $tablebody = $document->find(".table-responsive table tbody");

        if (sizeof($tablebody) > 0) {
            $tablebodyDocument = new DiDom\Document($tablebody[0]->html());

            $rows = $tablebodyDocument->find("tr");

            $persons = array();
            foreach ($rows as $row) {
                $columns = $row->find("td");

                $person = array(
                    'nik' => $columns[1]->text(),
                    'nama' => $columns[2]->text(),
                    'tempat_lahir' => $columns[3]->text(),
                    'tanggal_lahir' => $columns[4]->text() ? \DateTime::createFromFormat("Y-m-d", $columns[4]->text())->format("d/m/Y") : "",
                    'jenis_kelamin' => $columns[5]->text(),
                    'alamat' => $columns[6]->text(),
                    'kelurahan' => $columns[10]->text(),
                    'kawin' => $columns[13]->text()
                );

                $persons[] = $person;
            }

            return $persons[0];
        } else {
            return false;
        }
    }


}
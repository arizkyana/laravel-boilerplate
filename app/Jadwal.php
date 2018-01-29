<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    public static function lokasi($jenis, $id)
    {
        switch ($jenis) {
            case 1:
                $lokasi = Sekolah::find($id);
                break;
            case 2:
                $lokasi = Faskes::find($id);
                break;
            case 3:
                $lokasi = Perkimtan::find($id);
                break;
            case 4:
                $lokasi = Apartment::find($id);
                break;
            case 5:
                $lokasi = Perumahan::find($id);
                break;

        }
        return $lokasi;
    }
}

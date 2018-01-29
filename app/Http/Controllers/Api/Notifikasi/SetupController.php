<?php

namespace App\Http\Controllers\Api\Notifikasi;

use App\Dinkes;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kelurahan;
use App\NotificationHistory;
use App\NotificationSetup;
use App\Role;
use App\User;
use App\Utils\ResponseMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->auth_user;

        $notifikasi = DB::table('notification_history')
            ->select('notification_history.status', 'notification_history.created_at', 'notification_setup.title', 'notification_setup.body', 'notification_history.id_laporan')
            ->leftJoin('notification_setup', 'notification_history.id_notification_setup', '=', 'notification_setup.id')
            ->leftJoin('laporan', 'notification_history.id_laporan', '=', 'laporan.id')
            ->where('receiver', '=', $user->id)
            ->whereRaw('laporan.status <> ? AND laporan.status <> ? ', [0, 2])
            ->get();

        return ResponseMod::success([
            'receiver' => $user,
            'notifications' => $notifikasi
        ]);
    }

    public function today_web(Request $request)
    {
        $user = User::find($request->input('user'));

        $limit = $request->input('limit') ? $request->input('limit') : 10;

        $tanggal_mulai = date('Y-m-d 00:00:00');
        $tanggal_akhir = date('Y-m-d 23:59:59');

        $notifikasi = DB::table('notification_history')
            ->select('notification_history.status', 'notification_history.created_at', 'notification_setup.title', 'notification_setup.body', 'notification_history.id_laporan')
            ->leftJoin('notification_setup', 'notification_history.id_notification_setup', '=', 'notification_setup.id')
            ->where('receiver', '=', $user->id)
            ->whereBetween('notification_history.created_at', [$tanggal_mulai, $tanggal_akhir])
            ->limit($limit)
            ->get();

        $count = count($notifikasi);

        return ResponseMod::success([
            'receiver' => $user,
            'notifications' => $notifikasi,
            'count' => $count
        ]);

    }


    public function today_mobile(Request $request)
    {
        $user = $request->auth_user;

        $limit = $request->input('limit') ? $request->input('limit') : 10;
        $date_param = $request->input('date_param') ? $request->input('date_param') : 'Y-m-d';

        $tanggal = date($date_param . ' hh:mm:ss');

        $notifikasi = DB::table('notification_history')
            ->select('notification_history.status', 'notification_history.created_at', 'notification_setup.title', 'notification_setup.body', 'notification_history.id_laporan')
            ->leftJoin('notification_setup', 'notification_history.id_notification_setup', '=', 'notification_setup.id')
            ->where('receiver', '=', $user->id)
            ->where('notification_history.created_at', '<', $tanggal)
            ->limit($limit)
            ->get();

        return ResponseMod::success($notifikasi);

    }


}

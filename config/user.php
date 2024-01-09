<?php

use Illuminate\Support\Facades\DB;

return [
    'userDetail' => function () {
        // Mengambil data user yang sedang login
        $user = session('id_user', '');

        // Mengambil data user_detail terkait
        $userDetail = DB::table('user_detail')->where('id_user', $user)->first();

        return $userDetail;
    },
    'role' => function () {
        $role = session('role', '');
        return $role;
    },
];
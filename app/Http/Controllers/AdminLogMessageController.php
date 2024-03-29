<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CRUDBooster;
use DateTime;
class AdminLogMessageController extends \crocodicstudio\crudbooster\controllers\CBController
{
    public function getIndex() {
        $data = [];
        return view('custom_adminn_view.logsmessage', compact('data'));
    }

}
<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:details admin')->only(['show']);
    }


    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.user-management.admin.list');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {   $user = User::find($id);
        return view('pages.apps.user-management.admin.show', compact('user'));
    }
}

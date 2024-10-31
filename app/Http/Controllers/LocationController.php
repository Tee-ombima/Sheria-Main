<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Constituency;
use App\Models\Subcounty;
class LocationController extends Controller
{
    //

    public function getConstituencies($homecounty_id)
    {
        $constituencies = Constituency::where('homecounty_id', $homecounty_id)->get();
        return response()->json($constituencies);
    }

    public function getSubcounties($constituency_id)
    {
        $subcounties = Subcounty::where('constituency_id', $constituency_id)->get();
        return response()->json($subcounties);
    }
}

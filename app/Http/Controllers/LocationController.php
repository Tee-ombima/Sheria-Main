<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcounty;
use App\Models\Constituency;

class LocationController extends Controller
{
    // public function getSubcounties($homecounty_id)
    // {
    //     $subcounties = Subcounty::where('homecounty_id', $homecounty_id)->get();
    //     return response()->json($subcounties);
    // }

    // public function getConstituencies($subcounty_id)
    // {
    //     $constituencies = Constituency::where('subcounty_id', $subcounty_id)->get();
    //     return response()->json($constituencies);
    // }
    public function getSubcounties($homecounty_id)
{
    $subcounties = Subcounty::where('homecounty_id', $homecounty_id)->get();
    return response()->json($subcounties);
}

public function getConstituencies($subcounty_id)
{
    $constituencies = Constituency::where('subcounty_id', $subcounty_id)->get();
    return response()->json($constituencies);
}
}
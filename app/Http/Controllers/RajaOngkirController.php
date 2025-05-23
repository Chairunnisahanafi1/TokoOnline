<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Http; 
class RajaOngkirController extends Controller 
{
    public function index()
    {
        $response = Http::withHeaders([
            'key' => ( env('KOMERCE_API_KEY'))
        ])->get('https://api.rajaongkir.com/starter/province');

        dd($response->json());

        return view('list-ongkir');
    }
}
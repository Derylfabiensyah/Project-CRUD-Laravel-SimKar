<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Event;
use App\Models\Karyawan;
use App\Models\absensi;
use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data = [
            'jumlah_karyawan' => Karyawan::count(),
            'jumlah_event' => Event::count(),
            'jumlah_absensi' => Absensi::count(),
        ];
        return view('home', $data);
    }
    public function contact() {
        return view('contact');
    }
    public function about() {
        return view('about');
    }

    public function testing() {
        $category = Category::get();
        $product = Product::with('category')->get();    
        dd($category);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\Stock;
use App\Message;
use App\Slider;

class MainController extends Controller
{
    public function index()
    {
      $sliders = Slider::get();

      return view('pages.index', compact('sliders'));
    }

    public function contact()
    {
      return view('pages.contact');
    }

    public function catalog()
    {
      return view('pages.catalog');
    }

    public function services()
    {
      return view('pages.services');
    }

  public function getcatalog(Request $request)
    {
      // return $request;

      $array = [];

      if($request->option1 == 'true') {
        array_push($array, "state1");
      }

      if($request->option2 == 'true') {
        array_push($array, "state2");
      }

      if($request->option3 == 'true') {
        array_push($array, "state3");
      }

      if($request->option4 == 'true') {
        array_push($array, "state4");
      }

      if($request->option5 == 'true') {
        array_push($array, "state5");
      }

      if($request->option6 == 'true') {
        array_push($array, "state6");
      }

      if($request->option7 == 'true') {
        array_push($array, "state7");
      }

      if($request->option0 == 'true'){
        array_push($array, "state1");
        array_push($array, "state2");
        array_push($array, "state3");
        array_push($array, "state4");
        array_push($array, "state5");
        array_push($array, "state6");
        array_push($array, "state7");
      }

      if($request->brand == "Все") {
        $catalogs = Catalog::whereIn('type', $array)->orderBy('price', $request['price'])->latest()->paginate(12);
      } else {
        $catalogs = Catalog::where('brand', '=', $request['brand'])->whereIn('type', $array)->orderBy('price', $request['price'])->latest()->paginate(12);
      }

      // $catalogs = Catalog::latest()->get();

      return $catalogs;
    }

    public function catalogsolo($id)
    {
      $catalog = Catalog::findOrFail($id);
      $images = json_decode($catalog->images);

      isset($catalog->seo_title) ? $seo_title = $catalog->seo_title : $title=NULL;
      isset($catalog->seo_desc) ? $seo_desc = $catalog->seo_desc : $description=NULL;
      isset($catalog->seo_keywords) ? $seo_keywords = $catalog->seo_keywords : $keywords=NULL;
      isset($catalog->mainimage) ? $seo_img = $catalog->mainimage : $seo_img=NULL;


      return view('pages.catalogsolo', compact('catalog', 'images', 'seo_title', 'seo_desc', 'seo_keywords', 'seo_img'));
    }

    public function getbrands()
    {
      $brands = Catalog::select('brand')->groupBy('brand')->get();

      return $brands;
    }

    public function stock()
    {
      $stocks = Stock::latest()->paginate(10);

      return view('pages.stock', compact('stocks'));
    }

    public function stocksolo($id)
    {
      $stock = Stock::findOrFail($id);

      isset($stock->seo_title) ? $seo_title = $stock->seo_title : $title=NULL;
      isset($stock->seo_desc) ? $seo_desc = $stock->seo_desc : $description=NULL;
      isset($stock->seo_keywords) ? $seo_keywords = $stock->seo_keywords : $keywords=NULL;
      isset($stock->image) ? $seo_img = $stock->image : $seo_img=NULL;

      return view('pages.stocksolo', compact('stock', 'seo_title', 'seo_desc', 'seo_keywords', 'seo_img'));
    }

    public function sendmessage(Request $request)
    {

      $message = new Message;
      $message->name = $request['name'];
      $message->phone = $request['phone'];
      $message->save();

      return $message;

    }
}

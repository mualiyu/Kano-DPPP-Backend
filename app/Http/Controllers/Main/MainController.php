<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Tender;
use App\Models\News;
use App\Models\PressRelease;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\Vue;

class MainController extends Controller
{
    public function index()
    {
      $downs = Download::all();
      $newss = News::all();
      $presss = PressRelease::all();
      $vids = Video::all();
      $gs = Gallery::all();

      if (count($newss)) {
        $news = News::all()->last();
      }else{
        $news = "";
      }

      if (count($presss)) {
        $press = PressRelease::all()->last();
      }else{
        $press = "";
      }

      if (count($downs)) {
        $down = Download::all()->last();
      }else{
        $down = "";
      }

      if (count($vids)) {
        $vid = Video::all()->last();
      }else{
        $vid = "";
      }

      if (count($gs)) {
        $g = Gallery::all()->last();
      }else{
        $g = "";
      }

      return view('main.index', compact('news', 'press', 'down', 'g', 'vid'));
    }

    public function about_us()
    {
      return view('main.about');
    }

    public function eap()
    {
      return view('main.eap');
    }

    public function wwu()
    {
      $tenders = Tender::orderBy('created_at', "DESC")->paginate(5);

      return view('main.wwu', compact('tenders'));
    }

    public function wwu_test()
    {
      $tenders = Tender::orderBy('created_at', "DESC")->paginate(5);

      return view('main.wwu_t', compact('tenders'));
    }

    public function job_info(Tender $tender)
    {
      return view('main.job_info', compact('tender'));
    }

    public function news()
    {
      $news = News::orderBy('created_at', "DESC")->paginate(3);

      // return $news;
      return view('main.news', compact('news'));
    }

    public function single_news(News $news)
    {
      return view('main.news_single', compact('news'));
    }

    public function press()
    {
      $press = PressRelease::orderBy('created_at', "DESC")->paginate(3);
      return view('main.press', compact('press'));
    }

    public function single_press(PressRelease $press)
    {
      return view('main.press_single', compact('press'));
    }

    public function gallery()
    {
      $galleries = Gallery::orderBy('created_at', "DESC")->paginate(6);
      return view('main.gallery', compact('galleries'));
    }

    public function single_gallery(Gallery $gallery)
    {
      return view('main.gallery_single', compact('gallery'));
    }

    public function videos()
    {
      $videos = Video::orderBy('created_at', "DESC")->paginate(6);
      return view('main.videos', compact('videos'));
    }

    public function faq()
    {
      $faqs = Faq::all();

      return view('main.faq', compact('faqs'));
    }

    public function downloads()
    {
      $downs = Download::orderBy('created_at', "DESC")->paginate(5);
      return view('main.downloads', compact("downs"));
    }

    public function download_doc(Download $download)
    {

        $storage = Storage::disk('local')->path('public/download/'.$download->doc);

        return response()->file($storage);
    }

    public function contact_us()
    {
      return view('main.contact_us');
    }
}

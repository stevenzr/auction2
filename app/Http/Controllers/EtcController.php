<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use Auth;
use DB;

class EtcController extends Controller
{
    public function home(Request $request) {
        
        $paginate = 4;
        $new1 = Auction::where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        return view('home', compact('request','new1'));
    }

    public function products(Request $request) {
        $paginate = 9;
        $endingSoonest = Auction::where('status', 'active')->orderBy('end_date')->paginate($paginate);
        $endingLatest = Auction::where('status', 'active')->orderByDesc('end_date')->paginate($paginate);
        $new = Auction::where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $popular = Auction::withCount('bids')->where('status', 'active')->orderByDesc('bids_count')->paginate($paginate);
        $toys =Auction::where('category','toys')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $electronic =Auction::where('category','electronic')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $accessories = Auction::where('category','accessories')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $hobbies = Auction::where('category','hobbies')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        
        $price1 = Auction::where('status','active')->orderBy('price','<','100000');
       
        

        $orderedAuctions = [$endingSoonest, $endingLatest, $new, $popular];
        $orderedAuctionTypes = ['ending_soonest', 'ending_latest', 'new', 'popular'];
        $categories = ['Toys','Electronic','Accessories','Hobbies'];
        $categoriestype = [$toys,$electronic,$accessories,$hobbies];
        $pricecount =['<Rp 100.000','Rp 100.000 - Rp 250.000','Rp 250.000 - Rp 500.000', 'Rp 500.000 - Rp 1.000.000','>Rp1.000.000'];
        
        return view('products', compact('request', 'orderedAuctions', 'orderedAuctionTypes','categories','categoriestype','pricecount','pricesort','priceg','paginate'));
    }

    public function profile(Request $request) {
        $user = Auth::user();
        $activeAuctions = Auction::where('status', 'active')->take(4)->get();

        return view('profile', compact('user', 'activeAuctions'));
    }
    
    public function login(Request $request){
        return view('login');
    }

    public function iSearch(Request $request) {
        $query = $request->input('query');
        $searchResults = Auction::where([['title', 'like', "%{$query}%"], ['status', 'active']])->paginate(8);

        return view('isearch', compact('searchResults'));
    }
  

    public function setLocale(Request $request, $locale) {
        $locales = ['nl', 'fr', 'en'];

        if(in_array($locale, $locales)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->back();
    }

    public function redirectHome(Request $request) {
        return redirect()->route('home');
    }

    public function termsAndCondition(Request $request){

        return view('termsAndCondition');
        }
    public function toys(Request $request) {
        $paginate = 9;
        $endingSoonest = Auction::where('category','toys')->where('status', 'active')->orderBy('end_date')->paginate($paginate);
        $endingLatest = Auction::where('category','toys')->where('status', 'active')->orderByDesc('end_date')->paginate($paginate);
        $new = Auction::where('category','toys')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $popular = Auction::withCount('bids')->where('category','toys')->where('status', 'active')->orderByDesc('bids_count')->paginate($paginate);
        $toys = Auction::where('category','toys')->where('status', 'active')->orderBy('created_at')->paginate($paginate);
        
       
        

        $orderedAuctions = [$endingSoonest, $endingLatest, $new, $popular];
        $orderedAuctionTypes = ['ending_soonest', 'ending_latest', 'new', 'popular'];
        
        
        return view('toys', compact('request', 'orderedAuctions', 'orderedAuctionTypes','toys'));
    }
    public function electronic(Request $request) {
        $paginate = 9;
        $endingSoonest = Auction::where('category','electronics')->where('status', 'active')->orderBy('end_date')->paginate($paginate);
        $endingLatest = Auction::where('category','electronics')->where('status', 'active')->orderByDesc('end_date')->paginate($paginate);
        $new = Auction::where('category','electronics')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $popular = Auction::withCount('bids')->where('category','electronics')->where('status', 'active')->orderByDesc('bids_count')->paginate($paginate);
        $electronic = Auction::where('category','electronics')->where('status', 'active')->orderBy('created_at')->paginate($paginate);
        
       
        

        $orderedAuctions = [$endingSoonest, $endingLatest, $new, $popular];
        $orderedAuctionTypes = ['ending_soonest', 'ending_latest', 'new', 'popular'];
        
        
        return view('electronic', compact('request', 'orderedAuctions', 'orderedAuctionTypes','electronic'));
    }
      public function accessories(Request $request) {
        $paginate = 9;
        $endingSoonest = Auction::where('category','accessories')->where('status', 'active')->orderBy('end_date')->paginate($paginate);
        $endingLatest = Auction::where('category','accessories')->where('status', 'active')->orderByDesc('end_date')->paginate($paginate);
        $new = Auction::where('category','accessories')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $popular = Auction::withCount('bids')->where('category','accessories')->where('status', 'active')->orderByDesc('bids_count')->paginate($paginate);
        $accessories = Auction::where('category','accessories')->where('status', 'active')->orderBy('created_at')->paginate($paginate);
        
       
        

        $orderedAuctions = [$endingSoonest, $endingLatest, $new, $popular];
        $orderedAuctionTypes = ['ending_soonest', 'ending_latest', 'new', 'popular'];
        
        
        return view('accessories', compact('request', 'orderedAuctions', 'orderedAuctionTypes','accessories'));
    }
     public function hobbies(Request $request) {
        $paginate = 9;
        $endingSoonest = Auction::where('category','hobbies')->where('status', 'active')->orderBy('end_date')->paginate($paginate);
        $endingLatest = Auction::where('category','hobbies')->where('status', 'active')->orderByDesc('end_date')->paginate($paginate);
        $new = Auction::where('category','hobbies')->where('status', 'active')->orderByDesc('created_at')->paginate($paginate);
        $popular = Auction::withCount('bids')->where('category','hobbies')->where('status', 'active')->orderByDesc('bids_count')->paginate($paginate);
        $hobbies = Auction::where('category','hobbies')->where('status', 'active')->orderBy('created_at')->paginate($paginate);
        
       
        

        $orderedAuctions = [$endingSoonest, $endingLatest, $new, $popular];
        $orderedAuctionTypes = ['ending_soonest', 'ending_latest', 'new', 'popular'];
        
        
        return view('hobbies', compact('request', 'orderedAuctions', 'orderedAuctionTypes','hobbies'));
    }
}

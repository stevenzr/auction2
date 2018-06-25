<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddAuction;
use App\Http\Requests\AddBid;
use App\Auction;
use App\Bid;
use Carbon\Carbon;
use Auth;
use Image;
use DB;

class AuctionController extends Controller
{
    public function myAuctions(Request $request) {
        $activeAuctions = Auth::user()->auctions->where('status', 'active');
        $expiredAuctions = Auth::user()->auctions->where('status', 'expired');
        $soldAuctions = Auth::user()->auctions->where('status', 'sold');

        return view('my_auctions', compact('activeAuctions', 'expiredAuctions', 'soldAuctions'));
    }

    public function newAuction(Request $request) {
        return view('new_auction');
    }

    public function addAuction(AddAuction $request) {
        $optionalImagePath = null;
        $endDate = Carbon::createFromFormat('d/m/y', $request->end_date);
        $formattedEndDate = $endDate->format('Y-m-d');
        $imageQuality = 60;

        if($request->artwork_image->isValid() ) {
         //set the name for uploaded file
         $artwork_imageName = time() . '.' . $request->file('artwork_image')->getClientOriginalExtension();

         $s3 = Storage::disk('s3');
         $s3->put($artwork_imageName,file_get_contents($request->file('artwork_image')), 'public');
         $artworkImagePath = Storage::disk('s3')->url($artwork_imageName);
        }
        else {
            return redirect()->back();
        }

        Auction::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'artwork_image_path' => $artworkImagePath,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'buyout_price' => $request->buyout_price,
            'end_date' => $formattedEndDate,
        ]);

        return redirect()->route('myAuctions');
    }

    public function auctionDetail(Request $request, Auction $auction, $auctionTitle = null) {
        $isInWatchlist = $this->getWatchlistAuctionInfo($auction->id)['isInWatchlist'];
        $amountOfBids = $auction->bids->count();
        $amountOfBidsByCurrentUser = $auction->bids->where('user_id', Auth::id())->count();
        $tes2 = DB::table('bids')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->first()->price;

        if ($amountOfBids >0){
        $latestBid = DB::table('bids')->where('auction_id', '=', $auction->id)->orderBy('price', 'desc')->first()->price;


        return view('auction_detail', compact('auction', 'isInWatchlist', 'amountOfBids', 'amountOfBidsByCurrentUser' , 'latestBid' , 'tes2'));
        }else{
           $tes = 'Rp. - (no one bid yet)';
        return view('auction_detail', compact('auction', 'isInWatchlist', 'amountOfBids', 'amountOfBidsByCurrentUser', 'tes'));
        }
    }

    public function auctionBuyout(Request $request, Auction $auction, $auctionTitle = null) {
        if($auction->status == 'active') {
            $auction->status = 'sold';
            $auction->save();
        }

        return view('thank_you');
    }

    public function addBid(AddBid $request, Auction $auction, $auctionTitle = null) {
        if($auction->status == 'active') {
            Bid::create([
                'user_id' => Auth::id(),
                'auction_id' => $auction->id,
                'price' => $request->bid_price,
            ]);
        }

        return redirect()->back();
    }
     //add function deleteauction
    public function deleteAuction(Request $request, Auction $auction){
        if($auction->status == 'active') {
            $auction::find($auction->id);
            $auction->delete();

        }
        return redirect()->route('myAuctions');
    }
}

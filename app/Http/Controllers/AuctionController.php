<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddAuction;
use App\Http\Requests\AddBid;
use App\Auction;
use App\Bid;
use Carbon\Carbon;
use Auth;
use Image;

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
            'end_date' => $formattedEndDate,
        ]);

        return redirect()->route('myAuctions');
    }

    public function auctionDetail(Request $request, Auction $auction, $auctionTitle = null) {
        $isInWatchlist = $this->getWatchlistAuctionInfo($auction->id)['isInWatchlist'];
        $amountOfBids = $auction->bids->count();
        $amountOfBidsByCurrentUser = $auction->bids->where('user_id', Auth::id())->count();

        return view('auction_detail', compact('auction', 'isInWatchlist', 'amountOfBids', 'amountOfBidsByCurrentUser'));
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
}

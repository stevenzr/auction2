<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuctionEnded extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $auctionTitle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $auctionTitle)
    {
        $this->userName = $userName;
        $this->auctionTitle = $auctionTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("{$this->auctionTitle} has ended")->markdown('emails.auction_ended_nobid');
    }
}

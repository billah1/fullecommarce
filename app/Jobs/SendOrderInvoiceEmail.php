<?php

namespace App\Jobs;

use App\Mail\NewOrderInvoiceMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderInvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::whereId($this->order->ordered_by)->first();
        Log::info('Order processed for user:', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'order_id' => $this->order->id
        ]);
        Mail::to($user->email)->send(new NewOrderInvoiceMail($this->order->load('billingDetail')));

    }
}

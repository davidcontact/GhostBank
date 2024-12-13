@extends('layouts.app')

@section('title', 'Wallets')
@push('home-style')
<style>
    .wallet-content{
        display: flex;
        justify-content: space-between;
        /* background-color: aqua; */
        width: 85%;
    }
    .wallet-content .amount-data{
        /* background-color: #; */
        display: flex;
        justify-content: center;
        width: 50%;
        padding: 20px 30px;
    }
    .wallet-content .amount-data .box-payment{
        background-color: #d7d3ca;
        display: flex;
        flex-direction: column;
        /* gap: 10px; */
        width: 100%;
        border: 2px solid #775104;
        border-radius: 10px;
        padding: 10px 25px;
        transform: translateY(50px);
        opacity: 0;
        transition: opacity 1s, transform 1s;
    }
    .wallet-content .amount-data .box-payment.visible{
        opacity: 1;
        transform: translateY(0);
    }
    .wallet-content .amount-data .box-payment h4{
        font-family: sans-serif;
        font-weight: 400;
    }
    .wallet-content .amount-data .box-payment h5{
        font-family: sans-serif;
        font-size: 20px;
        border-bottom: 2px solid #775104;
        padding: 5px 0px;
        /* line-height: 4px; */
        font-weight: 400;
    }
    .wallet-content .amount-data .box-payment .button-payment{
        display: flex;
        gap: 10px;
        margin-top: 6px;
        margin-bottom: 12px;
        border-bottom: 2px solid #775104;
    }
    .wallet-content .amount-data .box-payment .button-payment .button-gay{
        display: flex;
        align-items: center;
        font-size: 13px;
        font-family: sans-serif;
        padding: 5px 30px;
        border: none;
        margin-bottom: 15px;
        color: white;
        background-color: #775104;
        border-radius: 5px;
    }
    .wallet-content .amount-data .box-payment .transaction{
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .wallet-content .amount-data .box-payment .transaction h4{
        font-family: sans-serif;
        /* font-weight: 800; */
        /* font-size: 20px; */
    }
    .wallet-content .amount-data .box-payment .transaction .data-notification{
        display: flex;
        align-items: center;
        /* background-color: aqua; */
        width: 100%;
        justify-content: space-between;
        border-bottom: 1px solid #775104;

    }
    .wallet-content .amount-data .box-payment .transaction .data-notification h4{
        /* font-family: sans-serif; */
        font-size: 16px;
        margin-top: 0 !important; /* Resets margin-top */
        margin-bottom: 0 !important; /* Resets margin-bottom */
    }
    .wallet-content .amount-data .box-payment .transaction .data-notification .get_amount{
        margin-top: 0 !important; /* Resets margin-top */
        margin-bottom: 0 !important; /* Resets margin-bottom */
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        animation: fadeIn 0.3s ease-in-out;
    }
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        animation: slideUp 0.3s ease-in-out;
    }
    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    .close-btn:hover {
        color: black;
    }
    .send-form input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .submit-btn {
        width: 100%;
        padding: 10px;
        background-color: #775104;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .Funds { 
        color: rgb(12, 183, 12);
    }
    .Payment  { 
        color: red;
    }
    .modal1{
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        animation: addressFadeIn 0.3s ease-in-out;
    }
    .modal1 .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        animation: slideAdsress 0.3s ease-in-out;
    }
    .modal1 .modal-content div{
        display: flex;
        flex-direction: column;
        gap: 0px;
    }
    .modal1 .modal-content div h4{
        font-size: 20px;    
    }

    .modal1 .modal-content div h2{
        padding: 10px;
        font-size: 22px !important;
        font-family: sans-serif;
        border: 2px solid #775104;
    }
    @keyframes addressFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideAdsress {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
@section('content')
<div class="wallet-content">
    <div class="amount-data">
        <div class="box-payment">
            <h4>Total Balance</h4>
            @if ($wallet)
                <h5 id="counter" >{{ $wallet->balance }}$</h5>
            @else
                <p>No wallet found for this user.</p>
            @endif
            <div class="button-payment">
                <button class="button-gay" onclick="openSendModal()">Pay</button>
                <button class="button-gay" onclick="openAddress()">Received</button>
            </div>
            <div class="transaction">
                <h4>Recent Transaction</h4>
                @if($notifications->isEmpty())
                    <p>No transaction data available.</p>
                @else
                    @foreach($notifications as $notification)
                        <div class="data-notification">
                            <h4>{{ $notification->title }}.</h4>
                            <p class="get_amount {{ $notification['title']}}">{{ $notification['title'] === 'Funds Received' ? "+{$notification->transaction->amount}" : "-{$notification->transaction->amount}" }}$</p>
                        </div>
                    @endforeach
                @endif

                {{-- @foreach($notifications as $notification)
                    <div class="data-transaction">
                        <h4>{{ $transaction->description }}</h4>
                        <h4>{{ $transaction->amount }} {{ $transaction->currency_type }}</h4>
                    </div>
                @empty
                    <p>No recent transactions.</p>
                @endforelse --}}
            </div>
        </div> 
    </div>
    <div class="chart">
        <h4>hi man</h4>

    </div>
    <div id="sendModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeSendModal()">&times;</span>
            <h2>Send Money</h2>
            <form class="send-form" method="POST" action="{{ route('Transaction') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" placeholder="Address" class="@error('Address') is-invalid @enderror" id="Address" name="Address"  required>
                <input type="text" placeholder="Amount" class="@error('Amount') is-invalid @enderror" id="Amount" name="Amount"  required>
                <button type="submit" class="submit-btn">Send Money</button>
            </form>
        </div>
    </div>

    <div id="check_address" class="modal1">
        <div class="modal-content">
            <span class="close-btn" onclick="AddressCLose()">&times;</span>
            <div>
                <h4>UID Address</h4>
                <h2>{{ $wallet->wallet_address }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    <script>
        function openSendModal() {
            document.getElementById('sendModal').style.display = 'block';
        }


        function closeSendModal() {
            document.getElementById('sendModal').style.display = 'none';
        }

        function openAddress(){
            document.getElementById('check_address').style.display = 'block';
        }
        // alert("lol");
        function AddressCLose(){
            document.getElementById('check_address').style.display = 'none';
        }
        const bankPayment = document.querySelectorAll(".box-payment");

        const observerOptions = {
            root: null,
            rootMargin: "0px",
            threshold: 0.1,
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting){
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        bankPayment.forEach(card => {
            observer.observe(card);
        });

    </script>
@endsection
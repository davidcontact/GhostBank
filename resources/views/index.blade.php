@extends('layouts.app')

@section('title', 'Home | Ghost Bank')
@push('home-style')
<style>

/* Bank Card Section */
.bank-card {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 95%;
  height: 100%;
  transform: translateY(50px);
  opacity: 0;
  transition: opacity 1s, transform 1s;
  /* background-color: #6c63ff; */
  padding: 2rem;
}
.bank-card.visible{
  opacity: 1;
  transform: translateY(0);
}

.card-image {
  flex: 0 0 50%;
  display: flex;
  justify-content: center;
  text-align: center;
 
}

.visa-card{
    background-color: rgb(28, 26, 26);
    display: flex;
    width: 95%;
    height: 270px;
    border-radius: 15px;
}
.card-content {
  /* flex: 0 0 50%; */
  display: flex;
  height: 100%;
  padding: 10px 0px;
  gap: 10px;
  flex-direction: column;
  color: #fff;
  padding-left: 2rem;
}

.card-content h1 {
  color: black;
  font-size: 2.5rem;
}
.card-content p {
  color: black;
  /* font-size: 2.5rem; */
}
.card-content .amount {
  color: black;
  /* font-size: 2.5rem; */
}

/* color: black; */

.amount{
    padding-bottom: 0px;
    font-size: 20px;
}
.read-more {
  background-color: rgba(255, 255, 255, 0);
  color: white;
  border: 1px solid rgb(0, 0, 0);
  font-size: 1rem;
  color: rgb(0, 0, 0);
  font-family: sans-serif;
  padding: 8px 30px;
  text-decoration: none;
  border-radius: 30px;
}
.read-more1{
    background-color: #775104 ;
    font-size: 1rem;
    color: white;
    font-family: sans-serif;
    padding: 8px 30px;
    text-decoration: none;
    border-radius: 30px;
}
.read-more1:hover{
    text-decoration: none;
    color: white;
}
.read-more:hover{
    text-decoration: none;
    color: #775104;
}
.login_btn{
  background-color: rgb(11, 103, 11) ;
  width: 147px;
  font-size: 1rem;
  color: white;
  font-family: sans-serif;
  text-decoration: none;
  display: flex;
  justify-content: center;
  padding: 5px 10px;
  border-radius: 30px;
  transition: all 0.3s ease;
}
/* .login_btn:hover{
  background-color: #775104;
  scale: 1.05;
} */
.bank-payment{
  background-color: rgb(9, 9, 77);
  display: flex;
  justify-content: center;
  padding: 0px 20px;
  width: 100%;
}

.paymentUi{
  display: flex;
  justify-content: space-between;
  /* align-items: center; */
  transform: translateX(50px);
  opacity: 0;
  transition: opacity 1s, transform 1s;
  width: 90% !important;
  /* background-color: #775104; */
}
.paymentUi.visible{
  opacity: 1;
  transform: translateX(0);
}
.box-1{
  /* background-color: aqua; */
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 10px;
}
.box-1 h4{
  font-family: sans-serif;
  font-weight: 200;
  margin-top: 23px;}

.box-1 .number{
  font-family: sans-serif;
  font-size: 22px;
  /* padding: px; */
  border-top: 2px solid #775104; 
  align-items: center;
  padding: 10px 20px;
  font-weight: 300;
}


</style>
@endpush
@section('content')
    <section class="bank-card">
        <div class="card-content">
            <h1>The Ghost Exchange Gift Card in your wallet.</h1>
            <p>Our Card is the best option if you are looking for high-quality and reliable banking services. We provide reliable services for you.</p>
            @if (auth()->check())

            <div class="amount">
                {{-- <h5>Total Balance: {{ $wallet->balance }}$</h5> --}}
                @if ($wallet)
                  <p>Wallet Balance: $<span id="counter">{{ $wallet->balance }}</span></p>
                @else
                    <p>No wallet found for this user.</p>
                @endif
            </div>
            @else
              <a class="login_btn" style="color: white" href="{{ route('login')}}">Login</a>
            @endif
            <div>
                <a class="read-more1" href="">Book a card</a>
                <a class="read-more" href="">Read More</a>
            </div>
        </div>
        <div class="card-image">
            <div class="visa-card">Bank Name</div>
        </div>
    </section>
    <div class="bank-payment">
      <div class="paymentUi">
        <div class="box-1">
          <h4>Countries</h4>
          <p class="number" id="countries">250</p>
        </div>
        <div class="box-1">
          <h4>Business</h4>
          <p class="number" id="business">190</p>
        </div>
        <div class="box-1">
          <h4>Payments</h4>
          <p class="number" id="payments">2000</p>
        </div>
        <div class="box-1">
          <h4>Projects</h4>
          <p class="number" id="projects">12</p>
        </div>        
      </div>
    </div>
    
@endsection

@section('script')

  <script>
    

    // alert("gay");
    // animation 
    const bankCard = document.querySelectorAll(".bank-card");
    const bankPayment = document.querySelectorAll(".paymentUi");


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

    bankCard.forEach(card => {
        observer.observe(card);
    });
    bankPayment.forEach(card => {
        observer.observe(card);
    }); 
    // console.log("gay black mf");

    // reload number
    function animateCounters(start, end, duration) {
      const counterElement = document.getElementById("counter");
      let current = start;
      const step = (end - start) / (duration / 20);

      const interval = setInterval(() => {
        current += step;
        if (current >= end) {
          current = end;
          clearInterval(interval);
        }
        counterElement.textContent = current.toFixed(2); 
      }, 20);
    }
     // If the wallet exists, pass the balance to JavaScript, otherwise set it to 0
     const walletBalance = @json($wallet ? $wallet->balance : 0);

    // Run the animation only if the walletBalance is a valid number
    if (!isNaN(walletBalance)) {
      const startBalance = 0;

      animateCounters(startBalance, walletBalance, 2000); // 2000 ms = 2 seconds
    }

    // payment static
    const staticData = {
      countries: 250,
      business: 190,
      payments: 2000,
      projects: 12
    };

    function animateCounter(start, end, duration, elementId) {
      const counterElement = document.getElementById(elementId);
      let current = start;
      const step = (end - start) / (duration / 20);

      const interval = setInterval(() => {
        current += step;
        if (current >= end) {
          current = end;
          clearInterval(interval);
        }
        counterElement.textContent = current.toFixed(0); 
      }, 20);
    }

    document.addEventListener('DOMContentLoaded', function() {
      Object.keys(staticData).forEach(key => {
        const startValue = 0;
        const endValue = staticData[key];
        const duration = 2000; 
        animateCounter(startValue, endValue, duration, key); 
      });
    });



</script>
@endsection
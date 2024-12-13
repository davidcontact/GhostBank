@extends('layouts.app')

@section('title', 'About Us | Ghost Bank')

@push('home-style')
<style>
    .main_about{
        display: flex;
        border: 2px solid #775104;
        padding: 10px;
        margin-bottom: 12px;
        margin-top: 12px;
        border-radius: 15px;
        flex-direction: column;
        transform: translateY(50px);
        opacity: 0;
        transition: opacity 1s, transform 1s;        
        width: 85%;
        /* background-color: aqua; */
    }
    .main_about.visible{
        opacity: 1;
        transform: translateY(0);
    }
    .main_about h4{
        color: #775104;
        /* margin-top: 8px; */
        font-family: sans-serif;
        font-weight: 600;
        font-size: 30px;
    }
    .main_about h5{
        color: #775104;
        /* margin-top: 8px; */
        font-family: sans-serif;
        /* font-weight: 600; */
        /* font-size: 30px; */
    }
    .main_about h4::first-letter{
        color: #ffcc99;
    }
    .about_us{
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        /* width: 90%; */
    }
    .about_us div img{
        /* width: 100%; */
        height: 315px;
        border: 2px solid #775104;
    }
    .about_us div h4{
        border: 2px solid #775104;
        border-radius: 15px;
        padding: 10px;
        font-family: sans-serif;
        font-weight: 200;
        font-size: 20px;
    }
</style>
@endpush

@section('content')
<div class="main_about">
    <h4>About Us</h4>
    <div class="about_us">
        <div>
            <img src="{{ asset('assets/bank.jpg') }}" alt="Bank Image">
        </div>
        <div>
            <h4>Welcome to Ghost Bank, Cambodia's premier private financial institution. Established in 1996 as the Advanced Bank of Asia Limited, we have become Cambodia's largest commercial bank by assets, deposits, loans, and profitability, according to the Annual Supervision Report 2021 - 2023 of the National Bank of Cambodia
                With 27 years in the banking industry, Ghost has significantly strengthened its position in the market to offer a comprehensive range of services to customer segments, including SMEs, micro-businesses, and individuals. Our wide-reaching footprint covers 99 branches, 1,700+ self-banking machines, and advanced online
                and mobile banking platforms, providing our customers with the convenience of modern financial services wherever they are.
            </h4>
        </div>
    </div>
    <h5>Ghost Bank is a subsidiary of National Bank of Canada (www.nbc.ca), a financial institution that boasts assets of around $321 billion as of April 30, 2024, and a massive network of correspondent banks worldwide. As a shareholder of Ghost Bank since 2014, National Bank of Canada became the first major financial institution from North America to enter the Cambodian banking market.</h5> 

</div>
@endsection

@section('script')
<script>
    const aboutUs = document.querySelectorAll(".main_about");

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

    aboutUs.forEach(about => {
        observer.observe(about);
    });

</script>
@endsection

@extends('front.wali.layout.app')

@section('content')
    <div id="appCapsule">
        <!-- Transactions -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Data Traksasi</h2>
                <a href="#" class="link">View All</a>
            </div>
            <div class="transactions">
                <!-- item -->
                <a href="app-transaction-detail.html" class="item">
                    <div class="detail">
                        <img src="{{ asset('front\assets\img\sample\photo\transaksi.png') }}" alt="img"
                            class="image-block imaged w48">
                        <div>
                            <strong>Aqid Fahri Hafin</strong>
                            <p>e-wallet</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="link">Detail</div>
                    </div>
                </a>
                <!-- * item -->
                <!-- item -->
                <a href="app-transaction-detail.html" class="item">
                    <div class="detail">
                        <img src="{{ asset('front\assets\img\sample\photo\transaksi.png') }}" alt="img"
                            class="image-block imaged w48">
                        <div>
                            <strong>Aqid Fahri Hafin</strong>
                            <p>e-wallet</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="link">Detail</div>
                    </div>
                </a>
                <!-- * item -->
                <!-- item -->
                <a href="app-transaction-detail.html" class="item">
                    <div class="detail">
                        <img src="{{ asset('front\assets\img\sample\photo\transaksi.png') }}" alt="img"
                            class="image-block imaged w48">
                        <div>
                            <strong>Aqid Fahri Hafin</strong>
                            <p>e-wallet</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="link">Detail</div>
                    </div>
                </a>
                <!-- * item -->
                <!-- item -->
                <a href="app-transaction-detail.html" class="item">
                    <div class="detail">
                        <img src="{{ asset('front\assets\img\sample\photo\transaksi.png') }}" alt="img"
                            class="image-block imaged w48">
                        <div>
                            <strong>Aqid Fahri Hafin</strong>
                            <p>e-wallet</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="link">Detail</div>
                    </div>
                </a>
                <!-- * item -->
            </div>
        </div>
        <!-- * Transactions -->
    </div>
@endsection

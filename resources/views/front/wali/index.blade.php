@extends('front.wali.layout.app')

@section('content')
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Total Saldo</span>
                        <h1 class="total">Rp 1.020.000</h1>
                    </div>
                    <div class="right">
                        <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#depositActionSheet">
                            <i class="fa-regular fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#withdrawActionSheet">
                            <div class="icon-wrapper bg-danger">
                                <i class="fa-solid fa-download"></i>
                            </div>
                            <strong>Tarik</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                            <div class="icon-wrapper">
                                <i class="fa-regular fa-paper-plane"></i>
                            </div>
                            <strong>Kirim</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="app-cards.html">
                            <div class="icon-wrapper bg-success">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <strong>Kartu</strong>
                        </a>
                    </div>
                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->
        <!-- Stats -->
        <div class="section wallet">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Total Tagihan</div>
                        <div class="value text-success">Rp.900.000</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Pengeluaran bln</div>
                        <div class="value text-danger">Rp.300.000</div>
                    </div>
                </div>
                <!-- * Stats -->

                <!-- Transactions -->
                <div class="section-heading mt-2">
                    <h2 class="title">Tagihan Santri</h2>
                    <a href="app-transactions.html" class="link">View All</a>
                </div>
                <div class="transactions">
                    <!-- item -->
                    <a href="app-transaction-detail.html" class="item">
                        <div class="detail">
                            <img src="{{ asset('front/assets/img/sample/brand/brand01.png') }}" alt="img"
                                class="image-block imaged w48">
                            <div>
                                <strong>SPP</strong>
                                <p>tahun ini</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-danger">Rp.500.000</div>
                        </div>
                    </a>
                    <!-- * item -->
                    <!-- item -->
                    <a href="app-transaction-detail.html" class="item">
                        <div class="detail">
                            <img src="{{ asset('front/assets/img/sample/brand/brand2.jpg') }}" alt="img"
                                class="image-block imaged w48">
                            <div>
                                <strong>Infaq Pesantren</strong>
                                <p>bulan ini</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-danger">Rp.10.000</div>
                        </div>
                    </a>
                    <!-- * item -->
                    <!-- item -->
                    <a href="app-transaction-detail.html" class="item">
                        <div class="detail">
                            <img src="{{ asset('front/assets/img/sample/brand/brand01.png') }}" alt="img"
                                class="image-block imaged w48">
                            <div>
                                <strong>SPP</strong>
                                <p>tahun lalu</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-danger">Rp.500.000</div>
                        </div>
                    </a>
                    <!-- * item -->
                    <!-- item -->
                    <a href="app-transaction-detail.html" class="item">
                        <div class="detail">
                            <img src="{{ asset('front/assets/img/sample/brand/brand2.jpg') }}" alt="img"
                                class="image-block imaged w48">
                            <div>
                                <strong>Infaq Pesantren</strong>
                                <p>bulan lalu</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-danger">Rp.10.000</div>
                        </div>
                    </a>
                    <!-- * item -->

                </div>
            </div>
            <!-- * Transactions -->>
        </div>
        <!-- * App Capsule -->
    @endsection

@extends('front.wali.layout.app')

@section('content')
    <br>
    <div id="appCapsule">
        <ul class="listview image-listview text inset">
            <div class="section mt-3 text-center">
                <br>
                <div class="avatar-section">
                    <a href="#">
                        <img src="{{ asset('front/assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar"
                            class="imaged w100 rounded">
                        <span class="button">
                            <ion-icon name="camera-outline"></ion-icon>
                        </span>
                    </a>
                </div>
                <br>
            </div>
            <li>
                <div class="item">
                    <div class="in">
                        <h3>Nama : </h3>
                        <p>Aqid Fahri Hafin</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="item">
                    <div class="in">
                        <h3>Alamat : </h3>
                        <p>Gadu Timur Ganding</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="item">
                    <div class="in">
                        <h3>Rayon : </h3>
                        <p>English Area of late</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="item">
                    <div class="in">
                        <h3>Status Santri : </h3>
                        <p class="btn btn-success btn-sm">Aktif</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@endsection

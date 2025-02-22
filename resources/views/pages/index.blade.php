@extends('templates.content')
@section('content')

        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Data Santri</p>
                                        <h4 class="mb-0">1</h4>
                                    </div>

                                    <div class="avatar-sm rounded-circle bg-info align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-info">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Data Santri</p>
                                        <h4 class="mb-0">1</h4>
                                    </div>

                                    <div class="avatar-sm rounded-circle bg-info align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-info">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Data Santri</p>
                                        <h4 class="mb-0">1</h4>
                                    </div>

                                    <div class="avatar-sm rounded-circle bg-info align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-info">
                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4 card-title float-sm-left">Email Sent</h4>
                        <div class="float-sm-right">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Year</a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>

                        <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

@endsection

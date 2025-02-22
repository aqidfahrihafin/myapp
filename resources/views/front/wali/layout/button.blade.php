        <!-- App Bottom Menu -->
        <div class="appBottomMenu">
            <a href="/dashboard-wali" class="item {{ request()-> is('/') ? 'item active' : '' }}">
                <div class="col">
                    <i class="fa-solid fa-house fa-2x"></i>
                    <strong>Home</strong>
                </div>
            </a>
            <a href="/data-santri" class="item {{ request()-> is('data-santri') ? 'active' : '' }}">
                <div class="col">
                    <i class="fa-solid fa-file fa-2x"></i>
                    <strong>Data santri</strong>
                </div>
            </a>
            <a href="#" class="item">
                <div class="col">
                    <i class="fas fa-wallet fa-2x"></i>
                    <strong>Top-Up</strong>
                </div>
            </a>
            <a href="/transaksi" class="item {{ request()-> is('transaksi') ? 'item active' : '' }}">
                <div class="col">
                    <i class="fa-solid fa-money-bill-wheat fa-2x"></i>
                    <strong>Transaksi</strong>
                </div>
            </a>
            <a href="#" class="item">
                <div class="col">
                    <i class="fa-solid fa-user fa-2x"></i>
                    <strong>Profile</strong>
                </div>
            </a>
        </div>
        <!-- * App Bottom Menu -->

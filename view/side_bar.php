<!-- side bar -->
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Globale</div>
            <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Situazione
            </a>
            <div class="sb-sidenav-menu-heading">Nazionale</div>
            <a class="nav-link" href="index.php?page=nation">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Giornaliero
            </a>
            <a class="nav-link" href="index.php?page=nationtrend">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Andamento
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Aggiornamento dati:</div>
        <?php
        require_once("controller/global_data.php");
        $globalData = GlobalDataController::getGlobalData();
        echo date('d-m-Y H:i', $globalData->date);
        ?>
    </div>
</nav>
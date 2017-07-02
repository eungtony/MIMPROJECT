<div class="row top-summary">
    <div class="col-md-3 col-sm-2">
        
        <div class="widget green-1 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="icon-list"></i>
                </div>
                <div class="text-box">
                    <p class="maindata">TOTAL <b>Projets</b></p>
                    <h2><span class="animate-number" data-value="{{ $nb_projet }}" data-duration="2000">0</span></h2>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="widget-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <i>{{ $nb_projet }} projet(s) sont en cours</i> 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <div class="col-md-3 col-sm-2 box0">

        <div class="widget darkblue-2 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="icon-list"></i>
                </div>
                <div class="text-box">
                    <p class="maindata">TOTAL <b>Trésorerie</b></p>
                    <h2><span class="animate-number" data-value="{{ $total_tres }}" data-duration="2000">0</span>€</h2>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="widget-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <i>{{ $total_tres }} € dans la trésorerie</i> 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <div class="col-md-3 col-sm-2 box0">

        <div class="widget orange-4 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="icon-list"></i>
                </div>
                <div class="text-box">
                    <p class="maindata">TOTAL <b>Encaissé</b></p>
                    <h2><span class="animate-number" data-value="{{ $encaisse }}" data-duration="2000">0</span>€</h2>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="widget-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <i>{{ $encaisse }} € ont été encaissé</i> 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>

    <div class="col-md-3 col-sm-2 box0">
        <div class="widget green-1 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="icon-list"></i>
                </div>
                <div class="text-box">
                    <p class="maindata">TOTAL <b>Projets facturés</b></p>
                    <h2><span class="animate-number" data-value="{{ $facturable }}" data-duration="2000">0</span>€</h2>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="widget-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <i>{{ $facturable }}€ de projets facturés</i>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div><!-- /row mt -->
@include('tresorerie.add')
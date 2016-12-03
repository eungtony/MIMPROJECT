<div class="row mtbox">
    <div class="col-md-3 col-sm-2 box0">
        <div class="box1">
            <span class="li_cloud"></span>
            <h3>{{$agence->file->count()}} fichiers</h3>
        </div>
        <p>{{$agence->file->count()}} fichiers dans votre agence</p>
    </div>
    <div class="col-md-3 col-sm-2 box0">
        <div class="box1">
            <span class="li_news"></span>
            <h3>{{$messages->count()}} messages</h3>
        </div>
        <p>Vous avez {{$messages->count()}} messages dans votre agence</p>
    </div>
    <div class="col-md-3 col-sm-2 box0">
        <div class="box1">
            <span class="li_banknote"></span>
            <h3>{{$bankable}} €</h3>
        </div>
        <p>Vous avez récolté {{$bankable}} €</p>
    </div>
    <div class="col-md-3 col-sm-2 box0">
        <div class="box1">
            <span class="li_data"></span>
            <h3>{{$projets->count()}} projets</h3>
        </div>
        <p>Vous avez {{$projets->count()}} projets en cours</p>
    </div>

</div><!-- /row mt -->
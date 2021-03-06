 @extends('layouts.layout')
 @section('content')
<div class="shop-page-area bg-white ">
    <div class="banner-area text-center bg-dark">
        <div class="imgbanner imgbanner-2">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 font-weight-normal">Punny headline</h1>
                <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
                <a class="btn btn-outline-secondary" href="#">Coming soon</a>
            </div>
        </div>
    </div>
    <div class="container">

        <div class=" mt-30 nav-scroller py-1 mb-2 bg-grey">
            <nav class="nav d-flex justify-content-between">
            <a  class="p-2 text-muted" href="{{ route('products.index') }}"><span style="color: #0a424e;"><b>All</b></span></a>
                @foreach(App\Categorie::all() as $Categorie)
                    <a  class="p-2 text-muted" href="{{ route('products.index', ['categorie' => $Categorie->NomCategorie]) }}"><span style="color: #0a424e;"><b>{{$Categorie->NomCategorie}}</b></span></a>
                @endforeach
            </nav>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger">
            {{ session('danger') }}
            </div>
        @endif


        <div class="shop-page-products mt-30">
            <div class="row no-gutters">

                @foreach ($products as $item)
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <!-- Single Product -->
                    <article class="hoproduct">
                        <div class="hoproduct-image">
                            <a class="hoproduct-thumb" href="{{ route('products.show', $item->Nom ) }}">
                                    <img class="hoproduct-frontimage" src="{{ $item->imgPath }}" alt="product image">
                                </a>
                            <ul class="hoproduct-flags">
                                <li class="flag-pack">New </li>
                                <li class="flag-discount">-{{ $item->Remise }}%</li>
                                <li class="flag-pack" style="width: 200px; margin-top: 150px; color: black; background: #ffe201; ">Categorie: {{ $item->categories->NomCategorie }}</li>

                            </ul>
                        </div>
                        <div class="hoproduct-content">
                            <h5 class="hoproduct-title"><a href="{{ route('products.show', $item->Nom ) }}">{{ $item->Nom }}</a></h5>
                            <div class="hoproduct-rattingbox">
                                <div class="rattingbox">
                                    <span class="active"><i class="fa fa-star"></i></span>
                                    <span class="active"><i class="fa fa-star"></i></span>
                                    <span class="active"><i class="fa fa-star"></i></span>
                                    <span class="active"><i class="fa fa-star"></i></span>
                                    <span class="active"><i class="fa fa-star"></i></span>
                                </div>
                            </div>
                            <div class="hoproduct-pricebox">
                                <div class="pricebox">
                                    <del class="oldprice">${{ $item->Prix }}</del>
                                    <span class="price">${{ $item->Prix - ($item->Prix * $item->Remise/100) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('products.show', $item->Nom ) }}" class="stretched-link btn btn-info" style="text-align: center; color:aliceblue">Voir l'article</a>
                            <!--<p style=" text-align: justify; font-family: cursive; font: -webkit-xxx-large; ">Canon's first 4K UHD Camcorder, the GX10 has a compact and portable design that delivers outstanding video quality with remarkable detail. With a combination of incredible features and functionality, the GX10.</p>
                                -->
                        </div>
                    </article>
                    <!--// Single Product -->
                </div>
                @endforeach
            </div>
        </div>

        <div class="cr-pagination pt-30">
            {{$products->appends(request()->input())->links()}}
            <!--
            <p>Showing 1-12 of 13 item(s)</p>
            <ul>
                <li><a href="http://preview.hasthemes.com/haltico-v3/haltico/shop-rightsidebar.html"><i class="ion ion-ios-arrow-back"></i> Previous</a></li>
                <li class="active"><a href="http://preview.hasthemes.com/haltico-v3/haltico/shop-rightsidebar.html">1</a></li>
                <li><a href="http://preview.hasthemes.com/haltico-v3/haltico/shop-rightsidebar.html">2</a></li>
                <li><a href="http://preview.hasthemes.com/haltico-v3/haltico/shop-rightsidebar.html">Next <i class="ion ion-ios-arrow-forward"></i></a></li>
            </ul>
            -->
        </div>

    </div>
</div>
@endsection

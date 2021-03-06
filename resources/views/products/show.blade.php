@extends('layouts.layout')
@section('content')

<main class="page-content">

    <!-- Product Details Area -->
    <div class="product-details-area bg-white ptb-30">
        <div class="container">

            <div class="pdetails">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="pdetails-images">
                            <div class="">
                                <div class="pdetails-singleimage" style="text-align: center;width: 100%;display: inline-block;">
                                    <img src="{{ $product->imgPath }}" alt="product image" style=" width: 450px; height: 350px; ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pdetails-content">

                            <div class="rattingbox">
                                <span class="active"><i class="ion ion-ios-star"></i></span>
                                <span class="active"><i class="ion ion-ios-star"></i></span>
                                <span class="active"><i class="ion ion-ios-star"></i></span>
                                <span class="active"><i class="ion ion-ios-star"></i></span>
                                <span class="active"><i class="ion ion-ios-star"></i></span>
                            </div>
                            <h3>{{ $product->Nom }}</h3>
                            <div class="pdetails-pricebox">
                                <del class="oldprice">${{ $product->Prix }}</del>
                                <span class="price">${{ $product->Prix - ($product->Prix * $product->Remise/100) }}</span>
                                <span class="badge">Save {{ $product->Remise }}%</span>
                            </div>
                            <br><br><br>
                            <div class="pdetails-quantity" style="display: flex;">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @guest
                                    <button style="display: flex;" type="submit" disabled="true" class="btn btn-warning">
                                        <span>Must Login</span>
                                    </button>
                                    @else
                                    <button style="display: flex;" type="submit" class="ho-button">
                                        <i class="fa fa-cart-plus"></i>
                                        <span>Add to cart</span>
                                    </button>
                                    @endguest

                                </form>
                            </div>
                            <div class="pdetails-categories">
                                <span>Categories :</span>
                                <ul>
                                    <li><a href="shop-rightsidebar.html">{{ $product->categories->NomCategorie }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pdetails-allinfo">

                <ul class="nav pdetails-allinfotab justify-content-center" id="product-details" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link" id="product-details-area3-tab" data-toggle="tab" href="#product-details-area3" role="tab" aria-controls="product-details-area3" aria-selected="false">Reviews (1)</a>
                    </li>
                </ul>

                <div class="tab-content" id="product-details-ontent">

                    <div class="tab-pane fade active" id="product-details-area3" role="tabpanel" aria-labelledby="product-details-area3-tab">
                        <div class="pdetails-reviews">
                            <div class="product-review">



                                <div class="commentlist">
                                    <h5>ALL COMMENTS BY CLIENTS FOR THIS PRODUCT</h5>
                                    @foreach( $product->commentaires as $item)
                                    <div class="single-comment">
                                        <div class="single-comment-thumb">
                                            <img src="{{$item->clients->imgPath}}" alt="hastech logo">
                                        </div>
                                        <div class="single-comment-content" style="width: -webkit-fill-available;">
                                            <div class="single-comment-content-top">
                                                <h6>{{$item->clients->name}} : publie le: {{$item->date_pub}}</h6>
                                                <div class="rattingbox">
                                                    <span class="active"><i class="fa fa-star"></i></span>
                                                    <span class="active"><i class="fa fa-star"></i></span>
                                                    <span class="active"><i class="fa fa-star"></i></span>
                                                    <span class="active"><i class="fa fa-star"></i></span>
                                                    <span class="active"><i class="fa fa-star"></i></span>
                                                </div>
                                            </div>
                                            <p>{{$item->texte}}.</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>



                                <div class="commentbox mt-5">
                                    <h5>REVIEW/COMMENTS</h5>
                                    <form action="{{ route('commentaire.store') }}" method="POST" class="ho-form">
                                        @csrf
                                        <div class="ho-form-inner">
                                            <div class="single-input">
                                                <textarea id="texte" name="texte" cols="30" rows="5" required="true"></textarea>
                                            </div>
                                            <div class="single-input">
                                                <input type="hidden" name="codeProduit" value="{{ $product->id }}">
                                            </div>

                                            <input type="hidden" name="productname" value="{{ $product->Nom }}">
                                            <div class="single-input">
                                            @guest

                                            @else
                                             <input type="hidden" name="numClient" value="{{ Auth::user()->id }}">
                                            @endguest
                                            </div>
                                            <div class="single-input">
                                            <button style="display: flex;" type="submit" class="ho-button">
                                                <i class="fa fa-comment"></i>
                                                <span> Envoyer</span>
                                            </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!--// Product Details Area -->

    <!--// Newsletter Area -->

</main>
@endsection

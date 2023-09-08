<!DOCTYPE html>
<html>

<head>
    
    @include('home.css_link');
    {{-- jquery --}}
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <!-- product section -->
        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Our <span>products</span>
                        <div>
                            <form action="{{ url('search_product') }}" method="GET">
                                <input type="search" placeholder="search product" class="p-3" name="search"
                                    style="width: 500px">
                                <input type="submit" value="Search" value="Search">
                            </form>
                        </div>
                    </h2>
                </div>
               @include('sweetalert::alert');
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="box">
                                <div class="option_container">
                                    <div class="options">
                                        <a href="{{ url('product_details', $product->id) }}" class="option1">
                                            Product Details
                                        </a>
                                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" value="1" min="1">
                                            <input type="submit" class="mb-4" value="Add To Cart">
                                        </form>

                                    </div>
                                </div>
                                <div class="img-box">
                                    <img src="images/product/{{ $product->image }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $product->title }}
                                    </h5>
                                    @if ($product->discount_price != null)
                                        <h6 class="text-danger">
                                            ${{ $product->discount_price }}
                                        </h6>
                                        <h6 style="text-decoration:line-through">
                                            ${{ $product->price }}
                                        </h6>
                                    @else
                                        <h6>
                                            ${{ $product->price }}
                                        </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <span class="pt-5">
                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                    </span>

                </div>
        </section>

        <!-- end product section -->
        <!-- comments section section start -->
        <div class="text-center pb-3">
            <h1 style="font-size:30px;text-align:center;padding-top=20px;padding-bottom:20px">Comments</h1>

            <form action="{{ url('add_comment') }}" method="POST">
                @csrf
                <textarea style="height: 150px;width:600px" name="comment" id="" placeholder="Type any comments"></textarea>
                <br>
                <input type="submit" value="Comment" class="btn btn-primary">
            </form>

        </div>
        <div style="padding-left:20%">
            <h1 style="font-size: 20px;padding-bottom:20px">All Comments</h1>
            @foreach ($comments as $comment)
                <div>
                    <b>{{ $comment->name }}</b>
                    <p>{{ $comment->comment }}</p>
                    <a class="text-primary" href="javascript::void(0)" onclick="reply(this)"
                        data_CommentId={{ $comment->id }}>Reply</a>

                    @foreach ($replies as $reply)
                        @if ($reply->comment_id == $comment->id)
                            <div style="padding-left:3%;padding-bottom:10px;padding-bottom:10px">
                                <b>{{ $reply->name }}</b>
                                <p>{{ $reply->reply }}</p>
                                <a class="text-primary" href="javascript::void(0)" onclick="reply(this)"
                                    data_CommentId={{ $comment->id }}>Reply</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            {{-- reply text box --}}
            <div style="display: none" class="replyDiv">
                <form action="{{ url('add_reply') }}" method="POST">
                    @csrf
                    <input type="text" id="commentId" name="commentId" hidden>
                    <textarea style="height:100px;width:500px" name="reply" id="" placeholder="write something here..."></textarea>
                    <br>
                    <button type="submit" class="btn btn-warning">Reply</button>
                    <a href="" class="btn btn-danger" onclick="replyClose(this)">Close</a>
                </form>
            </div>
        </div>

        <script>
            function reply(caller) {
                document.getElementById('commentId').value = $(caller).attr('data_CommentId');
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }

            function replyClose(caller) {
                $('.replyDiv').hide();
            }
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos) window.scrollTo(0, scrollpos);
            });

            window.onbeforeunload = function(e) {
                localStorage.setItem('scrollpos', window.scrollY);
            };
        </script>
        <!-- comments section section end-->
        <!-- footer section section start-->
        @include('home.footer')
        <!-- footer section section end-->

    </div>


    </script>
    <!-- jQery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('home/js/custom.js') }}"></script>
</body>

</html>

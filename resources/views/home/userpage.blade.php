<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
      <!-- header section strats -->
      @include('home.header')
      <!-- end header section -->
      <!-- slider section -->
      @include('home.slider')
      <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why_section')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product')
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
            <a class="text-primary" href="javascript::void(0)" onclick="reply(this)" data_CommentId={{ $comment->id }}>Reply</a>
            
            @foreach ($replies as $reply)
               @if($reply->comment_id == $comment->id)
                <div style="padding-left:3%;padding-bottom:10px;padding-bottom:10px">
                   <b>{{ $reply->name }}</b>
                   <p>{{ $reply->reply }}</p>
                   <a class="text-primary" href="javascript::void(0)" onclick="reply(this)" data_CommentId={{ $comment->id }}>Reply</a>
               </div>
               @endif
            @endforeach
        </div>
         @endforeach
         {{-- reply text box --}}
         <div style="display: none" class="replyDiv">
            <form action="{{ url('add_reply') }}" method="POST">
            @csrf
            <input type="text" id="commentId" name="commentId" hidden >
            <textarea style="height:100px;width:500px" name="reply" id="" placeholder="write something here..."></textarea>
            <br>
            <button type="submit" class="btn btn-warning">Reply</button>
            <a href="" class="btn btn-danger" onclick="replyClose(this)">Close</a>
            </form>
         </div>
      </div>

      <script>
         function reply(caller){
            document.getElementById('commentId').value=$(caller).attr('data_CommentId');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }
         function replyClose(caller){
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
      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      </div>

      
       </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
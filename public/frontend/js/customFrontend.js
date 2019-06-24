$(document).ready(function(){
      //code for owl carousel
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true
      });

      //search form frontend
      $("#searchField").keyup(function(){
        if($(this).val()){
          var search = $(this).val();
          var token = $(this).attr('data');
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                    url:"/search/"+search,///post/store
                    type: "post",
                    data: {'search':search,
                    "_token":token
                          },
                    success: function(response) {
                      var title = [];
                      var  id =[];
                       for ($i = 0; $i < response.data.length;$i++) {
                          id = response.data[$i]['id'];
                          title.push('<a href="/single/post/'+id+'">'+response.data[$i]['title']+"</a><br>");
                                     
                          $(".outputSearch").html(title);
                         
                         
                         

                         
                       } 
                       
                       
                       //console.log(response.data);
                      },
                    error: function(response) {
                        $(".outputSearch").html("<div class='card'><div class='card-body'>"+data+"</div></div>");
                    }
                });
        }
      });


      //comment process from single post page

      $(".commentForm").submit(function(e){
          e.preventDefault();
         var message =  $(".commentContent").val();
         var post = $(".commentData").attr("post-id");
         var commentSender = $(".commentData").attr("comment-sender");
         var token = $(".commentData").attr("data");
         var author = $(".commentData").attr("author");
         if(message != ''){

                    $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                        url:"/comment",///post/store
                        type: "post",
                        data: {
                          'message':message,
                          'post_id':post,
                          'user_id':commentSender,
                          'author':author,
                          "_token":token
                              },
                        success: function(response) {
                          $(".alertAfterComment").show(500);
                          //$(".alertAfterComment").text(response);
                          $(".commentOutput").prepend(response);
                          },
                        error: function(response) {
                          $(".alertAfterCommentError").show(500)
                          $(".alertAfterCommentError").text(response);
                        }
                    });
         }
      });
      //adding reply to database
      $(".replyButton").click(function(e){
        e.preventDefault();
        
        var token = $(this).parent().siblings(".form-group").find(".replyInputField").attr('data');
          var replySender = $(this).parent().siblings(".form-group").find(".replyInputField").attr('reply-sender');
          var postId = $(this).parent().siblings(".form-group").find(".replyInputField").attr('post-id');
          var commentId = $(this).parent().siblings(".form-group").find(".replyInputField").attr('comment-id');
           var replyReceived = $(this).parent().siblings(".form-group").find(".replyInputField").val();
          if(replyReceived != ''){

                    $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                        url:"/reply",///post/store
                        type: "post",
                        data: {
                          'reply':replyReceived,
                          'post_id':postId,
                          'replied_by':replySender,
                          'under_comment':commentId,
                          "_token":token
                              },
                        success: function(response) {
                         $(".alertAfterReply").show(500);
                          $(".alertAfterReply").text(response);
                          },
                        error: function(response) {
                          $(".alertAfterReplyError").show(500)
                          $(".alertAfterReplyError").text(response);
                        }
                    });
          }else{
            $(this).siblings(".replyAlert").show(500);
            $(this).siblings(".replyAlert").text("Add Reply Before Clicking On Send");
           setTimeout(() => {
            $(this).siblings(".replyAlert").hide(1500);
           }, 8000);
            
          }
         
      });


        $(".showReplies").click(function(){
          //$(this).closest(".replyOutputBox").show(500);
        $(this).parent().parent().find(".replyBoxWrapper").toggle(500);
         
        });

        //scroll window will make sidebar sticky
        // $(window).scroll(function() {
        //   var $height = $(window).scrollTop();
        //   if($height >= 150) {
        //    $(".sidebar").addClass("sidebarSticky");
        //    $(".sidebar").removeClass("col-md-3").addClass("col-md-2");
        //    $(".mainBar").addClass("col-md-offset-3");
        //    console.log($height);
        //   }
        //   if($height >= 2550){
        //     $(".sidebar").removeClass("sidebarSticky").addClass("antiSticky");
        //   }

        //   if($height < 150) {
        //     $(".sidebar").removeClass("sidebarSticky");
        //     $(".sidebar").removeClass("col-md-2").addClass("col-md-3");
        //     $(".mainBar").removeClass("col-md-offset-3");
        //   }
        // })
     
        


});

$(document.body).on('click', '.makeReply', function() {
  
  $(this).text("close");
  $(this).parent().siblings('.replyInput').toggle(1000);
  $(this).removeClass('makeReply');
  $(this).addClass('closeReply');
  
}).on('click', '.closeReply', function() {
  $(this).text("Reply");
  $(this).parent().siblings('.replyInput').toggle(1000);
});


var vid = document.getElementById("bgvid");
var pauseButton = document.querySelector("#polina button");

if (window.matchMedia('(prefers-reduced-motion)').matches) {
    vid.removeAttribute("autoplay");
    vid.pause();
    pauseButton.innerHTML = "Paused";
}

function vidFade() {
  vid.classList.add("stopfade");
}

vid.addEventListener('ended', function()
{
// only functional if "loop" is removed 
vid.pause();
// to capture IE10
vidFade();
}); 


pauseButton.addEventListener("click", function() {
  vid.classList.toggle("stopfade");
  if (vid.paused) {
    vid.play();
    pauseButton.innerHTML = "Pause";
  } else {
    vid.pause();
    pauseButton.innerHTML = "Paused";
  }
})

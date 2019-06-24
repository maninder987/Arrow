$(document).ready(function(){
    //Initialize Select2 Elements
     $('.select2').select2();

     $(".sure_message").hide();

     //inserting category in database
     $('#cat_sender').click(function(e){
          e.preventDefault();
          var $form = $(this);

          url = $form.attr('action');


          var category = $("#cat_field").val();
          var token = $("#token").val();
          var author = $("#authorid").attr('data');
          
          if(category == '' || author == ''){
            $(".output").html("<span class='alert alert-danger'>Field Is Empty</span>");
          }else{
             $.ajax({
                type: "post",
                data: {'category':category,
                       '_token': token,
                       'author':author
                      },
                success: function(data) {
                    $(".output").html("<span class='alert alert-success'>"+data+"</span>")
                },
                error: function(data) {
                    $(".output").html("<span class='alert alert-danger'>"+data+"</span>");
                }
            });
          }
      });

      //updating category
      $("#upcatsub").click(function(e){
             e.preventDefault();

            if(upcategory == '' ){
              $(".output").html("<span class='alert alert-danger'>Field Is Empty</span>");
            }else{

                          var upcategory = $("#upcat").val();
                          var uptoken = $("#uptoken").val();
                          var id = $("#previous_name").val();
                          var url = '/upcategory/'+id;

                           $.ajax({
                                type: "PUT",
                                //url: "{{ url('/post/upcategory') }}",
                                data: {'category':upcategory,
                                       '_token': uptoken
                                      },
                                url:url,
                                success: function(data) {
                                     $(".output").html("<span class='alert alert-success'>"+data+"</span>")
                                    //console.log(data+'Pass');

                                },
                                error: function(data) {
                                    $(".output").html("<span class='alert alert-danger'>"+data+"</span>");
                                     //console.log(data+'Failed');
                                     //alert(data);
                                }
                            });
           }
    });

    //delete category using ajax
    $(".delete_category").click(function(e){
      e.preventDefault();
      $(".sure_message").show();
      $(".delete_category").removeClass('deleteNow');
      $(this).addClass('deleteNow');
    });


    $("#delete_sure").click(function(){
      var categoryName = $(".deleteNow").attr("data-name");
      var url = '/deletecategory/'+categoryName;
      $.ajax({
           type: "get",
           data: {'category':categoryName
                 },
           url:url,
           success: function(data) {
                $(".output").html("<span class='alert alert-success'>"+data+"</span>")
                $(".deleteNow").parent().parent().hide();
                $(".sure_message").hide();
               },
           error: function(data) {
               $(".output").html("<span class='alert alert-danger'>"+data+"</span>");
           }
       });
    });

    $("#close_delete").click(function(){
      $(".sure_message").hide(10);
    });

    //adding posts using ajax

    $("#ap_submit").click(function(e){
      e.preventDefault();
      var title = $("#ptitle").val();
      var imgName = $("#pimage").val();
      var category = $("#pcategory").val();
      var tabs = $("#ptab").val();
      var content = CKEDITOR.instances["editor1"].getData();
      var authorId = $("#authorid").val();
      var newTabs = tabs.toString();

      var totalFormData = new FormData($("#multiselectForm")[0]);
      totalFormData.append('content',content);
      totalFormData.append('tags',newTabs);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/post/store",///post/store
        type:"POST",
        data:totalFormData,
        processData: false,
        contentType: false,
        cache: false,
        success:function(data){
          $(".output_results").html(data);
        },
        error: function(data) {
          $(".output_results").html(data);
        }
      });





      //console.log(imgName+token);dataType:"JSON",
    });

     $(".edit").click(function(){
        var id =  $(this).parent().siblings().find(".id_displayed").attr('data');
        var pic =  $(this).parent().siblings().find(".id_picture").attr('src');
        var category =  $(this).parent().siblings().find(".id_category").attr('data');
        var tags =  $(this).parent().siblings().find(".id_tags").attr('data');
        var title =  $(this).parent().siblings().find(".id_title").attr('data');
        var content =  $(this).parent().siblings().find(".id_content").attr('data');
        var author =  $(this).parent().siblings().find(".id_author").attr('data');
        $("#model_title").val(title);
        $("#model_content").val(content);
        $("#model_category").val(category);
        $("#model_tags").val(tags);
        $("#model_image_output").attr("src",pic);

      });

      //inserting category in database
     $('#tag_sender').click(function(e){
          e.preventDefault();
          var $form = $(this);

          url = $form.attr('action');


          var tag = $("#tag_field").val();
          var token = $("#token").val();
          var author = $("#authorid").attr('data');
          
          if(tag == '' || author == ''){
            $(".output").html("<span class='alert alert-danger'>Field Is Empty</span>");
          }else{
             $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
                url:"/tag/store",///post/store
                type: "post",
                data: {'tags':tag,
                       '_token': token,
                       'author':author
                      },
                success: function(data) {
                    $(".output").html("<span class='alert alert-success'>"+data+"</span>")
                },
                error: function(data) {
                    $(".output").html("<span class='alert alert-danger'>"+data+"</span>");
                }
            });
          }
      });

      //replying to comment backend--setting values to modal
      
      $(".replyAdmin").click(function(){
        $('.boxWrapperReply').show();
        var under_comment = $(this).attr('under_comment');
        var post_id = $(this).attr('post_id');
        var replied_by = $(this).attr('replied_by');
        var token = $(this).attr('token');
        
        $(".replyAuthorAdmin").attr('under_comment',under_comment);
        $(".replyAuthorAdmin").attr('post_id',post_id);
        $(".replyAuthorAdmin").attr('replied_by',replied_by);
        $(".replyAuthorAdmin").attr('token',token);
      });

      $(".sendReplyAdmin").click(function(){

        var reply = CKEDITOR.instances.editor.getData();
        var commentId = $(".replyAuthorAdmin").attr('under_comment');
        var post_id = $(".replyAuthorAdmin").attr('post_id');
        var replied_by = $(".replyAuthorAdmin").attr('replied_by');
        var token = $(".replyAuthorAdmin").attr('token');

          if(reply != ''){
            reply=reply.replace(/<\/?[^>]+>/gi, ''); //removing html tags
                    $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                        url:"/reply",
                        type: "post",
                        data: {'under_comment':commentId,
                              'post_id':post_id,
                              'replied_by':replied_by,
                              '_token': token,
                              'reply':reply
                              },
                        success: function(data) {
                          alert(data);
                        },
                        error: function(data) {
                            alert(data);
                          }
                     });
          }else{
            alert("Add Reply You Want To Send");
          }
      });



      
      $('.closeReplyModelAdmin').click(function() {
        $('.boxWrapperReply').hide();
        CKEDITOR.instances.editor.setData('');
      });

      $(".approveComment").click(function(){
        var  commentId = $(this).attr('under_comment');
        var  token = $(this).attr('token');
        //$(".newComment")
        $(this).parent().parent().parent().find(".newComment").remove();
     
        
        $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                    url:"/approve/"+commentId,
                    type: "post",
                    data: {'commentId':commentId,
                          '_token': token
                          },
                    success: function(data) {
                      alert(data);
                      location.reload();
                    },
                    error: function(data) {
                        alert(data);
                        location.reload();
                      }
                });
        });

        $(".deleteCommentAdmin").click(function(){
          var commentId = $(this).attr("under_comment");
          var token = $(this).attr("token");
          $(this).parent().parent().parent().hide(500);
        
          $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                    url:"/delete/"+commentId,
                    type: "post",
                    data: {'commentId':commentId,
                          '_token': token
                          },
                    success: function(data) {
                      $(".successDeleteComment").show(500);
                      $(".successDeleteComment").text("Comment Deleted Successfully");
                      setTimeout(() => {
                        $(".successDeleteComment").hide(500);
                      },5000);
                    },
                    error: function(data) {
                      $(".errorDeleteComment").show(500);
                      $(".errorDeleteComment").text("Error Cannot Delete Comment");
                      }
                });


        });






});



		
    

     











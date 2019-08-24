$(".v").click(function() {
  if($(".a").css("display")!="none"){
    $(".v").text("View all Slots");
    $(".a").css("display","none");
  }
  else{
    $(".v").text("Hide all slots");
      $(".a").css("display","");
  }

  // $(".v").click(function() {
  //   $(".v").text("View all Slots");
  //     $(".a").css("display","none");
  //
  // });

});

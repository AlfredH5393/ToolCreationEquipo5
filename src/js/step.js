var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
let page2 = document.querySelector(".page2");
let page1 = document.querySelector(".page1");
let contentForm = document.querySelector(".content-form-login");
let btnNext = document.querySelector(".btn-next");


  $(".btn-next").click(function(){
      
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
      //activate next step on progressbar using the index of next_fs
      $(".progress-bar li").eq($("fieldset").index(next_fs)).addClass("active");
      page1.classList.remove('active')
      page2.classList.remove('hide');
      page2.classList.add('active');
      contentForm.style.width = "155%";
      page1.classList.add("hide")
     
  });

  $(".btn-prev").click(function(){

      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();
      
      //de-activate current step on progressbar
      $(".progress-bar li").eq($("fieldset").index(current_fs)).removeClass("active");
      page2.classList.remove('active')
      page2.classList.add('hide')
      page1.classList.remove('hide');
      page1.classList.add('active');
     
  });

  window.addEventListener('load', () =>{
      page2.classList.add('hide');
  })
  
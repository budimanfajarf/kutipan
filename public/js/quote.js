$(document).ready(function(){

  // This for Quote Like
  $(document).on('click touchstart', '.btn-like', function(){

    let _this = $(this);
    _this.off('hover');

    let _url = '/like/' + _this.attr('data-type') +
               '/' + _this.attr('data-likeable-id');
    
    $.get(_url, function(data){
      if(data == '0') {
        _this.popover('show');
        setTimeout(function() {_this.popover('hide')},5000);
      } else if (data == '1') {
      
      } else {
        _this.addClass('btn-unlike btn-danger').removeClass('btn-like btn-primary').html('Unlike');
        let total_like = _this.parents('.wrapper-like').find('.total-like');
        total_like.html(parseInt(total_like.html())+1);  
      }
    });

  });

  // This for Quote Unlike
  $(document).on('click touchstart', '.btn-unlike', function(){

    let _this = $(this);
    _this.off('hover');

    let _url = '/unlike/' + _this.attr('data-type') +
               '/' + _this.attr('data-likeable-id');
    
    $.get(_url, function(data){
      _this.addClass('btn-like btn-primary').removeClass('btn-unlike btn-danger').html('Like');
      let total_like = _this.parents('.wrapper-like').find('.total-like');
      total_like.html(parseInt(total_like.html())-1);  
    });

  });


  // This for QuoteComment Like
  $(document).on('click touchstart', '.btn-comment-like', function(){

    let _this = $(this);
    _this.off('hover');

    let _url = '/like/' + _this.attr('data-type') +
               '/' + _this.attr('data-likeable-id');
    
    $.get(_url, function(data){
      if(data == '0') {
        _this.popover('show');
        setTimeout(function() {_this.popover('hide')},5000);
      } else if (data == '1') {
      
      } else {
        _this.addClass('btn-comment-unlike btn-outline-danger').removeClass('btn-comment-like btn-outline-primary').html('Unlike');
        let total_like = _this.parents('.wrapper-like').find('.total-like');
        total_like.html(parseInt(total_like.html())+1);  
      }
    });

  }); 

  // This for QuoteComment Unlike
  $(document).on('click touchstart', '.btn-comment-unlike', function(){

    let _this = $(this);
    _this.off('hover');

    let _url = '/unlike/' + _this.attr('data-type') +
               '/' + _this.attr('data-likeable-id');
    
    $.get(_url, function(data){
      _this.addClass('btn-comment-like btn-outline-primary').removeClass('btn-comment-unlike btn-outline-danger').html('Like');
      let total_like = _this.parents('.wrapper-like').find('.total-like');
      total_like.html(parseInt(total_like.html())-1);  
    });

  }); 
    

});

// $(function () {
//   $('.example-popover').popover({
//     container: 'body'
//   })
// })
// //         _this.popover({content: data}).popover('show').delay(500);
// // $(function () {
// //   $('[data-toggle="popover"]').popover()
// // })
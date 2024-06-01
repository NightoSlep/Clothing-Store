function capnhat(id) {
    var soluong = document.getElementById.value();
    $.ajax({
      url: "cart.php",
      type: "GET",
      cache: false,
      data: { 
        id: id, 
        soluong: soluong 
      }, 
      success: function () {
  
      }
    })
}
// mày lấy file đâu myjs ok

function phanloai(loaisp, page) {
  $.ajax({
    url: "cate-products-ajax.php",
    type: "GET",
    cache: false,
    data: {
      page: page,
      loaisp: loaisp
    },
    beforeSend: function() {
      $("#main").hide();
    },

    success: function(response) {
      $("#data").html(response).show();
    }
    
  });
  $(document).on("click", ".page-link", function(e) {
    e.preventDefault();
    var pageId = $(this).attr("id");
    phanloai(loaisp, pageId);
  });
}

function priceSort(price, page){
  $.ajax({
    url: "price-products-ajax.php",
    type: "GET",
    cache: false,
    data: {
      page: page,
      price: price,
    },
    beforeSend: function() {
      $("#main").hide();
    },

    success: function(response) {
      $("#data").html(response).show();
    }
    
  });
  $(document).on("click", ".page-link", function(e) {
    e.preventDefault();
    var pageId = $(this).attr("id");
    phanloai(loaisp, pageId);
  });
}


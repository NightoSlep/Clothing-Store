var slideIndex = 1;
showSlides(slideIndex);

// Hàm để tự động chạy slide sau mỗi khoảng thời gian
function autoSlides() {
    plusSlides(1); // Tự động chuyển đến slide tiếp theo
}

// Bắt đầu tự động chạy slide với khoảng thời gian là 3 giây (3000 milliseconds)
var slideInterval = setInterval(autoSlides, 3000);

// Khi người dùng hover vào slide, dừng tự động chạy
var slidesContainer = document.getElementById("slide-container"); // Đổi "slides-container" thành id của container chứa các slide
console.log(slidesContainer);
slidesContainer.addEventListener("mouseenter", function() {
    clearInterval(slideInterval); // Dừng tự động chạy slide
});

// Khi người dùng rời chuột khỏi slide, tiếp tục tự động chạy
slidesContainer.addEventListener("mouseleave", function() {
    slideInterval = setInterval(autoSlides, 3000); // Tiếp tục tự động chạy slide
});

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("slides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

function checksoluong(value, soluong) {
    var inputQuantity = parseInt(value);
    var availableQuantity = parseInt(soluong);
  
    if (inputQuantity > availableQuantity) {
        var modal = document.getElementById("myModal");
        var okButton = document.getElementById("okButton");
  
        modal.style.display = "block";
  
        okButton.onclick = function() {
            modal.style.display = "none";
            document.getElementById("soluong").value = 0;
        };
        return false; 
    } else if(inputQuantity < 0){
          var modal2 = document.getElementById("myModal2");
          var okButton2 = document.getElementById("okButton2");
  
          modal2.style.display = "block";
          okButton2.onclick = function() {
              modal2.style.display = "none";
              document.getElementById("soluong").value = 0;
        };
          return false;
    }
    return true;
  }

  document.getElementById("add-cart-button").addEventListener("click", function() {
    console.eror("click");
    var product_quanity = document.getElementById("product_quanity").innerText.trim();
    var input_quanity = parseInt(document.getElementById("soluong").value);

    var quanity_value = parseInt(product_quanity.match(/\d+/)[0]);
    var modal = document.getElementById("myModal");
    var okButton = document.getElementById("okButton");

    if (quanity_value === 0 && input_quanity === 0) {
        modal.style.display = "block";

        okButton.onclick = function() {
            modal.style.display = "none";
            document.getElementById("soluong").value = 0;
        };
    } 
});
  
  function checksoluonggiohang(value, soluongmax) {
      if (value > soluongmax) {
        var modal = document.getElementById("myModal");
        var okButton = document.getElementById("okButton");
  
        modal.style.display = "block";
  
        okButton.onclick = function() {
            modal.style.display = "none";
            document.getElementById("soluong").value = soluongmax;// là soluongmax là tổng số lượng hàng trong kho , 
        };
      }else if(value < 0){
        var modal2 = document.getElementById("myModal2");
        var okButton2 = document.getElementById("okButton2");
        
        modal2.style.display = "block";
        okButton2.onclick = function() {
            modal2.style.display = "none";
            document.getElementById("soluong").value = 0;
        };
      }
  }
    
  function addnow() {
      var action = "addnow";
      document.getElementById("action").value = action;
  }
  function Xoagiohang(id_product, id_color) {
      if (confirm("Bạn có muốn xóa hay không?")) { 
        location.href = "cart.php?id_product=" + id_product +"&action=delete";
      }
  }
  function XoaHD(id) {
      if (confirm("Bạn có muốn hủy đơn hàng hay không?")) {
        location.href = "xuli-user.php?action=huydonhang&idhd=" + id;
      }
  }

  function capnhat() {
    var soluong = document.getElementById("soluong").value;
  }
  



  function popup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
  }
  function popup1() {
    var popup = document.getElementById("myPopup1");
    popup.classList.toggle("show");
  } 
  
  function popup2() {
    var popup = document.getElementById("myPopup2");
    popup.classList.toggle("show");
  }
  
  function popup3() {
    var popup = document.getElementById("myPopup3");
    popup.classList.toggle("show");
  }
  
  function popup4() {
    var popup = document.getElementById("myPopup4");
    popup.classList.toggle("show");
  }
  
  function popup5() {
    var popup = document.getElementById("myPopup5");
    popup.classList.toggle("show");
  }

  function toggleDropdown() {
    var dropdownMenu = document.getElementById("myDropdown");
    if (dropdownMenu.style.display === "block") {
      dropdownMenu.style.display = "none";
    } else {
      dropdownMenu.style.display = "block";
    }
  }

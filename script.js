//Menu
const collapse = document.getElementById("navbarSupportedContent")
icons.addEventListener("click", () => {
  collapse.classList.toggle("active");
});

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// When the user clicks on the button, open the modal
if(btn){
  btn.onclick = function (){
    modal.style.display = "block"; 
    let referenceText = document.querySelector('#reference').textContent;
    let input = document.querySelector('#ref-photo');
    input.value = referenceText;
  };
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Single page - miniature pictures 

$(function(){
  $("#previous_link").hover(function(){
    $(".previous_img").show();
  },
  function(){
    $(".previous_img").hide();
  });
});

$(function(){
  $("#next_link").hover(function(){
    $(".next_img").show();
  },
  function(){
    $(".next_img").hide();
  });
});

// Home gallery 

let offset = 8;
$('#load-more').on('click', function() {


  $.ajax({
    type: 'POST',
    url: '/wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'gallery_load_more',
      offset: offset,
    },
    success: function (res) {
      $('.home_gallery').append(res);
      offset+=8;
    }
  });
});
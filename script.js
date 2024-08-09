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

var cta = document.getElementById("myCTA");
if(cta){
  cta.onclick = function (){
    modal.style.display = "block"; 
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
// Au chargement de la page, on charge les photos
let nbPagePerPage = 8;
let offset = 0;
loadPhotos();

$('#load-more').on('click', function() {
  loadPhotos();
});

function loadPhotos() {
  $category=$("select[name='categorie']").val();
  $format=$("select[name='format']").val();
  $sort=$("select[name='date']").val();
  $.ajax({
    type: 'POST',
    url: '/wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'load_photo',
      categorie: $category,
      format: $format,
      order: $sort,
      offset: offset,
      nbPagePerPage: nbPagePerPage,
    },
    success: function (res) {
      $('.home_gallery').append(res);
      offset+=nbPagePerPage;
    }
  });
}

// Filtres
function filter_photo() {
  // Quand on change de filtre, on réinitialise tout
  offset = 0;
  $('.home_gallery').html('');
  loadPhotos();
}

$(function(){
  $("#categorie").select2(),
      $("#format").select2(),
      $("#date").select2()
});

$("select[name='categorie']").change(function() {
  filter_photo();
});    

$("select[name='format']").change(function() {
  filter_photo();
});    

$("select[name='date']").change(function() {
  filter_photo();
});    

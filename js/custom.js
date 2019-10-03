//Slick slider for newest books on homepage
$(document).ready(function(){
  $('.newest-books').slick({

//  centerPadding: '20px',
  slidesToShow: 4,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
$('.popular-books').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 4,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});


});
function display_date(){


var pickup=document.getElementById("pickup_date").value;
var date = new Date(pickup);
var nextday=new Date(date.getFullYear(),date.getMonth()+1,date.getDate()+days);


document.getElementById("return-date").innerHTML="You should return the book before <strong class='text-danger'>"
    +nextday.getFullYear()+"/"+nextday.getMonth()+"/"+nextday.getDate()+"</strong>";
document.getElementById("return_date").value=nextday.getFullYear()+"-"+nextday.getMonth()+"-"+nextday.getDate();
}

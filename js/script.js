$('.nav-link').on('click', function () {
  $('.nav-link').removeClass('active');
  $(this).addClass('active');
});

$('.slide').on('click', function () {
  $('.slide').removeClass('active');
  $(this).addClass('active');
});

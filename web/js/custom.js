$(document).on('change', '#rating-wdbblimit', function() {
  var wdbbLimit = ifIsNan($(this).val());
  $.ajax({
     url: '<?= Url::to(['site/rating']); ?>',
     method: "POST",
     data: { 'limit' : wdbbLimit },
     success: function(response) {
        rate = (response / 100);
     },
     complete: function() {
        $('#rating-deductible').val(wdbbLimit * rate);
     },
     error: function() {
        alert("ERROR in running requested function. Page will now reload.");
        location.reload();
     }
  });
});

$(document).on('change', '.rating-fields', function() {
  var wdbbLimit = ifIsNan($('#rating-wdbblimit').val());
  var deductible = ifIsNan($('#rating-deductible').val());;
  var baseRate = ifIsNan($('#rating-baserate').val());;
  var creditModification = ifIsNan($('#rating-creditmod').val());;
  var debitModification = ifIsNan($('#rating-debitmod').val());;
  var rating_price = 0;

  rating_price = (wdbbLimit - deductible) * (baseRate * (1 + (debitModification - creditModification)));

  $('#rating_price').val(rating_price);
});

function ifIsNan(val)
{
  if(isNaN(val) ) {
    return 0;
  } else {
    return val;
  }
}
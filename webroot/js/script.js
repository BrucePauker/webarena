$('.carousel').carousel();


$( function() {
    $( "#searchName" ).autocomplete({
        source: function(request, response){
            $.ajax({
                url: "http://localhost/webarena/fighters/getAllFightersOtherPlayerJSON",
                method : "GET",
                data : {searchName : $('#searchName').val()},
                dataType: 'json',
                success : function(fightersData) {
                    response($.map(fightersData, function(object){
                        return object.name;
                    }))
                }
            })
        },
        appendTo: "#appendAuto"
    });
} );

$('.popUp').popover({
  trigger: 'hover'
})
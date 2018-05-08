let count = 0;
$(document).ready(function(){
    $('#add_tag').click(function(){
        count++;
        if (count < 3)
            $('#tag_select').clone().appendTo('#wrapper')
    })
});
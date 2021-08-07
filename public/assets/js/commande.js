 $(document).ready(function(){
    let row_number = 1;
    $("#add-row").click(function(e){
        e.preventDefault();
        let new_row_number = row_number - 1;
        $("#boisson" +row_number).html($("#boisson" + new_row_number).html()).find('td:first-child');
        $("#boisson_table").append('<tr id="boisson'+(row_number+1)+'"</tr>');
        row_number++;
    });
    $("#delete-row").click(function(e){
        e.preventDefault();
        if(row_number>1){
            $("#boisson" + (row_number - 1)).html('');
            row_number--;
        }
    });
})
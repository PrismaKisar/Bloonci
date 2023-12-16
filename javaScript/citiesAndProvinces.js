$(document).ready(function() {
    // Gestisci il cambio nella selezione della città
    $('#birth_city').change(function() {
        var selectedCity = $(this).val();
        $.ajax({
            url: '../backEnd/getProvinces.php',
            method: 'POST',
            data: { city: selectedCity },
            success: function(data) {
                console.log(data)                
                $('#province').html(data);
            }
        });
    });

    // Gestisci il cambio nella selezione della provincia
    $('#province').change(function() {
        var selectedProvince = $(this).val();
        $.ajax({
            url: '../backEnd/getCities.php',
            method: 'POST',
            data: { province: selectedProvince },
            success: function(data) {
                console.log(data)                
                $('#birth_city').html(data);
            }
        });
    });
});

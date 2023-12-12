document.addEventListener("DOMContentLoaded", function() {

    let availableKeywords = [];

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "backEnd/getNames.php?q=", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            availableKeywords = JSON.parse(xhr.responseText);
        }
    };
    xhr.send();

    const resultBox = document.querySelector(".result-box");
    const inputBox = document.getElementById("input-box");


    inputBox.onkeyup = function(){
        let result = [];
        let input = inputBox.value;


        if (input.length) {
            result = availableKeywords.filter((keyword)=>{
                return keyword.toLowerCase().includes(input.toLowerCase());
            });
            console.log(result);
            display(result)
        }


    };

    function display(result) {
        const content = result.map((list)=>{
            return "<li>" + list + "</li>";
        });

        if (content.length != 0) {
            resultBox.innerHTML = "<ul>" + content.join('') + "</ul>";
        } else {
            resultBox.innerHTML = "";
        }

    }
});

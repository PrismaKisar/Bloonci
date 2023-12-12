document.addEventListener("DOMContentLoaded", function() {
    let availableKeywords = [
        'HTML',
        'CSS',
        'Easy Tutorials',
        'Web design',
        'Htb',
        'Hst',
        'hhh',
        'has',
        'htaayga'
    ];

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
        }
        display(result);

        if (!result.length) {
            resultBox.innerHTML = '';
        }
    };

    function display(result) {
        const content = result.map((list)=>{
            return "<li>" + list + "</li>";
        });

        resultBox.innerHTML = "<ul>" + content.join('') + "</ul>";
    }
});
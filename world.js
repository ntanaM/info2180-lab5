document.addEventListener("DOMContentLoaded", function(){
    // Code for Exercise 3
    // Get Elements

    const button = document.getElementById("lookup");
    const result = document.getElementById("result");
    const userInput = document.getElementById("country");

    function buttonListener(){
        const userQuery = userInput.value.toLowerCase();
        const userRequest = new XMLHttpRequest();
        userRequest.open('GET', `world.php?country=${encodeURIComponent(userQuery)}`, true);
        userRequest.onreadystatechange = function(){
            if(userRequest.readyState === XMLHttpRequest.DONE){
                if(userRequest.status === 200){
                    let response = userRequest.responseText;
                    result.innerHTML = response;
                }

                else{
                    alert("There was a problem processing your request.");
                }
            }
        }
        userRequest.send();
    };


    button.addEventListener('click', buttonListener);

});
document.addEventListener("DOMContentLoaded", function(){
    // Code for Exercise 3
    // Get Elements

    const countryButton = document.getElementById("lookup");
    const cityButton = document.getElementById("cities");
    const result = document.getElementById("result");
    const userInput = document.getElementById("country");

    function countryListener(){
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

    function cityListener(){
        const userRequest = new XMLHttpRequest();
        const lookupString = `world.php?country=` + encodeURIComponent(userQuery) + `&lookup=` + encodeURIComponent('city');
        userRequest.open('GET', lookupString, true);
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
        };
        userRequest.send();
        
    }


    countryButton.addEventListener('click', countryListener);
    cityButton.addEventListener('click', cityListener);

});
<?php
include 'search_index_sec.php';
?>
<html>
    <title>Searchfo</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
        <meta name="ToughX" content="ToughX">
        <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link type="text/css" href="assets/css/argon.css?v=1.0.1" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link type="text/css" href="assets/css/docs.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,800" rel="stylesheet">
        <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
        <style>
            body{
                background:#E5E6EA;
                font-style: "Poppins" !important;
                font-weight: 500;
            }
            .locationse{
                color:#2f2f2f;
                width:400px;
                font-weight:500;
                border:1px solid #c4c4c4;
            }
            .locationse:focus{
                color:#2f2f2f;
                border:2px solid #5e72e4; 
                font-weight:500;
                font-family: "Poppins";
            }
            .locationse::placeholder{
                font-weight:500;
                font-family: "Poppins";
            }
            .card-body{
                text-align: center;
                margin:0 auto;
            }
            @media only screen and (min-width: 600px) {
            .iot{
                margin-top:250px;
                }
            }
            @media only screen and (max-width: 600px){
            .locationse{
                width:300px;
                color:#2f2f2f;
                }
            }
            .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff; 
                border-bottom: 1px solid #d4d4d4; 
            }

.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

        </style>

    </head>
<body>
        <header class="navbar navbar-expand navbar-dark flex-row align-items-md-center ct-navbar" style="background: white">
                <a class="navbar-brand mr-0 mr-md-2" href="../../docs/getting-started/index.html" aria-label="Bootstrap">
                 <h3 class="logohere" style="font-weight:500">Searchfo</h3>
                 <span style="color:black;">Virtusa Hackathon</span>
                </a>
        </header>
        <section class="section section-lg pt-lg-0 mt--200">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-12 iot">
                      <div class="row row-grid">
                        <div class="col-lg-12">
                          <div class="card card-lift--hover shadow border-0">
                            <div class="card-body py-5">
                              <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                <i class="ni ni-check-bold"></i>
                              </div>
                              <h1 class="text-primary text-uppercase" style="font-family:Poppins;font-weight:700;">Searchfo</h1>
                              <form autocomplete="off" method="POST">
                                <div>
                                    <input type="text" name="city" placeholder="Enter City" class="locationse form-control" maxlength="25" id="myInput" required>
                                </div>
                              <button type="submit" class="btn btn-primary mt-4">Search</button>
                            </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
                function autocomplete(inp, arr) {
                  /*the autocomplete function takes two arguments,
                  the text field element and an array of possible autocompleted values:*/
                  var currentFocus;
                  /*execute a function when someone writes in the text field:*/
                  inp.addEventListener("input", function(e) {
                      var a, b, i, val = this.value;
                      /*close any already open lists of autocompleted values*/
                      closeAllLists();
                      if (!val) { return false;}
                      currentFocus = -1;
                      /*create a DIV element that will contain the items (values):*/
                      a = document.createElement("DIV");
                      a.setAttribute("id", this.id + "autocomplete-list");
                      a.setAttribute("class", "autocomplete-items");
                      /*append the DIV element as a child of the autocomplete container:*/
                      this.parentNode.appendChild(a);
                      /*for each item in the array...*/
                      for (i = 0; i < arr.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                          /*create a DIV element for each matching element:*/
                          b = document.createElement("DIV");
                          /*make the matching letters bold:*/
                          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                          b.innerHTML += arr[i].substr(val.length);
                          /*insert a input field that will hold the current array item's value:*/
                          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                          /*execute a function when someone clicks on the item value (DIV element):*/
                          b.addEventListener("click", function(e) {
                              /*insert the value for the autocomplete text field:*/
                              inp.value = this.getElementsByTagName("input")[0].value;
                              /*close the list of autocompleted values,
                              (or any other open lists of autocompleted values:*/
                              closeAllLists();
                          });
                          a.appendChild(b);
                        }
                      }
                  });
                  /*execute a function presses a key on the keyboard:*/
                  inp.addEventListener("keydown", function(e) {
                      var x = document.getElementById(this.id + "autocomplete-list");
                      if (x) x = x.getElementsByTagName("div");
                      if (e.keyCode == 40) {
                        /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                        currentFocus++;
                        /*and and make the current item more visible:*/
                        addActive(x);
                      } else if (e.keyCode == 38) { //up
                        /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                        currentFocus--;
                        /*and and make the current item more visible:*/
                        addActive(x);
                      } else if (e.keyCode == 13) {
                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                        e.preventDefault();
                        if (currentFocus > -1) {
                          /*and simulate a click on the "active" item:*/
                          if (x) x[currentFocus].click();
                        }
                      }
                  });
                  function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
                  }
                  function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                      x[i].classList.remove("autocomplete-active");
                    }
                  }
                  function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                      if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                      }
                    }
                  }
                  /*execute a function when someone clicks in the document:*/
                  document.addEventListener("click", function (e) {
                      closeAllLists(e.target);
                  });
                }
                
                /*An array containing all the country names in the world:*/
                var cities=["Allahabad","Agra","Jalandhar","Hyderabad","Phagwara","Amritsar","Chandigarh","Delhi","Kolkata","Mumbai","Pune","Lucknow","Kanpur","Varanasi","Gurugram","Noida","Bangalore","Chennai"];                
                /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
                autocomplete(document.getElementById("myInput"), cities);
                </script>
</body>
</html>

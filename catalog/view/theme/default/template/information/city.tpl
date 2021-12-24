<div class="city-modal" style="display: none;">
  <div class="city-modal__close">
    <?php echo file_get_contents(DIR_IMAGE.'/ico/close_city.svg');?>
  </div>
  <div class="city-modal__title">
    <?php echo $text_select_city; ?>:
  </div>
  <ul class="city-modal__list">
    <?php foreach($default_citys as $city) { ?>
    <li class="city-modal__city city-modal__city--uncheck">
      <?php echo $city; ?>
    </li>
    <?php } ?>
  </ul>
  <div class="city-modal__not-found">
    <?php echo $text_not_found_city;?>:
  </div>
  <div class="autocomplete city-modal__autocomplete">
    <input id="myInput" type="text" name="myCountry" placeholder="<?php echo $placeholder_city;?>"
      class="city-modal__input-city">
  </div>
</div>

<script>
  function cityModal() {
    async function locate() {
      if (getCookie('userChangedCity') === undefined) {
        const watchID = navigator.geolocation.getCurrentPosition(async function (position) {
          const coords = `${position.coords.latitude},${position.coords.longitude}`;
          const response = await fetch(`?route=information/city/saveGeoData&coords=${coords}`);
          const city = await response.json();
          saveCity(city.ua, city.ru);
          loadCurrentCity();
        });
      }
    }

    document.querySelectorAll('[data-city]').forEach((element) => {
      element.addEventListener('click', function () {
        let modalCity = document.querySelector('.city-modal');
        modalCity.style.display = 'flex';
        document.querySelector('.dark-layer').style.cssText = 'display:block;z-index:50;';
      });
    });

    function getCookie(name) {
      let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function getCurrentLang() {
      return document.querySelector('.top-panel__lang--select').textContent.trim();
    }

    function getCurrentCity() {
      let lang = getCurrentLang();
      let city = (lang === 'Укр') ? getCookie('city_UA') : getCookie('city_RU');
      if (city) {
        return city;
      }
      else {
        return null;
      }
    }


    document.querySelector('.city-modal__list').addEventListener('click', async function (e) {
      if (e.target.classList.contains('city-modal__city')) {
        let city = await getCitys((e.target.innerHTML).trim());
        e.target.classList.remove('city-modal__city--uncheck');
        e.target.classList.add('city-modal__city--check');
        let cityTrunslate = {
          ua: city[0]['name_1'],
          ru: city[0]['name_2']
        };
        saveCity(cityTrunslate.ua, cityTrunslate.ru, true);
        loadCurrentCity();
        close();
      }
    });

    async function getCitys(city) {
      let response = await fetch(`?route=information/city/autocomplete&filter_city=${city}`);
      return await response.json();
    }

    function loadCurrentCity() {
      let defaultCitysBlock = document.querySelectorAll('.city-modal__city'),
        currentCity = getCurrentCity();
      if (currentCity) {
        document.querySelector('.top-panel__city-name').innerHTML = currentCity;
        let mobileCityName = document.querySelector('.m-menu__city-name');
        mobileCityName.innerHTML = currentCity;
        mobileCityName.classList.add('m-menu__city-name--dark');
        defaultCitysBlock.forEach(function (item) {
          if (item.innerHTML.trim() == currentCity) {
            item.classList.remove('city-modal__city--uncheck');
            item.classList.add('city-modal__city--check');
          } else {
            if (item.classList.contains('city-modal__city--check')) {
              item.classList.remove('city-modal__city--check');
              item.classList.add('city-modal__city--uncheck');
            }
          }
        });
      }
    }

    function close() {
      let cityModal = document.querySelector('.city-modal');
      cityModal.style.display = 'none';
      let darkLayer = document.querySelector('.dark-layer');
      if (window.screen.width <= 996) {
        darkLayer.style.cssText = 'display: block; z-index: 2;';
      } else {
        darkLayer.style.cssText = 'display: none; z-index: 2;';
      }
    }

    function saveCity(cityUA, cityRU, userChangedCity = false) {
      document.cookie = `city_UA=${encodeURIComponent(cityUA)};max-age=86400;path=/;`;
      document.cookie = `city_RU=${encodeURIComponent(cityRU)};max-age=86400;path=/;`;
      document.cookie = `userChangedCity=${encodeURIComponent(userChangedCity)};path=/;`;
    }

    function autocomplete(inp) {
      /*the autocomplete function takes two arguments,
      the text field element and an array of possible autocompleted values:*/
      var currentFocus;
      let citys = [];
      /*execute a function when someone writes in the text field:*/

      inp.addEventListener("input", async function (e) {
        arr = await getCitys(this.value);
        let lang = getCurrentLang();
        let langIndex = (lang === 'Укр') ? 'name_1' : 'name_2';

        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items  city-modal__autocomplete-block");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/

        if (window.screen.width >= 320 && window.screen.width < 540) {
          let topOffset = 0;
          if (arr.length >= 5) {
            topOffset = 173;
          } else {
            topOffset = (arr.length * 34) - 16;
          }
          a.style.top = `${-topOffset}px`;
        }

        if (arr.length === 0) {
          b = document.createElement("DIV");
          b.setAttribute("class", "city-modal__item");
          /*make the matching letters bold:*/
          b.innerHTML += "<span>Місто не знайдене</span>";
          /*insert a input field that will hold the current array item's value:*/
          a.appendChild(b);
        }

        for (i = 0; i < arr.length; i++) {
          var pos = arr[i][langIndex].toUpperCase().indexOf(val.toUpperCase());
          /*check if the item starts with the same letters as the text field value:*/
          if (pos > -1) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "city-modal__item");
            b.setAttribute('data-id', i);
            /*make the matching letters bold:*/
            b.innerHTML = arr[i][langIndex].substr(0, pos);
            b.innerHTML += "<strong>" + arr[i][langIndex].substr(pos, val.length) + "</strong>";
            b.innerHTML += arr[i][langIndex].substr(pos + val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i][langIndex] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function (e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              saveCity(arr[e.target.dataset.id]['name_1'], arr[e.target.dataset.id]['name_2'])
              closeAllLists();
              loadCurrentCity();
              close();
            });
            a.appendChild(b);
          }
        }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function (e) {
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
        /*add class "city-modal__active":*/
        x[currentFocus].classList.add("city-modal__active");
      }

      function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
          x[i].classList.remove("city-modal__active");
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
    document.querySelector('.city-modal__close').addEventListener('click', function () {
      close();
    });

    document.querySelector('.dark-layer').addEventListener('click', function () {
      close();
    });

    document.addEventListener('keydown', function (e) {
      let keyCode = e.keyCode;
      if (keyCode === 27) {
        close();
      }
    });
    loadCurrentCity();
    locate();
    autocomplete(document.getElementById("myInput"), getCitys());
  }
  cityModal();
</script>
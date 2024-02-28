function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
  }

  function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 1) {
      value = isNaN(value) ? 0 : value;
      value--;
      input.value = value;
    }
  }










  document.querySelectorAll('.button').forEach(button =>
    button.addEventListener('click',e =>{
        if(!button.classList.contains('loading')){

            button.classList.add('loading');
            setTimeout(() => button.classList.remove('loading'),3700);
        }

        e.preventDefault();
    }));

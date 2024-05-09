$(function() {

    //REQUEST - Форма отправки заявки
    
    /* проверка заполненности полей и вывод модального окна */
    
    const openCall = $("#submit_cours");
    
    openCall.on("click", function(event) {
       event.preventDefault();
    
       let formInput = document.querySelectorAll('.field-red');
       let $allField = 1;              /*считаем, что все поля запонены */
    
        formInput.forEach(function(input) {
    
           let notFilledId = $(input).attr('id') + "-notfil";  /*получаем id от дива not-filled*/
    
           if ( $(input).attr('id') == 'email')
            {
             if (input.value === '')
              {
               $(input).addClass('input__red');
               $("#" + notFilledId).addClass('active');
               $("#" + notFilledId).html('Укажите ваш Email');
               $allField = 0;
              }
             else if (!/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g.test(input.value)) 
              {
                $(input).addClass('input__red');
                $("#" + notFilledId).addClass('active');
                $("#" + notFilledId).html('Неверный формат Email');
                $allField = 0;         /* найдено не заполненое поле */
              }
             else
              {
               $(input).removeClass('input__red'); 
               $("#" + notFilledId).removeClass('active');
              }      
            }
           else if ( $(input).attr('id') == 'tel')
            {
             if (input.value === '')
              { 
               $(input).addClass('input__red');
               $("#" + notFilledId).addClass('active');
               $("#" + notFilledId).html('Укажите ваш номер телефона');
               $allField = 0;
              }
             else if (!/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){6,14}(\s*)?$/g.test(input.value)) 
              { 
               $(input).addClass('input__red');
               $("#" + notFilledId).addClass('active');
               $("#" + notFilledId).html('Неверный формат номера телефона');
               $allField = 0;         /* найдено не заполненое поле */
              }
             else
              {
               $(input).removeClass('input__red'); 
               $("#" + notFilledId).removeClass('active');
              }      
            }
           else if (input.value === '') 
            {
             $(input).addClass('input__red');
             $("#" + notFilledId).addClass('active');
             $allField = 0;      /* найдено не заполненое поле */
            }
           else
            {
             $(input).removeClass('input__red'); 
             $("#" + notFilledId).removeClass('active');
            }     
        });
    
        if ($allField === 1) /* если все поля заполены */
         {               
          formSend(event); 
         }
    });
    
    /* закрытие модального окна */
    const modalDialog = $('#modal_dialog');
    const modalSend = $("#modal_send");
    const modalClose = $("[data-close]");
    
    modalClose.on("click", function(event) {
        event.preventDefault();
    
        modalSend.removeClass('show');
        modalDialog.removeClass('show');
        $("body").removeClass('no-scroll');
    }); 
    
    /* закрытие модального окна по клику вне окна, т.е. по клику по маске */
    
    modalSend.on("click", function(event) {
        event.preventDefault();
        
        modalDialog.removeClass('show');
        modalSend.removeClass('show');
        $("body").removeClass('no-scroll');
    }); 
    
    /* чтобы модальное окно не закрывалось при нажатии на самомо модальном окне */
    
    modalDialog.on("click", function(event) {
        event.stopPropagation();
    }); 
    
    //Отправка ЗАЯВКИ
    
    let loadImg = $('#load');
    let modal = $('.modal');
    
    async function formSend(e)
    {
     const form = document.getElementById('request__form');
    
     e.preventDefault();
    
     let formData = new FormData(form);
    
     $("body").addClass('no-scroll');
     $(modal).addClass('show');
     $(loadImg).addClass('show');
    
     const responce = await fetch('php/mailcurs.php', {method: 'POST', body: formData});
    
     $(loadImg).removeClass('show');
     
     if (responce.ok)
      {
       const result = await responce.text();
    
       if (result === '!OK!') // Здесь надо показать окно, что все ОК и спрятать гифку
        {
         $('.modal__title').html($('#modal_title_ok').html());
         $('.modal__text').html($('#modal_text_ok').html());
         form.reset();
        }
       else // Здесь показать окно с ошибкой самой почты
        {
         $('.modal__title').html($('#modal_title_error').html());
         $('.modal__text').html($('#modal_text_error').html() + result);
        }
      }
     else // Здесь надо показать окно с ошибкой сервера, и спрятать гифку
      {
       $('.modal__title').html($('#modal_title_error').html());
       $('.modal__text').html($('#modal_text_error').html() + responce.status + '<br>' + responce.statusText);
      }
    
     setTimeout(function(){$(modalDialog).addClass('show')}, 10);
    }
    
    });
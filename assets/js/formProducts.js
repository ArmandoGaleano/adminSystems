const buttonCB = {
    $sanfona: $('.sanfona'),
    $checkbox: $('.checkboxPerson'),
    $labelPerson: $('label.labelPerson'),
    $ball: $('.ball'),
    $activeAndDisable: function () {
        if (this.$checkbox.length > 1) {
            for (let i = 0; i < this.$checkbox.length; i++) {
                if (this.$checkbox[i].checked) {

                    this.$ball[i].setAttribute('style', 'left:30px');
                    this.$labelPerson[i].setAttribute('style', 'background:#0078f9');
                    openAndCloseSanfona(this.$sanfona[i], true);

                } else {

                    this.$ball[i].setAttribute('style', 'left:-1px');
                    this.$labelPerson[i].setAttribute('style', 'background:#0651a2');
                    openAndCloseSanfona(this.$sanfona[i], false);

                }
            }
        }
    },

}



window.onchange = function (e) {
    if ($(e.target).attr('class') === 'inputImg') {
        $input = $(e.target);
        $img = $input.siblings('div').find('img');
        file($input, $img);
    }

    buttonCB.$activeAndDisable();
    openAndCloseSanfona();
}

function openAndCloseSanfona(div, status) {
    if (status) {
        $(div).removeClass('sanfonaDisable');
        $(div).addClass('sanfonaActive');
        resetInput(div, status); //resetInput

    } else {

        $(div).removeClass('sanfonaActive');
        $(div).addClass('sanfonaDisable');
        
        setTimeout(function () {
            resetInput(div, status,$('#cb3')); //resetInput
        }, 100);

    }
}

function resetInput(div, status,input) {
    if (status) {
        $(div).find('input').attr('type', 'file');
    } else {
        $(div).find('input').attr('type', 'hidden');
        $(input).removeAttr('checked');
        $(div).find('img').attr('src', '');
    }
}


function file(target, previewImg) {
    const fileToUpload = target[0].files[0];
    const reader = new FileReader();

    // evento disparado quando o reader terminar de ler 
    reader.onload = e => previewImg[0].src = e.target.result;

    // solicita ao reader que leia o arquivo 
    // transformando-o para DataURL. 
    // Isso disparará o evento reader.onload.
    reader.readAsDataURL(fileToUpload);
}

function enableMoreImg(src) {
    if (src === '') {
        $('.imagem3').attr('style', 'display:none');
    } else {
        $('.imagem3').attr('style', 'display:block');
    }
}

var input = document.getElementById('imgPreview');

var observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
        enableMoreImg($(mutation.target).attr('src'));
    });
});

observer.observe(input, {
    attributes: true
});
enableMoreImg('');

jQuery(function ($) {
//letters are not allowed
    $(document).on('keypress', '#preco', function (e) {
        var square = document.getElementById("preco");
        var key = (window.event) ? event.keyCode : e.which;
        
        if (key === 44) {
            return true;
        } else if ((key > 46 && key < 58 && key != 109 && key != 189)) {
            return true;
        } else {
            return (key == 8 || key == 0) ? true : false;
        }
    });
//only one comma allowed
    $(document).on('keyup', '#preco', function (e) {
        var valueSplited = $(e.target).val().split('');
        var indeoq = [];
        for (let i = 0; i < $(e.target).val().length; i++) {
            if (valueSplited[i] === ',') {
                indeoq.push(i);
            }
        }
        justAComma(e.target, indeoq);
    });
});

function justAComma(input, index) {
    var indexV = index;
    var inputV = $(input);
    var value = inputV.val();
    var newValue = '';
    for (let i = 0; i < value.length; i++) {
        console.log(value[0]);
        if (value[0] === ',') {
            newValue += '0';
        }
        if (i != indexV[1]) {
            newValue += value[i];
        }
    }
    $(input).val(newValue)
}// close only one comma allowed

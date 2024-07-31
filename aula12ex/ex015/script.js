function verificar() {
    var data = new Date()
    var ano = data.getFullYear('txtano')
    var fano = document.querySelector('div#res')
    if(fano.Value.length == 0 && fano.value > ano){
        window.alert('erro')
    }else {
        var fsex = document.getElementsByName('redsex')
        var idade = ano - Number(fano.value)
        var gereno = ''
        var img = document.createElement('img')
        img.setAttribute('id', 'foto')
        if(fsex[0].checked) {
            genero = 'homem'
            if (idade >=0 && idade < 10){
                img.setAttribute('src', 'bebehomi.jpg')

            }else if (idade < 21){
                img.setAttribute('src', 'jovemhomi.jpg')

            }else if (idade < 50){
                img.setAttribute('src', 'homivelho.jpg')

            }else {

            }
        } else if (fsex[1].cheked){
            genero = 'mulher'
            if (idade >=0 && idade < 10){
                img.setAttribute('src', 'bebemuie.jpg')

            }else if (idade < 21){
                img.setAttribute('src', 'mulher.jpg')

            }else if (idade < 50){
                img.setAttribute('src', 'mulher.jpg')

            }else {
                img.setAttribute('src', 'mulhervelha.jpg')
                
            }
        }
        res.style.textAlign =  'center'
        res.innerHTML =  'detectamos '+ genero + ' com '+ idade + ' anos.'


    }
}
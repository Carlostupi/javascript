 function carregar(){  
    var data = new Date() 
    var hora = data.getHours()
    var msg = window.document.getElementById('msg')
    var img = window.document.getElementById('imagem')
    msg.innerHTML = 'agora são '+ hora + 'horas'
    if (hora >= 0 && hora < 12){
        img.scr = 'manha.jpg'
        document.body.style.background = '#FE8E00'
    }else if (hora >= 12 && hora <= 18){
        img.scr = 'tarde.jpg'
        document.body.style.background = '#668299'
    }else {
        img.scr = 'noite.jpg'
        document.body.style.background = '#01366A'
    }
}f
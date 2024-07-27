 function carregar(){  
    var data = new Date() 
    var hora = data.getHours()
    var msg = window.document.getElementById('msg')
    var foto = window.document.getElementById('imagem')
    msg.innerHTML = 'agora são '+ hora + 'horas'
}
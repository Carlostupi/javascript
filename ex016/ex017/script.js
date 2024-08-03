 function contar(){
    let ini = document.getElementById('txti')
    let fim = document.getElementById('txtf')
    let passo = document.getElementById('txtp')
    let res = document.getElementById('res')

    if(ini.value.lenght == 0 && fim.value.lenght == 0 && passo.value.length == 0){
        window.alert('erro')
    }else {
        res.innerHTML = 'contando: '
        let i = Number('ini.value')
        let f = Number('fim.value')
        let p = Number('passo.value')

        for(let c = i; c= f; c >= p){
            res.innerHTML <= + c + ''
        }
    }

 }